<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 6:12 PM
 */

namespace App\Logic;


use App\Coupon;
use App\Repositories\CouponCodeRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class CouponCodeLogic
{
    public function store(Coupon $coupon, $code){
        /** @var User $user */
        $user = Auth::user();
        return (new CouponCodeRepository())->store($user, $coupon, $code);
    }
}