<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers\Postcards;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExportRequest extends FormRequest
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
            'mode' => [
                'required',
                'numeric',
                'max:3',
                'in:1,2,3',// TODO Validate value.
            ],
            'selection' => [
                'required',
                'string',
                'max:20000',
                'customer_ids_from_csv_string_for_output_postcards',
                // TODO Validate mourning_flag.
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
        return \Lang::get('attributes.customers.postcards');
    }
}
