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
//             'plan_id'               => 'プラン',
//             'prefecture_id'         => '都道府県',
//             'name'                  => '名称',
//             'kana'                  => 'フリガナ',
//             'postal_code'           => '郵便番号',
//             'address'               => '住所',
//             'building_name'         => '建物名',
//             'tel'                   => 'TEL',
//             'fax'                   => 'FAX',
//             'email'                 => 'メールアドレス',
//             'created_at'            => '登録日時',
//             'updated_at'            => '更新日時',
//             'deleted_at'            => '削除日時',

        return [
            'name' => [
                'required',
                'string',
                'max:191',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('users')->ignore(auth()->user()->getAuthIdentifier()),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:16',
                'confirmed',
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
