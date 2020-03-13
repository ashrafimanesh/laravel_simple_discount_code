<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 8:41 AM
 */

namespace App\Repositories;


use App\Coupon;
use App\User;
use Illuminate\Support\Arr;

class CouponRepository
{
    public function store(User $user, array $data): Coupon{
        if($data['published_at'] ?? false){
            $data['published_at'] = $data['published_at'].' 00:00:00';
        }

        $data['created_by'] = $user->getId();
        $coupon = Coupon::create(Arr::only($data, [
            'name','amount','type','status','brand_id','link','published_at','created_by'
        ]));
        return $coupon;
    }
}