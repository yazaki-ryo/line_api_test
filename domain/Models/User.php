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

    /** @var string */
    private $code;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param UserRepository $repo
     * @return void
     */
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
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
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return Datetime
     */
    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime
     */
    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return Datetime
     */
    public function deletedAt(): Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->repo->role();
    }

    /**
     * @return Store
     */
    public function store(): Store
    {
        return $this->repo->store();
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

    /**
     * @param array $attributes
     * @return void
     */
    private function propertiesByArray(array $attributes = []): void
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

        if ($attributes->has($key = 'code')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'deleted_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }
    }

}
