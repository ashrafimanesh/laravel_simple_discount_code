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

    protected $limit = 0;
    protected $page = 1;

    protected $filterClasses = [
        'date' => DateFilter::class,
        'equal' => EqualFilter::class
    ];

    protected $filterFields = [];

    public function __construct(array $filters = [], $limit=0, $page=0)
    {
        $this->filters = $filters;
        $this->limit = (int)$limit;
        $this->page = (int)$page;
    }

    public function addFilterField(FilterField $fieldFilter)
    {
        $this->filterFields[] = $fieldFilter;
        return $this;
    }

    public function filter($query)
    {
        if ($this->paginate()) {
            $query = $this->setPaginationLimit($query);
        }
        if (!$this->filters || !$this->filterClasses || !$this->filterFields) {
            return $query;
        }
        /** @var FilterField $filterField */
        foreach ($this->filterFields as $filterField) {
            $fieldName = $filterField->getFieldName();
            if (isset($this->filters[$fieldName]) && isset($this->filterClasses[$filterField->getType()])) {
                $class = $this->filterClasses[$filterField->getType()];
                $query = (new $class($this->filters[$fieldName], $filterField->getColumn()))->filter($query);
            }
        }
        return $query;
    }

    /**
     * @return bool
     */
    public function paginate()
    {
        return $this->limit > 0 && $this->page > 0;
    }

    /**
     * @param $query
     * @return mixed
     */
    protected function setPaginationLimit($query)
    {
        $query = $query->limit($this->limit)->offset(($this->page - 1) * $this->limit);
        return $query;
    }
}