<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model {
    use GlobalStatus, Searchable;

    public function scopeActiveToday($query) {
        $today = Carbon::today()->format('Y-m-d');
        $query->whereIn('status', [Status::RENT_PENDING, Status::RENT_ON_GOING, Status::RENT_APPROVED])
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today);
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function review() {
        return $this->hasOne(Review::class);
    }
    public function vehicleOwner() {
        return $this->belongsTo(User::class, 'vehicle_user_id');
    }

    public function pickupZone() {
        return $this->belongsTo(Zone::class, 'pick_up_zone_id');
    }

    public function dropZone() {
        return $this->belongsTo(Zone::class, 'drop_off_zone_id');
    }

    public function pickupPoint() {
        return $this->belongsTo(Location::class, 'pick_up_location_id');
    }

    public function dropPoint() {
        return $this->belongsTo(Location::class, 'drop_off_location_id');
    }
    public function statusBadge(): Attribute {
        return new Attribute(
            get: fn() => $this->badgeData(),
        );
    }

    public function badgeData() {
        $html = '';
        if ($this->status == Status::RENT_INITIATE) {
            $html = '<span class="badge badge--dark">' . trans('Initiated') . '</span>';
        } else if ($this->status == Status::RENT_PENDING) {
            $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
        } else if ($this->status == Status::RENT_APPROVED) {
            $html = '<span class="badge badge--primary">' . trans('Approved') . '</span>';
        } else if ($this->status == Status::RENT_ON_GOING) {
            $html = '<span class="badge badge--info">' . trans('On Going') . '</span>';
        } else if ($this->status == Status::RENT_COMPLETED) {
            $html = '<span class="badge badge--success">' . trans('Completed') . '</span>';
        } else {
            $html = '<span class="badge badge--danger">' . trans('Cancelled') . '</span>';
        }
        return $html;
    }

    public function scopeInitiate($query) {
        return $query->where('status', Status::RENT_INITIATE);
    }
    public function scopePending($query) {
        return $query->where('status', Status::RENT_PENDING);
    }
    public function scopeApproved($query) {
        return $query->where('status', Status::RENT_APPROVED);
    }
    public function scopeOngoing($query) {
        return $query->where('status', Status::RENT_ON_GOING);
    }
    public function scopeCompleted($query) {
        return $query->where('status', Status::RENT_COMPLETED);
    }
    public function scopeCancelled($query) {
        return $query->where('status', Status::RENT_CANCELLED);
    }
}
