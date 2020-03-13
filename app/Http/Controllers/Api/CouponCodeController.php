<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 5:27 PM
 */

namespace App\Http\Controllers\Api;


use App\CouponCode;
use App\DataModels\BaseResponse;
use App\Http\Requests\Api\AssignCodeRequest;
use App\Http\Requests\Api\StoreCouponCodeRequest;
use App\Logic\CouponCodeLogic;

class CouponCodeController extends Controller
{
    public function store(StoreCouponCodeRequest $request){

        $couponCode = (new CouponCodeLogic())->store($request->coupon(), $request->getCodes());

        return $couponCode ?
            (new BaseResponse(BaseResponse::CODE_SUCCESS, ($couponCode instanceof CouponCode) ? $couponCode->toArray() : null)) :
            (new BaseResponse(BaseResponse::CODE_OPERATION_FAILED, null, 'Operation failed!'));
    }

    public function assign(AssignCodeRequest $request){
        $assignee = $request->assignee();
        $couponCode = (new CouponCodeLogic())->assign($assignee, $request->coupon(), $request->input('code'));

        return ($couponCode instanceof CouponCode) && $couponCode->assigned_to == $assignee->getId()
            ? (new BaseResponse(BaseResponse::CODE_SUCCESS, ($couponCode instanceof CouponCode) ? $couponCode->toArray() : null))
            : (new BaseResponse(BaseResponse::CODE_OPERATION_FAILED, null, 'Operation failed!'));
    }
}