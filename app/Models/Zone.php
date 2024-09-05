<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    use Searchable, GlobalStatus;

    protected $cast = [
        // 'coordinates' => 'array',
    ];
    public function vehicleZone() {
        return $this->hasMany(VehicleZone::class);
    }

    public function locations() {
        return $this->hasManyThrough(Location::class, User::class, 'zone_id', 'user_id', 'id', 'id');
    }
}
