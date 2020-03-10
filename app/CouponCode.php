<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    const TABLE_NAME = 'coupon_codes';

    protected $table = self::TABLE_NAME;

    protected $dates = [
        'assigned_at'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::TABLE_NAME, 'coupon_id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeFree($query){
        return $query->whereNull('assigned_to');
    }
}
