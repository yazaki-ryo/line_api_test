<?php
declare(strict_types=1);

namespace App\Http\Requests\Seats;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use InvalidArgumentException;

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
     * @throws InvalidArgumentException
     */
    public function rules(): array
    {
        if (is_null($seatId = $this->route()->parameter('seatId'))) {
            throw new InvalidArgumentException('There is no seat ID in the route parameter.');
        }

        return [
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('seats')
                    ->ignore($seatId)
                    ->where(function (Builder $query) {
                        return $query->where('store_id', $this->cookie(config('cookie.name.current_store')));
                    }),
            ],
            'floor' => [
                'required',
                'numeric',
                'digits_between:1,100',
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
        return \Lang::get('attributes.seats');
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
