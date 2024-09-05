<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Zone;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class StoreController extends Controller {
    public function index() {
        $pageTitle = 'All Store';
        $stores    = $this->getStoreData('');
        return view('admin.store.index', compact('pageTitle', 'stores'));
    }
    public function pending() {
        $pageTitle = 'Pending Stores';
        $stores    = $this->getStoreData('storePending');
        return view('admin.store.index', compact('pageTitle', 'stores'));
    }
    public function approved() {
        $pageTitle = 'Approved Stores';
        $stores    = $this->getStoreData('storeApproved');
        return view('admin.store.index', compact('pageTitle', 'stores'));
    }
    public function rejected() {
        $pageTitle = 'Rejected Stores';
        $stores    = $this->getStoreData('storeRejected');
        return view('admin.store.index', compact('pageTitle', 'stores'));
    }

    protected function getStoreData($scope) {
        if ($scope) {
            $stores = User::$scope();
        } else {
            $stores = User::whereNotNull('store_data')->where('store', '!=', 0);
        }

        return $stores->with('location')->searchable(['username', 'firstname', 'lastname', 'store_data->name', 'location:name'], true)->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function detail($id) {
        $pageTitle   = 'Store Detail';
        $user        = User::with('zone')->findOrFail($id);
        $coordinates = explode(',', @$user->zone->coordinates);
        $initLat     = $coordinates[0];
        $initLong    = $coordinates[1];
        return view('admin.store.detail', compact('pageTitle', 'user', 'initLat', 'initLong'));
    }

    public function edit($id) {
        $pageTitle = 'Edit Store';
        $user      = User::findOrFail($id);
        $zones     = Zone::active()->get(['id', 'name']);
        return view('admin.store.edit', compact('pageTitle', 'user', 'zones'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'        => 'required|string',
            'zone_id'     => 'required|integer|exists:zones,id',
            'location'    => 'required|string|unique:locations,name,' . $id,
            'store_image' => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $user          = User::findOrFail($id);
        $storeFromData = $user->store_data->store_form_data;
        $storeImage    = $user->store_data->store_image;

        if ($request->hasFile('store_image')) {
            try {
                $storeImage = fileUploader($request->store_image, getFilePath('vehicleStore'), getFileSize('vehicleStore'), $storeImage);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $storeData = [
            'name'            => $request->name,
            'store_image'     => $storeImage,
            'store_form_data' => $storeFromData,
        ];

        $user->store_data = $storeData;
        $user->zone_id    = $request->zone_id;
        $user->save();

        $location       = $user->location;
        $location->name = $request->location;
        $location->save();

        $notify[] = ['success', 'Vehicle store updated successfully'];
        return back()->withNotify($notify);
    }

    public function approve($id) {
        $user        = User::storePending()->findOrFail($id);
        $user->store = Status::STORE_APPROVED;
        $user->save();

        notify($user, 'STORE_APPROVED', [
            'username' => $user->username,
            'store'    => $user->store_data->name,
        ]);

        $notify[] = ['success', 'Store approved successfully'];
        return back()->withNotify($notify);
    }
    public function reject(Request $request, $id) {
        $request->validate([
            'store_feedback' => 'required|string|max:255',
        ]);

        $user = User::storePending()->findOrFail($id);

        $location = $user->location;
        $location->delete();

        $user->location_id    = 0;
        $user->zone_id        = 0;
        $user->store          = Status::STORE_REJECTED;
        $user->store_feedback = $request->store_feedback;
        $user->save();

        notify($user, 'STORE_REJECTED', [
            'username'       => $user->username,
            'store'          => $user->store_data->name,
            'store_feedback' => $request->store_feedback,
        ]);

        $notify[] = ['success', 'Store approved successfully'];
        return back()->withNotify($notify);
    }
}
