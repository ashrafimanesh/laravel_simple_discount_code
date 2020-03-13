<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 8:16 PM
 */

namespace App\Http\Requests\Api;


use App\Coupon;
use App\CouponCode;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignCodeRequest extends FormRequest
{
    protected $coupon;
    protected $assignee;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        if(!$user){
            return false;
        }

        return $user->can('assign',CouponCode::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_id'=>['required',Rule::exists(Coupon::TABLE_NAME,'id')->where(function($query){
                Coupon::staticActive($query);
            })],
            'code'=>[Rule::exists(CouponCode::TABLE_NAME)->where(function($query){
                CouponCode::staticFree($query, $this->input('coupon_id'));
            })]
            ,'user_id'=>['exists:'.User::TABLE_NAME.',id']
        ];
    }

    public function coupon():Coupon
    {
        return $this->coupon ?: ($this->coupon = Coupon::find($this->input('coupon_id')));
    }

    /**
     * Return auth user if user_id isn't set in form params and return login user to assign code to them.
     * @return User
     */
    public function assignee()
    {
        return $this->assignee
            ?: $this->assignee = ( $this->input('user_id') ? User::find($this->input('user_id')) : $this->user());
    }
}