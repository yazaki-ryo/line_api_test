<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers\Postcards;

use Domain\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class ExportRequest extends FormRequest
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
        /** @var User $user */
        $user = request()->assign();

        return [
            'mode' => [
                'required',
                'string',
                'in:export,preview',
            ],
            'setting' => [
                'required',
                'numeric',
                Rule::in($user->printSettings()->domainizePrintSettings(true)->keys()->all()),
            ],
            'selection' => [
                'required',
                'array',
                // 'customer_id', // バグがあるため無効化
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
            'mode.in' => __('validation.invalid'),
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

    /**
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $this->errorBag = snake_case(studly_case(strtr(str_after(__CLASS__, 'App\\Http\\Requests\\'), '\\', '_')));
    }
}
