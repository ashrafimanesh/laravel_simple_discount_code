<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 6:12 PM
 */

namespace App\Logic;


use App\Coupon;
use App\CouponCode;
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

    /**
     * Assign code to user
     * @param User $assignee
     * @param Coupon $coupon
     * @param null $code
     * @return CouponCode|null
     */
    public function assign(User $assignee, Coupon $coupon, $code = null){
        /** @var User $assigner */
        $assigner = Auth::user();
        return (new CouponCodeRepository())->assign($assigner, $assignee, $coupon, $code);
    }
}