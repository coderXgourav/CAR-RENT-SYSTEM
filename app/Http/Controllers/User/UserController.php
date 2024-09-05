<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Models\Form;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Withdrawal;
use App\Models\Zone;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function home() {
        $pageTitle = 'Dashboard';
        $user      = auth()->user();

        $zones = Zone::where('id', '!=', $user->zone_id)->active()->get();

        $rentals                    = Rental::where('vehicle_user_id', auth()->id())->with(['user:id,username', 'vehicle.brand'])->limit(5)->get();
        $widget['total_vehicle']    = Vehicle::where('user_id', $user->id)->count();
        $widget['total_income']     = Rental::where('vehicle_user_id', $user->id)->completed()->sum('price');
        $widget['total_withdrawan'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');
        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle', 'user', 'zones', 'rentals', 'widget'));
    }

    public function depositHistory(Request $request) {
        $pageTitle = 'Payment History';
        $deposits  = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function rentedHistory(Request $request) {
        $pageTitle = 'My Rented History';

        $rentals = Rental::where('user_id', auth()->id())->with(['vehicle' => function ($query) {
            $query->with('brand', 'user');
        }])->searchable(['rent_no'])->with('pickupZone', 'pickupPoint')->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.rented.history', compact('pageTitle', 'rentals'));
    }

    public function rentedDetail($id) {
        $pageTitle = 'Rental Detail';
        $rent      = Rental::where('user_id', auth()->id())->with('pickupZone')->findOrFail($id);
        return view($this->activeTemplate . 'user.rented.detail', compact('pageTitle', 'rent'));
    }

    public function show2faForm() {
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . gs('site_name'), $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate . 'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request) {
        $user = auth()->user();
        $this->validate($request, [
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request) {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts  = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions() {
        $pageTitle = 'Transactions';
        $remarks   = Transaction::distinct('remark')->orderBy('remark')->get('remark');

        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function kycForm() {
        if (auth()->user()->kv == 2) {
            $notify[] = ['error', 'Your KYC is under review'];
            return to_route('user.home')->withNotify($notify);
        }
        if (auth()->user()->kv == 1) {
            $notify[] = ['error', 'You are already KYC verified'];
            return to_route('user.home')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form      = Form::where('act', 'kyc')->first();
        return view($this->activeTemplate . 'user.kyc.form', compact('pageTitle', 'form'));
    }

    public function kycData() {
        $user      = auth()->user();
        $pageTitle = 'KYC Data';
        return view($this->activeTemplate . 'user.kyc.info', compact('pageTitle', 'user'));
    }

    public function kycSubmit(Request $request) {
        $form           = Form::where('act', 'kyc')->first();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData       = $formProcessor->processFormData($request, $formData);
        $user           = auth()->user();
        $user->kyc_data = $userData;
        $user->kv       = 2;
        $user->save();

        $notify[] = ['success', 'KYC data submitted successfully'];
        return to_route('user.home')->withNotify($notify);

    }

    public function attachmentDownload($fileHash) {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general   = gs();
        $title     = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype  = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData() {
        $user = auth()->user();
        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }
        $pageTitle = 'User Data';
        return view($this->activeTemplate . 'user.user_data', compact('pageTitle', 'user'));
    }

    public function userDataSubmit(Request $request) {
        $user = auth()->user();
        if ($user->profile_complete == Status::YES) {
            return to_route('user.home');
        }
        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->address   = [
            'country' => @$user->address->country,
            'address' => $request->address,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'city'    => $request->city,
        ];
        $user->profile_complete = Status::YES;
        $user->save();

        $notify[] = ['success', 'Registration process completed successfully'];
        return to_route('user.home')->withNotify($notify);

    }

    public function rentalList() {
        $pageTitle = 'On Going Rental List';
        $rentals   = Rental::ongoing()->where('drop_off_location_id', auth()->id())->searchable(['rent_no'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.rental.ongoing', compact('pageTitle', 'rentals'));
    }

    public function rentalDetail($id) {
        $pageTitle = 'Rental Detail';
        $rent      = Rental::ongoing()->where('drop_off_location_id', auth()->id())->findOrFail($id);
        return view($this->activeTemplate . 'user.rental.detail', compact('pageTitle', 'rent'));
    }

}
