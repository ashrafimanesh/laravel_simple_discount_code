<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 5:49 PM
 */

namespace App\Repositories;


use App\Coupon;
use App\CouponCode;
use App\User;
use Illuminate\Support\Facades\DB;

class CouponCodeRepository
{

    public function store(User $user, Coupon $coupon, $codes)
    {
        $creatorId = $user->getId();
        if(!is_array($codes)){
            return CouponCode::create(['code'=>$codes,'coupon_id'=>$coupon->getId(), 'created_by'=> $creatorId]);
        }

        $data = [];
        foreach($codes as $code){
            $data[] = ['code'=>$code, 'coupon_id'=>$coupon->getId(), 'created_by'=> $creatorId];
        }

        try{
            DB::beginTransaction();

            CouponCode::insert($data);

            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}