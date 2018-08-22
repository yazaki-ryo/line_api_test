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
                'string',// TODO 数値とハイフンバリデート（郵便番号正規表現の方が良いか、又はハイフン無しで限定した方が良いか）
                'max:191',
            ],
            'prefecture_id' => [
                'required',
                'numeric',
                Rule::exists('prefectures', 'id'),
            ],
            'address' => [
                'required',
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
                'required',
                'string',
                'email',
                'max:191',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     * @return array
     */
    public function attributes(): array
    {
        return \Lang::get('attributes.companies');
    }
}
