<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Brand;
use App\Models\Form;
use App\Models\Location;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Zone;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class VehicleController extends Controller {
    public function store() {
        $pageTitle = 'Vehicle Store';
        $user      = auth()->user();

        if ($user->store == Status::STORE_PENDING) {
            $notify[] = ['error', 'Your store is currently awaiting approval from the administrator'];
            return back()->withNotify($notify);
        }

        if ($user->store == Status::STORE_APPROVED) {
            return to_route('user.vehicle.store.data');
        }

        $form  = Form::where('act', 'store_kyc')->first();
        $zones = Zone::active()->get(['id', 'name']);
        return view($this->activeTemplate . 'user.vehicle.store', compact('pageTitle', 'form', 'user', 'zones'));
    }

    public function storeCreate(Request $request) {

        $validate = [
            'zone_id'     => 'required|integer|exists:zones,id',
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|unique:locations,name',
            'store_image' => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];

        $form           = Form::where('act', 'store_kyc')->first();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $validateData   = array_merge($validate, $validationRule);
        $request->validate($validateData);
        $storeFromData = $formProcessor->processFormData($request, $formData);

        $user       = auth()->user();
        $storeImage = @$user->store_data->store_image;

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

        $location          = new Location();
        $location->user_id = $user->id;
        $location->name    = $request->location;
        $location->save();

        $user->location_id = $location->id;
        $user->zone_id     = $request->zone_id;
        $user->store_data  = $storeData;
        $user->store       = Status::STORE_PENDING;
        $user->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New store has created by ' . $user->username;
        $adminNotification->click_url = route('admin.store.detail', $user->id);
        $adminNotification->save();

        $notify[] = ['success', 'Vehicle store created successfully'];
        return to_route('user.home')->withNotify($notify);
    }

    public function storeData() {
        $pageTitle = 'Vehicle Store Data';
        $user      = auth()->user();
        return view($this->activeTemplate . 'user.vehicle.store_data', compact('pageTitle', 'user'));
    }

    public function index() {
        $pageTitle = 'All Vehicle';
        $vehicles  = $this->getVehicleData('');

        return view($this->activeTemplate . 'user.vehicle.index', compact('pageTitle', 'vehicles'));
    }

    public function pending() {
        $pageTitle = 'Pending Vehicle';
        $vehicles  = $this->getVehicleData('pending');
        return view($this->activeTemplate . 'user.vehicle.index', compact('pageTitle', 'vehicles'));
    }
    public function approved() {
        $pageTitle = 'Approved Vehicle';
        $vehicles  = $this->getVehicleData('approved');
        return view($this->activeTemplate . 'user.vehicle.index', compact('pageTitle', 'vehicles'));
    }
    public function rejected() {
        $pageTitle = 'Rejected Vehicle';
        $vehicles  = $this->getVehicleData('rejected');
        return view($this->activeTemplate . 'user.vehicle.index', compact('pageTitle', 'vehicles'));
    }

    protected function getVehicleData($scope) {
        $vehicles = Vehicle::where('user_id', auth()->id());
        if ($scope) {
            $vehicles->$scope();
        }
        return $vehicles->searchable(['model', 'identification_number', 'vehicleType:name'])->with(['vehicleType:id,name'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function add($id = 0) {
        $pageTitle = 'Add New Vehicle';
        $vehicle   = null;
        $images    = [];
        if ($id) {
            $pageTitle = 'Update Vehicle';
            $vehicle   = Vehicle::where('user_id', auth()->id())->findOrFail($id);

            foreach ($vehicle->images ?? [] as $key => $image) {
                $img['id']  = $image;
                $img['src'] = getImage(getFilePath('vehicle') . '/' . $image);
                $images[]   = $img;
            }
        }
        $brands = Brand::active()->select(['id', 'name'])->get();
        $user   = auth()->user();
        $zones  = Zone::where('id', '!=', $user->zone_id)->active()->get(['id', 'name']);
        return view($this->activeTemplate . 'user.vehicle.add', compact('pageTitle', 'vehicle', 'brands', 'images', 'zones'));
    }

    public function update(Request $request, $id = 0) {
        $validate  = $id ? 'nullable' : 'required';
        $maxUpload = gs('max_image_upload');
        $validate  = [
            'vehicle_type_id'       => 'required|integer|exists:vehicle_types,id',
            'brand_id'              => 'required|integer|exists:brands,id',
            'drop_point'            => 'required|array|min:1',
            'name'                  => 'required|string|max:40',
            'model'                 => 'required|string|max:40',
            'cc'                    => 'required|numeric|gte:0',
            'bhp'                   => 'required|numeric|gte:0',
            'speed'                 => 'required|integer|gt:0',
            'cylinder'              => 'required|integer|gt:0',
            'year'                  => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'color'                 => 'required|string|max:40',
            'identification_number' => 'required|string|unique:vehicles,identification_number,' . $id,
            'mileage'               => 'required|string|max:40',
            'vehicle_condition'     => 'required|string|in:new,used',
            'transmission_type'     => 'required|string|in:automatic,manual',
            'fuel_type'             => 'required|string|in:gasholine,diesel,electric',
            'seat'                  => 'required|integer|gte:0',
            'price'                 => 'required|numeric|gte:0',
            'total_run'             => 'required|numeric|gte:0',
            'description'           => 'nullable|string',
            'image'                 => [$validate, new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'images'                => "nullable|array|max:$maxUpload",
            'images.*'              => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];

        $vehicleType  = VehicleType::active()->findOrFail($request->vehicle_type_id);
        $vehicleClass = [];
        if ($vehicleType->manage_class) {
            $vehicleClass = [
                'vehicle_class_id' => 'required|integer|exists:vehicle_classes,id',
            ];
        }
        $validateData = array_merge($validate, $vehicleClass);

        $request->validate($validateData);

        if ($id) {
            $vehicle      = Vehicle::where('user_id', auth()->id())->findOrFail($id);
            $notification = 'Vehicle updated successfully wait for admin approval';

            $imageToRemove = $request->old ? array_values(removeElement($vehicle->images, $request->old)) : $vehicle->images;
            if ($imageToRemove != null && count($imageToRemove)) {
                foreach ($imageToRemove as $singleImage) {
                    fileManager()->removeFile(getFilePath('vehicle') . '/' . $singleImage);
                }
                $vehicle->images = removeElement($vehicle->images, $imageToRemove);
            }

        } else {
            $vehicle      = new Vehicle();
            $notification = 'Vehicle added successfully wait for admin approval';
        }

        if ($request->hasFile('image')) {
            try {
                $vehicle->image = fileUploader($request->image, getFilePath('vehicle'), getFileSize('vehicle'), @$vehicle->image, getFileThumb('vehicle'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $images = $id ? $vehicle->images : [];
        if ($request->hasFile('images')) {
            foreach ($request->images as $singleImage) {
                try {
                    $images[] = fileUploader($singleImage, getFilePath('vehicle'), getFileSize('vehicle'));
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }
        }

        $vehicle = $this->insertVehicleData($vehicle, $request, $images);
        if ($id) {
            $vehicle->approval_status = Status::VEHICLE_PENDING;
            $vehicle->save();
        }

        $vehicle->zones()->sync($request->drop_point);

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $vehicle->user_id;
        $adminNotification->title     = 'New vehicle added via' . @$vehicle->user->username;
        $adminNotification->click_url = route('admin.vehicle.detail', $vehicle->id);
        $adminNotification->save();

        $user = $vehicle->user;
        if (!$id) {
            notify($user, 'VEHICLE_REQUEST', [
                'username'              => $user->username,
                'identification_number' => $vehicle->identification_number,
                'brand'                 => $vehicle->brand->name,
                'name'                  => $vehicle->name,
                'model'                 => $vehicle->model,
            ]);
        }

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    private function insertVehicleData($vehicle, $request, $images) {
        $vehicle->user_id               = auth()->id();
        $vehicle->vehicle_type_id       = $request->vehicle_type_id;
        $vehicle->vehicle_class_id      = @$request->vehicle_class_id ?? 0;
        $vehicle->brand_id              = $request->brand_id;
        $vehicle->name                  = $request->name;
        $vehicle->model                 = $request->model;
        $vehicle->cc                    = $request->cc;
        $vehicle->bhp                   = $request->bhp;
        $vehicle->speed                 = $request->speed;
        $vehicle->cylinder              = $request->cylinder;
        $vehicle->year                  = $request->year;
        $vehicle->color                 = $request->color;
        $vehicle->identification_number = $request->identification_number;
        $vehicle->mileage               = $request->mileage;
        $vehicle->vehicle_condition     = $request->vehicle_condition;
        $vehicle->transmission_type     = $request->transmission_type;
        $vehicle->fuel_type             = $request->fuel_type;
        $vehicle->seat                  = $request->seat;
        $vehicle->price                 = $request->price;
        $vehicle->total_run             = $request->total_run;
        $vehicle->description           = $request->description;
        $vehicle->images                = $images;
        $vehicle->save();

        return $vehicle;
    }

    public function detail($id) {
        $pageTitle = 'Vehicle Detail';
        $vehicle   = Vehicle::findOrFail($id);
        return view($this->activeTemplate . 'user.vehicle.detail', compact('pageTitle', 'vehicle'));
    }
}
