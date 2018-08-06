<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\RoleRepository;
use App\Services\DomainCollection;

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
        $this->repo = is_null($repo) ? new RoleRepository : $repo;
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
     * @return string|null
     */
    public function slug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|array
     * @return bool
     */
    public function slugs($arg): bool
    {
        $args = is_array($arg) ? $arg : [$arg];

        foreach ($args as $slug) {
            if ($this->slug === $slug) return true;
        }

        return false;
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        return $this->repo->users();
    }

    /**
     * @param RoleRepository $repo
     * @return self
     */
    public static function of(RoleRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new RoleRepository))->propertiesByArray($args);
    }

    /**
     * @param array $args
     * @return array
     */
    public static function domainizeAttributes(array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'test')) {
//             $args->put($key, 'test');
        }

        return $args->all();
    }

    /**
     * @param array $args
     * @return self
     */
    private function propertiesByArray(array $args = []): self
    {
        $args = collect($args);

        if ($args->has($key = 'id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'slug')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'deleted_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        return $this;
    }

}
