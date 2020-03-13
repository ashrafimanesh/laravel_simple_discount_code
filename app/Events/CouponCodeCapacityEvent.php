<?php

namespace App\Events;

use App\Coupon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CouponCodeCapacityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Coupon  */
    protected $coupon;

    public function __construct(Coupon $coupon){
        $this->coupon = $coupon;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return Coupon
     */
    public function getCoupon():Coupon
    {
        return $this->coupon;
    }
}
