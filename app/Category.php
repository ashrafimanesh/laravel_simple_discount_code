<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    const TABLE_NAME = 'categories';

    protected $table = self::TABLE_NAME;

    public function brands(){
        return $this->hasMany(Brand::class);
    }
}
