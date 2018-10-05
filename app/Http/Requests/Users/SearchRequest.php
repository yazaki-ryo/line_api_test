<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Repositories\UserRepository;
use Domain\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    /** @var User */
    private $user;

    /**
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        /** @var User $user */
        $this->user = UserRepository::toModel($auth->user());
    }

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
            'trashed' => [
                'nullable',
                'string',
                'max:191',
                Rule::in(array_keys(\Lang::get('attributes.trashed'))),
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
        return \Lang::get('attributes.users.search');
    }
}
