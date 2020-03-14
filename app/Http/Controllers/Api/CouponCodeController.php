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
use App\Repositories\CouponCodeRepository;
use App\Support\FilterField;
use App\Support\QueryFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponCodeController extends Controller
{
    public function index(Request $request){

        $queryFilter = new QueryFilter($request->filters ?? [], $request->limit ?? 10, $request->page ?? 1);
        //Add supported columns to filter by user
        $queryFilter->addFilterField(new FilterField('coupon_id','equal'));
        $queryFilter->addFilterField(new FilterField('assigned_by','equal'));
        $queryFilter->addFilterField(new FilterField('assigned_to','equal'));

        $couponCodes = (new CouponCodeRepository())->index(Auth::user(), $queryFilter);

        return (new BaseResponse(BaseResponse::CODE_SUCCESS, $couponCodes));
    }

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