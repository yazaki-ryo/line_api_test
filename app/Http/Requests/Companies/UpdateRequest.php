<?php
declare(strict_types=1);

namespace App\Http\Requests\Companies;

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
                'required',
                'string',
                // TODO フリガナバリデートルール
                'max:191',
            ],
            'postal_code' => [
                'required',
                // TODO 数値とハイフンバリデート（郵便番号正規表現の方が良いか、又はハイフン無しで限定した方が良いか）
                'max:191',
            ],
            'prefecture_id' => [
                'required',
                Rule::exists('prefectures', 'id'),
            ],
            'address' => [
                'required',
                'max:1000',
            ],
            'building_name' => [
                'max:1000',
            ],
            'tel' => [
                'required',
//                 'numeric',
                'max:191',
            ],
            'fax' => [
//                 'numeric',
                'max:191',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:191',
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
        return \Lang::get('attributes.companies');
    }
}
