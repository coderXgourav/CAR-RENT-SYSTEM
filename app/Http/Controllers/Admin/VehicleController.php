<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller {
    public function types() {
        $pageTitle    = 'All Vehicle Type';
        $vehicleTypes = VehicleType::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.vehicle.types', compact('pageTitle', 'vehicleTypes'));
    }

    public function typeStore(Request $request, $id = 0) {

        $imageValidate = $id ? 'nullable' : 'required';
        $request->validate([
            'name'        => 'required|string|max:40|unique:vehicle_types,name,' . $id,
            'description' => 'required|string|max:255',
            'image'       => [$imageValidate, new FileTypeValidate(['jpg', 'jpeg', 'webp', 'png'])],
        ]);

        if ($id) {
            $vehicle      = VehicleType::findOrFail($id);
            $notification = 'Vehicle updated successfully';
        } else {
            $vehicle      = new VehicleType();
            $notification = 'Vehicle added successfully';
        }

        if ($request->hasFile('image')) {
            try {
                $vehicle->image = fileUploader($request->image, getFilePath('vehicleType'), getFileSize('vehicleType'), @$vehicle->image);
            } catch (\Exception $e) {
                $notify[] = ['error', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }

        $vehicle->name         = $request->name;
        $vehicle->description  = $request->description;
        $vehicle->slug         = slug($request->name) . '_' . time();
        $vehicle->manage_class = $request->manage_class ? Status::YES : Status::NO;
        $vehicle->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function typeStatus($id) {
        return VehicleType::changeStatus($id);
    }

    public function classes() {
        $pageTitle      = 'All Vehicle Class';
        $vehicleClasses = VehicleClass::searchable(['name', 'vehicleType:name'])->with('vehicleType:id,name')->orderBy('id', 'desc')->paginate(getPaginate());
        $vehicleTypes   = VehicleType::active()->get(['id', 'name']);
        return view('admin.vehicle.classes', compact('pageTitle', 'vehicleClasses', 'vehicleTypes'));
    }

    public function classStore(Request $request, $id = 0) {
        $request->validate([
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'name'            => [
                'required',
                'string',
                'max:40',
                Rule::unique('vehicle_classes')->where(function ($query) use ($request) {
                    return $query->where('vehicle_type_id', $request->vehicle_type_id);
                })->ignore($id),
            ]], [
            'name.unique' => 'The name must be unique within the selected vehicle type',
        ]);

        if ($id) {
            $vehicle      = VehicleClass::findOrFail($id);
            $notification = 'Vehicle class updated successfully';
        } else {
            $vehicle      = new VehicleClass();
            $notification = 'Vehicle class added successfully';
        }

        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->name            = $request->name;
        $vehicle->slug            = slug($request->name) . '_' . time();
        $vehicle->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function classStatus($id) {
        return VehicleClass::changeStatus($id);
    }
}
