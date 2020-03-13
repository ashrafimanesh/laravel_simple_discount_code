<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/12/20
 * Time: 10:49 AM
 */

namespace App\DataModels;


class BaseResponse
{
    const CODE_SUCCESS=200;
    const CODE_UNAUTHORIZED = 403;
    const CODE_EXCEPTION=500;
    const CODE_VALIDATION = 422;
    const CODE_OPERATION_FAILED = 423;

    /** @var int */
    protected $code;
    /** @var string */
    protected $message;

    protected $data;

    /** @var \Exception */
    protected $exception;

    public function __construct($code=BaseResponse::CODE_SUCCESS, $data = [], $message=''){
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
    }


    /**
     * @param string $message
     * @return BaseResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param int $code
     * @return BaseResponse
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setException(\Exception $exception)
    {
        $this->exception = $exception;
        return $this;
    }

    public function toArray(){
        return [
            'code'=>$this->code,
            'message'=>$this->message,
            'data'=>$this->data,
        ];
    }

    public function __toString(){
        return json_encode($this->toArray());
    }

    /**
     * @param array $data
     * @return BaseResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}