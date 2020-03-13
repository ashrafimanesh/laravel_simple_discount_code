<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 8:41 AM
 */

namespace App\Repositories;


use App\Coupon;
use App\Support\QueryFilter;
use App\User;
use Illuminate\Support\Arr;

class CouponRepository
{

    public function index(User $user, QueryFilter $queryFilter)
    {
        $query = Coupon::query();
        if(!$user->isAdmin()){
            $query->active();
        }

        $query = $queryFilter->filter($query);

        return $query->get();
    }

    public function store(User $user, array $data): Coupon{

        $data['created_by'] = $user->getId();
        $coupon = Coupon::create(Arr::only($data, [
            'name','amount','type','status','brand_id','link','published_at','created_by'
        ]));
        return $coupon;
    }
}