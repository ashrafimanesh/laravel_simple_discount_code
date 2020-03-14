<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/14/20
 * Time: 8:07 AM
 */

namespace App\Support;

/**
 * Add field to use in QueryFilter.
 * Class FilterField
 * @package App\Support
 *
 */
class FilterField
{
    /**
     * Filter type (exp: date, equal, etc)
     * @var string
     */
    private $type;

    /**
     * The table column name. It can be null and fieldName use instate of it.
     * @var $column
     */
    private $column;
    /**
     * filter field name
     * @var string $fieldName
     */
    private $fieldName;

    public function __construct($fieldName, $type, $column = null)
    {
        $this->fieldName = $fieldName;
        $this->type = $type;
        $this->column = $column ?: $fieldName;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getFieldName()
    {
        return $this->fieldName;
    }
}