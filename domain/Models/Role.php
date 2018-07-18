<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\RoleRepository;
use App\Services\Collection\DomainCollection;

final class Role
{
    /** @var RoleRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $slug;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param RoleRepository $repo
     * @return void
     */
    public function __construct(RoleRepository $repo)
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
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        return $this->repo->users();
    }

    /**
     * @param RoleRepository
     * @return self
     */
    public static function of(RoleRepository $repo): self
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

        if ($attributes->has($key = 'slug')) {
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
