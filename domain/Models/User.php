<?php
declare(strict_types=1);

namespace Domain\Models;

use Illuminate\Support\Collection;
use Domain\Contracts\Model\DomainModel;

final class User
{
    /** @var DomainModel */
    private $repo;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var Role */
    private $role;

    /** @var Collection */
    private $permissions;

    /**
     * @param DomainModel $repo
     * @return void
     */
    public function __construct(DomainModel $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->repo->name;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->repo->email;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->repo->role;
    }

    /**
     * @return Collection
     */
    public function permissions(): Collection
    {
        return $this->repo->permissions;
    }

    /**
     * @param DomainModel
     * @return self
     */
    public static function of(DomainModel $repo): self
    {
        return new self($repo);
    }

}
