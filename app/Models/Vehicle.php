<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
    use Searchable, GlobalStatus;

    protected $casts = [
        'images' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rental() {
        return $this->hasOne(Rental::class);
    }

    public function vehicleType() {
        return $this->belongsTo(VehicleType::class);
    }

    public function vehicleClass() {
        return $this->belongsTo(VehicleClass::class);
    }

    public function reviewData() {
        return $this->hasMany(Review::class, 'vehicle_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function zones() {
        return $this->belongsToMany(Zone::class, 'vehicle_zones');
    }

    protected function locationId(): Attribute {
        return new Attribute(
            get: fn() => $this->zones->pluck('id')->toArray()
        );
    }

    protected function locationName(): Attribute {
        return new Attribute(
            get: fn() => $this->zones->pluck('name')->toArray()
        );
    }

    public function approvalStatusBadge(): Attribute {
        return new Attribute(
            get: fn() => $this->approveBadgeData(),
        );
    }

    public function approveBadgeData() {
        $html = '';
        if ($this->approval_status == Status::VEHICLE_APPROVED) {
            $html = '<span class="badge badge--success">' . trans('Approved') . '</span>';
        } else if ($this->approval_status == Status::VEHICLE_REJECTED) {
            $html = '<span class="badge badge--danger">' . trans('Rejected') . '</span>';
        } else {
            $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
        }
        return $html;
    }

    public function scopePending($query) {
        return $query->where('approval_status', Status::VEHICLE_PENDING);
    }
    public function scopeApproved($query) {
        return $query->where('approval_status', Status::VEHICLE_APPROVED);
    }
    public function scopeRejected($query) {
        return $query->where('approval_status', Status::VEHICLE_REJECTED);
    }

    public function scopeRented($query) {
        return $query->where('rented', Status::YES);
    }

    public function scopeAvailable($query) {
        $query->active()->approved()->whereHas('user', function ($query) {
            $query->active();
        })->withWhereHas('brand', function ($brand) {
            $brand->active();
        })->withWhereHas('vehicleType', function ($type) {
            $type->active();
        });
    }

    public function scopeVehicleAvailable($query) {
        return $query->whereHas('rental', function ($query) {
            $query->activeToday();
        });
    }
}
