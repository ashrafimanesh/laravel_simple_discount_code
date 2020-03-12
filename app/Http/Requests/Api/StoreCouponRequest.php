<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/12/20
 * Time: 9:43 AM
 */

namespace App\Http\Requests\Api;


use App\Brand;
use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','unique:'.Coupon::TABLE_NAME,'max:255'],
            'brand_id'=>['required','exists:'.Brand::TABLE_NAME.',id'],
            'amount'=>['required','integer'],
            'type'=>['required',Rule::in(Coupon::types())],
            'link'=>['nullable','string','max:255'],
            'status'=>['required',Rule::in(Coupon::statuses())],
            'published_at'=>['nullable','date'],
        ];
    }

    public function getAmount(){
        return $this->amount;
    }
}