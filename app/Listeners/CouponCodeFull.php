<?php

namespace App\Listeners;

use App\CouponCode;
use App\Events\CouponCodeCapacityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CouponCodeFull
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CouponCodeCapacityEvent $event)
    {
        $coupon = $event->getCoupon();

        $freeCount = CouponCode::free($coupon->getId())->count();
        if(!$freeCount){
            $coupon->expire();
        }

    }
}
