<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 * @package App
 * @property Carbon published_at
 * @property mixed type
 * @property string status
 * @property Carbon expired_at
 * @property string name
 * @property int brand_id
 * @property double amount
 * @property string link
 * @property int created_by
 */
class Coupon extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'coupons';
    protected $table = self::TABLE_NAME;

    const TYPE_UNIQUE = 'unique';
    const TYPE_NORMAL = 'normal';
    const TYPE_OFFER = 'offer';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'name', 'amount', 'brand_id', 'status', 'type', 'published_at', 'created_by', 'expired_at', 'link'
    ];

    protected $dates = [
        'deleted_at',
        'published_at',
        'expired_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    //
    public static function types()
    {
        return [self::TYPE_NORMAL, self::TYPE_UNIQUE, self::TYPE_OFFER];
    }

    public static function statuses()
    {
        return [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_EXPIRED];
    }

    public static function staticActive($query)
    {
        $query = static::staticPublished($query);
        $query = static::staticActiveStatus($query);
        $query = static::staticNotExpired($query);
        return $query;
    }

    public static function staticNotExpired($query)
    {
        return $query->where(function ($query) {
            return $query->whereNull('expired_at')->orWhere('expired_at', '>', Carbon::now());
        });
    }

    public function scopeActive($query)
    {
        return static::staticActive($query);
    }

    public function scopeActiveStatus($query)
    {
        return static::staticActiveStatus($query);
    }

    public static function staticActiveStatus($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePublished($query)
    {
        return static::staticPublished($query);
    }

    public static function staticPublished($query)
    {
        return $query->where('published_at', '>=', Carbon::now());
    }

    public function scopeNotExpired($query)
    {
        return static::staticNotExpired($query);
    }

    public function codes()
    {
        return $this->hasMany(CouponCode::class, 'coupon_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::TABLE_NAME, 'created_by');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::TABLE_NAME, 'brand_id');
    }

    public function isUnique()
    {
        return $this->type == self::TYPE_UNIQUE;
    }

    public function isOffer()
    {
        return $this->type == self::TYPE_OFFER;
    }

    public function isExpired()
    {
        return $this->status = self::STATUS_EXPIRED;
    }

    public function getId()
    {
        return $this->id;
    }

    public function expire()
    {
        $this->expired_at = Carbon::now();
        $this->status = self::STATUS_EXPIRED;
        $this->save();
    }
}
