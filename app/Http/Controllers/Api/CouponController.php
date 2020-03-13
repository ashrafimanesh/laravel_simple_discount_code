<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/12/20
 * Time: 9:39 AM
 */

namespace App\Http\Controllers\Api;


use App\Coupon;
use App\DataModels\BaseResponse;
use App\Http\Requests\Api\StoreCouponRequest;
use App\Repositories\CouponRepository;
use App\Support\QueryFilter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(Request $request){

        $coupon = (new CouponRepository())->index(Auth::user(), new QueryFilter($request->filters ?? []));

        return (new BaseResponse(BaseResponse::CODE_SUCCESS,$coupon));
    }

    public function store(StoreCouponRequest $request){
        /** @var User $user */
        $user = Auth::user();
        $coupon = (new CouponRepository())->store($user, $request->validated());

        return ($coupon instanceof Coupon) ?
            (new BaseResponse(BaseResponse::CODE_SUCCESS,$coupon->toArray())) :
            (new BaseResponse(BaseResponse::CODE_OPERATION_FAILED, null, 'Operation failed!'));
    }


}