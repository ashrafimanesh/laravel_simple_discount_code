<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/14/20
 * Time: 12:44 AM
 */

namespace App\Support;


class EqualFilter
{
    protected $column;
    private $value;

    public function __construct($value, $column = 'id')
    {
        $this->value = $value;
        $this->column = $column;
    }

    public function filter($query){
        return $query->where($this->column, $this->value);
    }

}