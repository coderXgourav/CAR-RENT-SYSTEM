<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller {
    public function index() {
        $pageTitle = 'All Zone';
        $zones     = Zone::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.zone.index', compact('pageTitle', 'zones'));
    }

    public function add($id = 0) {
        $pageTitle = 'Add New Zone';
        $zone      = null;

        $initLat  = 23.874821207010964;
        $initLong = 90.3856718472731;

        if ($id) {
            $zone        = Zone::findOrFail($id);
            $coordinates = explode(',', $zone->coordinates);

            $initLat  = $coordinates[0];
            $initLong = $coordinates[1];
        }

        return view('admin.zone.add', compact('pageTitle', 'zone', 'initLat', 'initLong'));
    }

    public function store(Request $request, $id = 0) {
        $request->validate([
            'name'        => 'required|string|max:40|unique:zones,name,' . $id,
            'coordinates' => 'required',
        ]);

        if ($id) {
            $zone         = Zone::findOrFail($id);
            $notification = 'Zone updated successfully';
        } else {
            $zone         = new Zone();
            $notification = 'Zone added successfully';
        }

        $zone->name        = $request->name;
        $zone->zoom        = @$request->zoom ?? '14';
        $zone->coordinates = $request->coordinates;
        $zone->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
}
