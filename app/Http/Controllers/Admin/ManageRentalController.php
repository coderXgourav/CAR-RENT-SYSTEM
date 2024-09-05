<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;

class ManageRentalController extends Controller {
    public function index() {
        $pageTitle = 'All Rentals';
        $rentals   = $this->getRentalData();
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }
    public function pending() {
        $pageTitle = 'Pending Rentals';
        $rentals   = $this->getRentalData('pending');
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }
    public function approved() {
        $pageTitle = 'Approved Rentals';
        $rentals   = $this->getRentalData('approved');
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }
    public function ongoing() {
        $pageTitle = 'Ongoing Rentals';
        $rentals   = $this->getRentalData('ongoing');
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }
    public function completed() {
        $pageTitle = 'Completed Rentals';
        $rentals   = $this->getRentalData('completed');
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }
    public function cancelled() {
        $pageTitle = 'Cancelled Rentals';
        $rentals   = $this->getRentalData('cancelled');
        return view('admin.rental.index', compact('pageTitle', 'rentals'));
    }

    protected function getRentalData($scope = null) {
        if (!$scope) {
            $rentals = Rental::query();
        } else {
            $rentals = Rental::$scope();
        }
        return $rentals->with('user:id,username,firstname,lastname', 'vehicle:id,identification_number', 'pickupZone:id,name', 'dropZone:id,name')->searchable(['rent_no'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function detail($id) {
        $pageTitle = 'Rental Detail';
        $rental    = Rental::findOrFail($id);
        return view('admin.rental.detail', compact('pageTitle', 'rental'));
    }
}
