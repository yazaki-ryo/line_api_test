<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PrefectureRepository;
use App\Services\DomainCollection;

final class Prefecture extends DomainModel
{
    /** @var PrefectureRepository */
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
     * @param PrefectureRepository $repo
     * @return void
     */
    public function __construct(PrefectureRepository $repo)
    {
        $this->repo = is_null($repo) ? new PrefectureRepository : $repo;
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
    public function companies(array $args = []): DomainCollection
    {
        return $this->repo->companies($args);
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
     * @param  array $args
     * @return DomainCollection
     */
    public function stores(array $args = []): DomainCollection
    {
        return $this->repo->stores($args);
    }

    /**
     * @param PrefectureRepository $repo
     * @return self
     */
    public static function of(PrefectureRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new PrefectureRepository))->propertiesByArray($args);
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
