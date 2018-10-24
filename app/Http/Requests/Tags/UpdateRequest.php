<?php
declare(strict_types=1);

namespace App\Http\Requests\Tags;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

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
     * @throws InvalidArgumentException
     */
    public function rules(): array
    {
        if (is_null($tagId = $this->route()->parameter('tagId'))) {
            throw new InvalidArgumentException('There is no tag ID in the route parameter.');
        }

        return [
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('tags')
                    ->ignore($tagId)
                    ->where(function (Builder $query) {
                        return $query->where('store_id', config('session.name.current_store'));
                    }),
            ],
            'label' => [
                'required',
                'string',
                'max:32',
                Rule::in(array_keys(config('tags.labels'))),
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
        return \Lang::get('attributes.tags');
    }
}
