<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// use App\Rules\EmptySpaceRule;
// use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class HolidayFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state_no' => [
                // 'required',
                'numeric',
            ],
            'add_date' => [
                'required',
            ],
            'staff_name' => [
                'required',
                'max:20',
            ],
            'section' => [
            ],
            'memo' => [
            ],
            'tel' => [
                'required',
                'regex:/^[0-9]{2,5}-[0-9]{1,4}-[0-9]{3,4}$/',
            ],
            'holiday_type' => [
                'numeric',
            ],
            'paid_type' => [
                'numeric',
            ],
            'days' => [
                'integer',
                'min:1'
            ],
        ];
    }

    public function attributes()
    {
        // バリデーション配列
        $customAttributes = [];

        return $customAttributes += [
            'staff_name' => '氏名',
            'add_date' => '申請日',
            'tel' => '電話番号',
            'holiday_type' => '休暇種別',
            'paid_type' => '有給種別',
            'days' => '休暇日数',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
