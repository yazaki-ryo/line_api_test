<?php
declare(strict_types=1);

namespace Domain\Models;

use Illuminate\Support\Collection;

final class User
{
    /** @var Email */
    private $email;

    /** @var string */
    private $name;

    /** @var Collection */
    private $permissions;

    /**
     * @param Email $email
     * @param string $name
     * @return void
     */
    public function __construct(Email $email, string $name, Collection $permissions)
    {
        $this->email = $email;
        $this->name = $name;
        $this->permissions = $permissions;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
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
            Email::of($values['email'] ?? ''),
            $values['name'] ?? '',
            $values['permissions']
        );
    }
}
