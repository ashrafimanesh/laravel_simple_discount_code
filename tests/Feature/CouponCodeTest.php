<?php

namespace Tests\Feature;

use App\Coupon;
use App\CouponCode;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CouponCodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'code'=>Str::random(60),
            'coupon_id'=>Coupon::first()->id,
        ];
        $response = $this->post('/api/admin/coupon-code', $data, [
            'Authorization'=> 'Bearer '.(User::whereNotNull('api_token')->first()->api_token),
            'Content-Type'=>'application/x-www-form-urlencoded',
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);

        $couponCode = CouponCode::where(['coupon_id'=>$data['coupon_id'], 'code'=>$data['code']])->first();
        $this->assertTrue(($couponCode->code ?? '')==$data['code']);
    }
}
