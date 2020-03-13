<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed email
 */
class User extends Authenticatable
{
    use Notifiable;
    const TABLE_NAME = 'users';
    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assignedCodes(){
        return $this->hasMany(CouponCode::class, 'assigned_to');
    }

    public function getId()
    {
        return $this->id;
    }

    public function isAdmin()
    {
        //TODO check role!
        return $this->email == 'admin@test.com';
    }
}
