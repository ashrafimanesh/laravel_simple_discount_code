<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    const TABLE_NAME = 'brands';
    protected $table = self::TABLE_NAME;

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
