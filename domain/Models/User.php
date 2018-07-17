<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\UserRepository;
use App\Services\Collection\DomainCollection;

final class User
{
    /** @var UserRepository */
    private $repo;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var Role */
    private $role;

    /** @var DomainCollection */
    private $permissions;

    /**
     * @param UserRepository $repo
     * @return void
     */
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;

        /**
         * XXX TODO リレーション以外のeloquentプロパティをこの辺りでモデルプロパティへセットする方法考案
         */
    }

    /**
     * @return string
     */
    public function name(): string
    {
//         return $this->repo->name();
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
//         return $this->repo->email();
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
//         return $this->repo->role();
    }

    /**
     * @return DomainCollection
     */
    public function permissions(): DomainCollection
    {
        return $this->repo->permissions();
    }

    /**
     * @param UserRepository
     * @return self
     */
    public static function of(UserRepository $repo): self
    {
        return new self($repo);
    }

}
