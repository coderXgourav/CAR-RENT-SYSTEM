<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use App\Traits\UserNotify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, Searchable, UserNotify;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code', 'balance', 'kyc_data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address'           => 'object',
        'kyc_data'          => 'object',
        'ver_code_send_at'  => 'datetime',
        'store_data'        => 'object',
    ];

    public function loginLogs() {
        return $this->hasMany(UserLogin::class);
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits() {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function withdrawals() {
        return $this->hasMany(Withdrawal::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function tickets() {
        return $this->hasMany(SupportTicket::class);
    }

    public function fullname(): Attribute {
        return new Attribute(
            get: fn() => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function storeStatusBadge(): Attribute {
        return new Attribute(function () {
            $html = '';
            if ($this->store == Status::STORE_PENDING) {
                $html = '<span class="badge badge--warning">' . trans("Pending") . '</span>';
            } else if ($this->store == Status::STORE_APPROVED) {
                $html = '<span class="badge badge--success">' . trans("Approved") . '</span>';
            } else if ($this->store == Status::STORE_REJECTED) {
                $html = '<span class="badge badge--danger">' . trans("Rejected") . '</span>';
            }
            return $html;
        });
    }

    // SCOPES
    public function scopeActive($query) {
        return $query->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query) {
        return $query->where('status', Status::USER_BAN);
    }

    public function scopeEmailUnverified($query) {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified($query) {
        return $query->where('sv', Status::UNVERIFIED);
    }

    public function scopeKycUnverified($query) {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query) {
        return $query->where('kv', Status::KYC_PENDING);
    }

    public function scopeEmailVerified($query) {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query) {
        return $query->where('sv', Status::VERIFIED);
    }

    public function scopeWithBalance($query) {
        return $query->where('balance', '>', 0);
    }

    public function scopeStoreInitiate($query) {
        return $query->where('store', Status::STORE_INITIATE)->whereNotNUll('store_data');
    }
    public function scopeStorePending($query) {
        return $query->where('store', Status::STORE_PENDING)->whereNotNUll('store_data');
    }
    public function scopeStoreApproved($query) {
        return $query->where('store', Status::STORE_APPROVED)->whereNotNUll('store_data');
    }
    public function scopeStoreRejected($query) {
        return $query->where('store', Status::STORE_REJECTED)->whereNotNUll('store_data');
    }

}
