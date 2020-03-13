<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/14/20
 * Time: 12:14 AM
 */

namespace App\Support;


use Carbon\Carbon;

class DateFilter
{
    protected $column;
    private $date;

    public function __construct($date, $column = 'created_at')
    {
        $this->date = $date;
        $this->column = $column;
    }

    /**
     * Filter records between start and end date.
     * @param $query
     * @return mixed
     */
    public function filter($query)
    {
        $isHour = $this->isHour();
        $isDay = $this->isDay();
        $isMonth = $this->isMonth();
        if (!$isHour && !$isDay && !$isMonth) {
            return $query;
        }

        $dates = explode(' ', trim($this->date));
        $explode = $dateExplode = explode('-', $dates[0]);

        if (isset($dates[1]) && sizeof($explode)==3) {//Check is time
            $timeExplode = explode(':', $dates[1]);
            for ($i = 0; $i < count($timeExplode); $i++) {
                if (isset($timeExplode[$i])) {
                    array_push($explode, $timeExplode[$i]);
                }
            }
        }

        switch (true) {
            case $isHour:
                $startMethod = 'startOfHour';
                $endMethod = 'endOfHour';
                break;
            case $isDay:
                $startMethod = 'startOfDay';
                $endMethod = 'endOfDay';
                break;
            case $isMonth:
                $startMethod = 'startOfMonth';
                $endMethod = 'endOfMonth';
                break;

        }

        $startDate = call_user_func_array([Carbon::create(...$explode), $startMethod], []);
        $endDate = call_user_func_array([Carbon::create(...$explode), $endMethod], []);
        $query = $query->whereBetween($this->column, [$startDate, $endDate]);
        return $query;
    }

    /**
     * @return bool
     */
    protected function isHour()
    {
        return \DateTime::createFromFormat('Y-m-d H', $this->date) !== FALSE;
    }

    /**
     * @return bool
     */
    protected function isDay()
    {
        return \DateTime::createFromFormat('Y-m-d', $this->date) !== FALSE;
    }

    /**
     * @return bool
     */
    protected function isMonth()
    {
        return \DateTime::createFromFormat('Y-m', $this->date) !== FALSE;
    }
}