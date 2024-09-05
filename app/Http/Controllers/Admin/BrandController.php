<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller {
    public function index() {
        $pageTitle = 'All Brand';
        $brands    = Brand::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.brand.index', compact('pageTitle', 'brands'));
    }

    public function store(Request $request, $id = 0) {
        $request->validate([
            'name' => 'required|string|max:40|unique:brands,name,' . $id,
        ]);

        if ($id) {
            $vehicle      = Brand::findOrFail($id);
            $notification = 'Brand updated successfully';
        } else {
            $vehicle      = new Brand();
            $notification = 'Brand added successfully';
        }

        $vehicle->name = $request->name;
        $vehicle->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Brand::changeStatus($id);
    }

}
