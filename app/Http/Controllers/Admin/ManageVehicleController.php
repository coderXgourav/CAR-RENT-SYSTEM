<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ManageVehicleController extends Controller {
    public function index() {
        $pageTitle = 'All Vehicles';
        $vehicles  = $this->getVehicleDate('');
        return view('admin.vehicle.list', compact('pageTitle', 'vehicles'));
    }
    public function pending() {
        $pageTitle = 'Pending Vehicles';
        $vehicles  = $this->getVehicleDate('pending');
        return view('admin.vehicle.list', compact('pageTitle', 'vehicles'));
    }
    public function approved() {
        $pageTitle = 'Approved Vehicles';
        $vehicles  = $this->getVehicleDate('approved');
        return view('admin.vehicle.list', compact('pageTitle', 'vehicles'));
    }
    public function rejected() {
        $pageTitle = 'Rejected Vehicles';
        $vehicles  = $this->getVehicleDate('rejected');
        return view('admin.vehicle.list', compact('pageTitle', 'vehicles'));
    }

    protected function getVehicleDate($scope) {
        if ($scope) {
            $vehicles = Vehicle::$scope();
        } else {
            $vehicles = Vehicle::query();
        }
        return $vehicles->searchable(['identification_number', 'user:username,store_data->name', 'vehicleType:name', 'vehicleClass:name'], true)->with(['user', 'vehicleType:id,name', 'vehicleClass:id,name'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function detail($id) {
        $pageTitle = 'Vehicle Detail';
        $vehicle   = Vehicle::findOrFail($id);
        return view('admin.vehicle.detail', compact('pageTitle', 'vehicle'));
    }

    public function status($id) {
        return Vehicle::changeStatus($id);
    }

    public function approve($id) {
        $vehicle                  = Vehicle::pending()->findOrFail($id);
        $vehicle->approval_status = Status::VEHICLE_APPROVED;
        $vehicle->status          = Status::ENABLE;
        $vehicle->save();

        $user = $vehicle->user;
        notify($user, 'VEHICLE_APPROVED', [
            'username'              => $user->username,
            'identification_number' => $vehicle->identification_number,
            'brand'                 => $vehicle->brand->name,
            'name'                  => $vehicle->name,
            'model'                 => $vehicle->model,
        ]);

        $notify[] = ['success', 'Vehicle approved successfully'];
        return to_route('admin.vehicle.pending')->withNotify($notify);
    }
    public function reject(Request $request, $id) {

        $request->validate([
            'admin_feedback' => 'required|string|max:255',
        ]);

        $vehicle                  = Vehicle::pending()->findOrFail($id);
        $vehicle->approval_status = Status::VEHICLE_REJECTED;
        $vehicle->admin_feedback  = $request->admin_feedback;
        $vehicle->save();

        $user = $vehicle->user;
        notify($user, 'VEHICLE_REJECTED', [
            'username'              => $user->username,
            'identification_number' => $vehicle->identification_number,
            'brand'                 => $vehicle->brand->name,
            'name'                  => $vehicle->name,
            'model'                 => $vehicle->model,
            'admin_feedback'        => $request->admin_feedback,
        ]);

        $notify[] = ['success', 'Vehicle rejected successfully'];
        return to_route('admin.vehicle.rejected')->withNotify($notify);
    }

}
