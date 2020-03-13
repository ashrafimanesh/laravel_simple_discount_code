<?php

namespace App\Providers;

use App\Coupon;
use App\CouponCode;
use App\Policies\CouponCodePolicy;
use App\Policies\CouponPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Coupon::class => CouponPolicy::class,
        CouponCode::class=>CouponCodePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
