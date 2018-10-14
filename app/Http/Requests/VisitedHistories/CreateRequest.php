<?php
declare(strict_types=1);

namespace App\Http\Requests\VisitedHistories;

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
            'visited_date' => [
                'required',
                'string',
                'max:10',
                'date_format:Y-m-d',
                sprintf('before_or_equal:%s', now()->format('Y-m-d')),
            ],
            'visited_time' => [
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
            'customer_id' => [
                'required',
                'numeric',
                Rule::exists('customers', 'id'),
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
        return \Lang::get('attributes.customers.visited_histories');
    }
}
