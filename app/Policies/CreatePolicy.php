<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 5:36 PM
 */

namespace App\Policies;

use App\User;

trait CreatePolicy
{
    public function create(User $user){
        return $user->isAdmin();
    }

}