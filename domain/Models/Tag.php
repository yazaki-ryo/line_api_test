<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\TagRepository;
use App\Services\DomainCollection;

final class Tag extends DomainModel
{
    /** @var TagRepository */
    protected $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param TagRepository $repo
     * @return void
     */
    public function __construct(TagRepository $repo)
    {
        $this->repo = is_null($repo) ? new TagRepository : $repo;
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
     * @param  array $args
     * @return DomainCollection
     */
    public function customers(array $args = []): DomainCollection
    {
        return $this->repo->customers($args);
    }

    /**
     * @param TagRepository $repo
     * @return self
     */
    public static function of(TagRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new TagRepository))->propertiesByArray($args);
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
    protected function propertiesByArray(array $args = []): self
    {
        $args = collect($args);

        if ($args->has($key = 'id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'name')) {
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
