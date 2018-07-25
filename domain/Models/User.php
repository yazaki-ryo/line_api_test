<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\UserRepository;
use App\Services\Collection\DomainCollection;

final class User
{
    /** @var UserRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param UserRepository|null $repo
     * @return void
     */
    public function __construct(UserRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new UserRepository : $repo;
    }

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return Email|null
     */
    public function email(): ?Email
    {
        return $this->email;
    }

    /**
     * @return Datetime|null
     */
    public function createdAt(): ?Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime|null
     */
    public function updatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return Datetime|null
     */
    public function deletedAt(): ?Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @return Role|null
     */
    public function role(): ?Role
    {
        return $this->repo->role();
    }

    /**
     * @return Store|null
     */
    public function store(): ?Store
    {
        return $this->repo->store();
    }

    /**
     * @return Company|null
     */
    public function company(): ?Company
    {
        return $this->repo->company();
    }

    /**
     * @return DomainCollection
     */
    public function permissions(): DomainCollection
    {
        return $this->repo->permissions();
    }

    /**
     * @param UserRepository $repo
     * @return self
     */
    public static function of(UserRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new UserRepository))->propertiesByArray($attributes);
    }

    /**
     * @param array $attributes
     * @return array
     */
    public static function domainizeAttributes(array $attributes = []): array
    {
        $attributes = collect($attributes);

        if ($attributes->has($key = 'password')) {
            $attributes->put($key, bcrypt($attributes->get($key)));
        }

        return $attributes->all();
    }

    /**
     * @param array $attributes
     * @return self
     */
    private function propertiesByArray(array $attributes = []): self
    {
        $attributes = collect($attributes);

        if ($attributes->has($key = 'id')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'name')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'email')) {
            $this->{$camel = camel_case($key)} = Email::of($attributes->get($key));
        }

        if ($attributes->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'deleted_at')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Datetime::of($attributes->get($key));
        }

        return $this;
    }

}
