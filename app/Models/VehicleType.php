<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model {
    use Searchable, GlobalStatus;

    public function vehicleClass() {
        return $this->hasMany(VehicleClass::class);
    }
    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }
}
