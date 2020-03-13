<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 11:29 PM
 */

namespace App\Support;


class QueryFilter
{
    /**
     * @var array
     */
    private $filters;

    public $filterClasses = [
        'date'=>DateFilter::class,
        'equal'=>EqualFilter::class
    ];

    public function __construct(array $filters = []){

        $this->filters = $filters;
    }

    public function filter($query)
    {
        if(!$this->filters || !$this->filterClasses){
            return $query;
        }

        //TODO we can set columns and conditions dynamically.

        if(isset($this->filters['create_time']) && isset($this->filterClasses['date'])){
            $class = $this->filterClasses['date'];
            $query = (new $class($this->filters['create_time'], 'created_at'))->filter($query);
        }
        if(isset($this->filters['publish_time']) && isset($this->filterClasses['date'])){
            $class = $this->filterClasses['date'];
            $query = (new $class($this->filters['publish_time'], 'published_at'))->filter($query);
        }
        if(isset($this->filters['brand_id']) && isset($this->filterClasses['equal'])){
            $class = $this->filterClasses['equal'];
            $query = (new $class($this->filters['brand_id'], 'brand_id'))->filter($query);
        }
        return $query;
    }
}