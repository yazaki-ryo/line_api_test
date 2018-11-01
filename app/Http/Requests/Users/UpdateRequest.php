<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Repositories\UserRepository;
use Domain\Models\User;
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
        /** @var User $user */
        $user = UserRepository::toModel($this->user());

        if (is_null($userId = $this->route()->parameter('userId'))) {
            throw new InvalidArgumentException('There is no user ID in the route parameter.');
        }

        return [
            'role' => [
                'sometimes',
                $user->cant('authorize', config('permissions.groups.users.create')) || $user->id() === (int)$userId ? 'invalid' : 'required',
                'string',
                Rule::in(array_keys(config('permissions.roles.general'))),
                // TODO by permissions
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
        return \Lang::get('attributes.users');
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
