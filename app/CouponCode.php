<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed assigned_to
 */
class CouponCode extends Model
{
    const TABLE_NAME = 'coupon_codes';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'code', 'coupon_id', 'assigned_to','assigned_by','assigned_at'
    ];

    protected $dates = [
        'assigned_at'
    ];

    public static function staticFree($query, $couponId){
        return $query->whereNull('assigned_to')->whereNull('assigned_by')->where('coupon_id',$couponId);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::TABLE_NAME, 'coupon_id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeFree($query, $couponId){
        return static::staticFree($query, $couponId);
    }
}
