<?php

namespace Tests\Feature;

use App\Brand;
use App\Coupon;
use App\DataModels\BaseResponse;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = [
            'name'=>Str::random(60),
            'brand_id'=>Brand::first()->id,
            'amount'=>rand(1,10),
            'type'=>Coupon::TYPE_NORMAL,
            'status'=>Coupon::STATUS_INACTIVE,
            'link'=>'http://google.com',
            'published_at'=>Carbon::now()->addDays(15),
        ];
        $response = $this->post('/api/admin/coupon', $data, [
            'Authorization'=> 'Bearer '.(User::whereNotNull('api_token')->first()->api_token),
            'Content-Type'=>'application/x-www-form-urlencoded',
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);

        $coupon = Coupon::orderBy('id', 'DESC')->first();
        $this->assertTrue($coupon->name==$data['name']);
    }
}
