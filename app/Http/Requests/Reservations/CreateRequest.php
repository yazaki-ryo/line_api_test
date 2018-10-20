<?php
declare(strict_types=1);

namespace App\Http\Requests\Reservations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'reserved_date' => [
                'required',
                'string',
                'max:10',
                'date_format:Y-m-d',
            ],
            'reserved_time' => [
                'nullable',
                'string',
                'max:5',
                'date_format:H:i',
            ],
            'amount' => [
                'nullable',
                'numeric',

            ],
            'seat' => [
                'nullable',
                'string',
                'max:191',
            ],
            'reservation_code' => [
                'nullable',
                'string',
                'max:191',
            ],
            'floor' => [
                'nullable',
                'numeric',

            ],
            'status' => [
                // TODO validate
//                 'required',

            ],
            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'customer_id' => [
                'nullable',
                'numeric',
                Rule::exists('customers', 'id'),
                'customer_id',
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
        return \Lang::get('attributes.reservations');
    }
}
