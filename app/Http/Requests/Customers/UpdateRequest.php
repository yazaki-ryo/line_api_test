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
            'last_name' => [
                'required',
                'string',
                'max:191',
            ],
            'first_name' => [
                'required',
                'string',
                'max:191',
            ],
            'last_name_kana' => [
                'nullable',
                'string',
                'zenkaku_katakana',
                'max:191',
            ],
            'first_name_kana' => [
                'nullable',
                'string',
                'zenkaku_katakana',
                'max:191',
            ],
            'sex_id' => [
                'nullable',
                'numeric',
                Rule::exists('sexes', 'id'),
            ],
            'office' => [
                'nullable',
                'string',
                'max:191',
            ],
            'office_kana' => [
                'nullable',
                'string',
                'zenkaku_katakana',
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
                'postal_code',
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
            'building' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'tel' => [
                'required',
                'numeric',
                'digits_between:1,11',
            ],
            'fax' => [
                'nullable',
                'numeric',
                'digits_between:1,11',
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
            ],
            'mobile_phone' => [
                'nullable',
                'numeric',
                'digits_between:1,11',
            ],
            'mourning_flag' => [
                'required',
                'boolean',
            ],
            'birthday' => [
                'nullable',
                'string',
                'max:10',
                'date_format:Y-m-d',
                sprintf('before_or_equal:%s', now()->format('Y-m-d')),
            ],
            'anniversary' => [
                'nullable',
                'string',
                'max:10',
                'date_format:Y-m-d',
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
        return \Lang::get('attributes.customers');
    }

    /**
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $this->errorBag = camel_case(class_basename(__CLASS__));
    }
}
