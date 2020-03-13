<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization, CreatePolicy;
}
