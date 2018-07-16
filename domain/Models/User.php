<?php
declare(strict_types=1);

namespace Domain\Models;

use Illuminate\Support\Collection;

final class User
{
    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var Role */
    private $role;

    /** @var Collection */
    private $permissions;

    /**
     * @param string $name
     * @param Email $email
     * @param Role $role
     * @return void
     */
    public function __construct(string $name, Email $email, Role $role, Collection $permissions)
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->role;
    }

    /**
     * @return Collection
     */
    public function permissions(): Collection
    {
        return $this->permissions;
    }

    /**
     *
     * @param array $values
     * @return self
     */
    public static function ofByArray(array $values): self
    {
        return new self(
            $values['name'] ?? '',
            Email::of($values['email'] ?? ''),
            $values['role'],
            $values['permissions']
        );
    }
}
