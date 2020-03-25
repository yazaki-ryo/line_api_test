<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class SearchRequest extends FormRequest
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
            'free_word' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'address_flag' => [
                'nullable',
                'string',
            ],
            'visited_date_s' => [
                'nullable',
                'string',
                'max:10',
                'date_format:Y-m-d',
//              'before_or_equal:visited_date_e',
                sprintf('before_or_equal:%s', now()->format('Y-m-d')),
            ],
            'visited_date_e' => [
                'nullable',
                'string',
                'max:10',
                'date_format:Y-m-d',
//              'after_or_equal:visited_date_s',
            ],
            'birthday_s' => [
                'nullable',
                'string',
                'max:10',
                'date_format:m',
            ],
            'birthday_e' => [
                'nullable',
                'string',
                'max:10',
                'date_format:m',
            ],
            'anniversary_s' => [
                'nullable',
                'string',
                'max:10',
                'date_format:m',
            ],
            'anniversary_e' => [
                'nullable',
                'string',
                'max:10',
                'date_format:m',
            ],
            'mourning_flag' => [
                'nullable',
                'boolean',
            ],
            'trashed' => [
                'nullable',
                'string',
                'max:191',
                Rule::in(array_keys(\Lang::get('attributes.trashed'))),
            ],
            'tags' => [
                'nullable',
                'array',
                Rule::exists('tags', 'id')
                    ->where(function (Builder $query) {
                        return $query->where('store_id', $this->cookie(config('cookie.name.current_store')));
                    }),
            ],
            'not_tags' => [
                'nullable',
                'boolean',
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
        return \Lang::get('attributes.customers.search');
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
