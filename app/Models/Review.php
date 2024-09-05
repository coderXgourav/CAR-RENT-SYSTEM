<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use Searchable;

    public function rental() {
        return $this->belongsTo(Rental::class);
    }
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
