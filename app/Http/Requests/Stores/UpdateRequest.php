<?php
declare(strict_types=1);

namespace App\Http\Requests\Stores;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class UpdateRequest extends FormRequest
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
                'zenkaku_katakana',
                'max:191',
            ],
            'personal_name' => [
                'string',
                'max:191',
            ],
            'postal_code' => [
                'required',
                'postal_code',
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
        return \Lang::get('attributes.stores');
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $this->errorBag = snake_case(studly_case(strtr(str_after(__CLASS__, 'App\\Http\\Requests\\'), '\\', '_')));
    }
}
