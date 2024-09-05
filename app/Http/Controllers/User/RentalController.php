<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller {
    public function rentVehice(Request $request, $id) {
        if (!$request->date) {
            $notify[] = ['error', 'Date field is required'];
            return back()->withNotify($notify);
        }

        $date      = explode('-', $request->date);
        $startDate = Carbon::parse(trim($date[0]))->format('Y-m-d');
        $endDate   = @$date[1] ? Carbon::parse(trim(@$date[1]))->format('Y-m-d') : $startDate;

        $request->validate([
            'drop_off_zone_id'     => 'required|integer|gt:0',
            'pick_up_location_id'  => 'required|integer|gt:0',
            'drop_off_location_id' => 'required|integer|gt:0',
            'note'                 => 'nullable|string|max:255',
        ]);

        if ($startDate < now()->format('Y-m-d')) {
            $notify[] = ['error', 'The start date is invalid'];
            return back()->withNotify($notify);
        }

        $vehicle = Vehicle::where('id', $id)->available()->whereDoesntHave('rental', function ($query) use ($startDate, $endDate) {
            $query->where(function ($q) use ($startDate, $endDate) {
                $q->whereIn('status', [Status::RENT_PENDING, Status::RENT_ON_GOING, Status::RENT_APPROVED])->where('start_date', '<=', $endDate)
                    ->where('end_date', '>=', $startDate);
            });
        })->first();

        if (!$vehicle) {
            $notify[] = ['error', 'This vehicle isn\'t available between this date'];
            return back()->withNotify($notify);
        }

        $user = auth()->user();

        if ($vehicle->user_id == $user->id) {
            $notify[] = ['error', 'You can\'t rent your own vehicle'];
            return back()->withNotify($notify);
        }

        $pickUpLocation = Location::with('user')->where('id', $request->pick_up_location_id)->first();
        if (!$pickUpLocation) {
            $notify[] = ['error', 'Pick up location is invalid'];
            return back()->withNotify($notify);
        }

        $zone = Zone::where('id', $request->drop_off_zone_id)->first();
        if (!$zone) {
            $notify[] = ['error', 'Drop off zone is invalid'];
            return back()->withNotify($notify);
        }

        $dropOffLocation = Location::with('user')->where('id', $request->drop_off_location_id)->first();
        if (!$dropOffLocation) {
            $notify[] = ['error', 'Drop off location is invalid'];
            return back()->withNotify($notify);
        }

        $totalDay  = Carbon::parse($startDate)->diffInDays($endDate) + 1;
        $rentPrice = $vehicle->price * $totalDay;

        $rent                  = new Rental();
        $rent->user_id         = $user->id;
        $rent->vehicle_user_id = $vehicle->user_id;
        $rent->vehicle_id      = $vehicle->id;

        $rent->pick_up_zone_id  = $pickUpLocation->user->zone_id;
        $rent->drop_off_zone_id = $zone->id;

        $rent->pick_up_location_id  = $pickUpLocation->id;
        $rent->drop_off_location_id = $dropOffLocation->id;

        $rent->start_date = $startDate;
        $rent->end_date   = $endDate;
        $rent->price      = $rentPrice;
        $rent->rent_no    = getTrx();
        $rent->note       = $request->note;
        $rent->save();

        session()->put('rent_id', $rent->id);
        return redirect()->route('user.deposit.index');
    }

    public function index() {
        $pageTitle = 'All Rental Vehicle';
        $rentals   = $this->getRentData('');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function pending() {
        $pageTitle = 'Pending Rental Vehicle';
        $rentals   = $this->getRentData('pending');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function approved() {
        $pageTitle = 'Approved Rental Vehicle';
        $rentals   = $this->getRentData('approved');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function ongoing() {
        $pageTitle = 'Ongoing Rental Vehicle';
        $rentals   = $this->getRentData('ongoing');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function completed() {
        $pageTitle = 'Completed Rental Vehicle';
        $rentals   = $this->getRentData('completed');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function cancelled() {
        $pageTitle = 'Cancelled Rental Vehicle';
        $rentals   = $this->getRentData('cancelled');
        return view($this->activeTemplate . 'user.rental.index', compact('pageTitle', 'rentals'));
    }

    protected function getRentData($scope) {
        $rentals = Rental::where('vehicle_user_id', auth()->id());
        if ($scope) {
            $rentals->$scope();
        }
        return $rentals->searchable(['rent_no'])->with(['user:id,username', 'vehicle.brand'])->paginate(getPaginate());
    }

    public function detail($id) {
        $pageTitle = 'Rental Detail';
        $rent      = Rental::where('vehicle_user_id', auth()->id())->findOrFail($id);
        return view($this->activeTemplate . 'user.rental.detail', compact('pageTitle', 'rent'));
    }

    public function approve($id) {
        $rent = Rental::pending()->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id())->available()->rented();
        })->findOrFail($id);

        $rent->status = Status::RENT_APPROVED;
        $rent->save();

        $user = $rent->user;
        notify($user, 'RENTAL_APPROVED', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date,
            'end_date'   => $rent->end_date,
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental request approved successfully'];
        return back()->withNotify($notify);
    }

    public function cancel($id) {
        $rent = Rental::where(function ($q) {
            $q->where('status', Status::RENT_PENDING)->orWhere('status', Status::RENT_APPROVED);
        })->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id())->available()->rented();
        })->findOrFail($id);

        $rent->status = Status::RENT_CANCELLED;
        $rent->save();

        $vehicle         = $rent->vehicle;
        $vehicle->rented = Status::NO;
        $vehicle->save();

        $user = $rent->user;
        $user->balance += $rent->price;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $rent->user_id;
        $transaction->amount       = $rent->price;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Payment refund for cancellation rent request';
        $transaction->trx          = getTrx();
        $transaction->remark       = 'payment_refund';
        $transaction->save();

        notify($user, 'RENTAL_CANCELLED', [
            'username'     => $user->username,
            'rent_no'      => $rent->rent_no,
            'brand'        => @$rent->vehicle->brand->name,
            'name'         => @$rent->vehicle->name,
            'model'        => @$rent->vehicle->model,
            'price'        => showAmount($rent->price),
            'start_date'   => $rent->start_date,
            'end_date'     => $rent->end_date,
            'pickup'       => @$rent->pickupPoint->name,
            'dropoff'      => @$rent->dropPoint->name,
            'post_balance' => $user->balance,
        ]);

        $notify[] = ['success', 'Rental request cancelled successfully'];
        return back()->withNotify($notify);
    }

    public function ongoingStatus($id) {
        $rent = Rental::approved()->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id())->available()->rented();
        })->findOrFail($id);

        $rent->status = Status::RENT_ON_GOING;
        $rent->save();

        $user = $rent->user;
        notify($user, 'RENTAL_ONGOING', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date,
            'end_date'   => $rent->end_date,
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $store = $rent->dropPoint;
        notify($user, 'RENTAL_VEHICLE_RECEIVED', [
            'username'   => $store->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date,
            'end_date'   => $rent->end_date,
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental ongoing successfully'];
        return back()->withNotify($notify);
    }

    public function completeStatus($id) {
        $rent         = Rental::ongoing()->where('drop_off_location_id', auth()->id())->findOrFail($id);
        $rent->status = Status::RENT_COMPLETED;
        $rent->save();

        $vehicle         = $rent->vehicle;
        $vehicle->rented = Status::NO;
        $vehicle->save();

        $vehicleOwner = $rent->vehicle->user;
        $vehicleOwner->balance += $rent->price;
        $vehicleOwner->save();

        $trx = getTrx();

        $transaction               = new Transaction();
        $transaction->user_id      = $vehicleOwner->id;
        $transaction->amount       = $rent->price;
        $transaction->post_balance = $vehicleOwner->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Rental amount has been added to the wallet';
        $transaction->trx          = $trx;
        $transaction->remark       = 'rental_payment';
        $transaction->save();

        $charge = $rent->price * gs('rental_charge') / 100;
        $vehicleOwner->balance -= $charge;
        $vehicleOwner->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $vehicleOwner->id;
        $transaction->amount       = $charge;
        $transaction->post_balance = $vehicleOwner->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Rental charge has been deducted from the wallet';
        $transaction->trx          = $trx;
        $transaction->remark       = 'rental_charge';
        $transaction->save();

        $user = $rent->user;
        notify($user, 'RENTAL_COMPLETED', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date,
            'end_date'   => $rent->end_date,
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        notify($vehicleOwner, 'VEHICLE_RETURN_CONFIRMATION', [
            'username'   => $vehicleOwner->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date,
            'end_date'   => $rent->end_date,
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental ongoing successfully'];
        return to_route('user.ongoing.rental.list')->withNotify($notify);
    }
}
