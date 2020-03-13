<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 5:28 PM
 */

namespace App\Http\Requests\Api;


use App\Coupon;
use App\CouponCode;
use App\DataModels\BaseResponse;
use App\Exceptions\ValidationCustomException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class StoreCouponCodeRequest extends FormRequest
{
    protected $coupon;

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

        return $user->can('create',CouponCode::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_id'=>['required','exists:'.Coupon::TABLE_NAME.',id'],
        ];
    }

    public function coupon():Coupon
    {
        return $this->coupon ?: ($this->coupon = Coupon::find($this->input('coupon_id')));
    }

    public function getCodes()
    {
        if($this->file('code')){
            $codes = [];
            $fileResource = fopen($this->file('code')->getRealPath(),'r');
            if ($fileResource) {
                while (($line = fgets($fileResource)) !== false) {
                    $codes[] = trim($line);
                }
                fclose($fileResource);
            }
        }elseif($this->input('code')){
            $codes = [$this->input('code')];
        }
        else{
            $codes = [];
        }
        $this->validateCodes($codes);
        return $codes;
    }

    /**
     * @param $codes
     * @throws ValidationCustomException
     */
    protected function validateCodes($codes)
    {
        $coupon = $this->coupon();
        if (!$codes) {
            throw (new ValidationCustomException('The given data was invalid.'))->addError(['code' => ['Invalid codes']]);
        }
        if (!$coupon->isUnique() && sizeof($codes) > 1) {
            throw (new ValidationCustomException('The given data was invalid.'))->addError(['code' => ['Unique coupon can has more than one code. Your coupon type is: ' . $coupon->type]]);
        }
        $couponCodes = CouponCode::where('coupon_id',$coupon->getId())->whereIn('code', $codes)->get();
        if (($couponCodes instanceof Collection) && !$couponCodes->isEmpty()) {
            $duplicates = $couponCodes->map(function ($row) {
                return $row->code;
            });

            throw (new ValidationCustomException('The given data was invalid.'))->addError([
                'code' => [
                    'Duplicate codes: ' . $duplicates
                ]]);
        }
    }

}