<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers\Files;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class ImportRequest extends FormRequest
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
            'csv_file' => [
                'required',
//                 'file',// TODO require parse.
//                 'mimes:text/csv',// TODO require parse.
                'max:10240',
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
        return \Lang::get('attributes.customers.files');
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
