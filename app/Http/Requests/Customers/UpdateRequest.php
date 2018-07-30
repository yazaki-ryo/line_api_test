<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
            ],
            'kana' => [
                'nullable',
                'string',
                // TODO フリガナバリデートルール
                'max:191',
            ],
            'sex_id' => [
                'nullable',
                'numeric',
                Rule::exists('sexes', 'id'),
            ],
            'age' => [
                'nullable',
                'numeric',
                'max:150',
            ],
            'office' => [
                'nullable',
                'string',
                'max:191',
            ],
            'department' => [
                'nullable',
                'string',
                'max:191',
            ],
            'position' => [
                'nullable',
                'string',
                'max:191',
            ],
            'postal_code' => [
                'nullable',
                'string',
                // TODO 数値とハイフンバリデート（郵便番号正規表現の方が良いか、又はハイフン無しで限定した方が良いか）
                'max:191',
            ],
            'prefecture_id' => [
                'nullable',
                'numeric',
                Rule::exists('prefectures', 'id'),
            ],
            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'building_name' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'tel' => [
                'required',
                'string',// TODO 又はnumeric
                'max:191',
            ],
            'fax' => [
                'nullable',
                'string',// TODO 又はnumeric
                'max:191',
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
            ],
            'mobile_phone' => [
                'nullable',
                'string',// TODO 又はnumeric
                'max:191',
            ],
            'mourning_flag' => [
                'required',
                'boolean',
            ],
            'likes_and_dislikes' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'store_id' => [
                'required',
                'numeric',
                'exists:stores,id',
                'store_id',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return \Lang::get('attributes.customers');
    }
}
