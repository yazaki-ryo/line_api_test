<?php
declare(strict_types=1);

namespace App\Http\Requests\Tags;

use App\Repositories\UserRepository;
use Domain\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('tags')
                    ->ignore($this->segment(2))
                    ->where(function (Builder $query) {
                        return $query->where('store_id', $this->user->storeId());
                    }),
            ],
            'label' => [
                'required',
                'string',
                'max:32',
                // TODO in array rule.
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
