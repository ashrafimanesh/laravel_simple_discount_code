<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CouponCodePolicy
{
    use HandlesAuthorization, CreatePolicy;

    public function assign(){
        return true;
    }
}
