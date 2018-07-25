<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PrefectureRepository;
use App\Services\Collection\DomainCollection;

final class Prefecture
{
    /** @var PrefectureRepository */
    private $repo;

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
     * @return DomainCollection
     */
    public function companies(): DomainCollection
    {
        return $this->repo->companies();
    }

    /**
     * @return DomainCollection
     */
    public function customers(): DomainCollection
    {
        return $this->repo->customers();
    }

    /**
     * @return DomainCollection
     */
    public function stores(): DomainCollection
    {
        return $this->repo->stores();
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
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new PrefectureRepository))->propertiesByArray($attributes);
    }

    /**
     * @param array $attributes
     * @return array
     */
    public static function domainizeAttributes(array $attributes = []): array
    {
        $attributes = collect($attributes);

        if ($attributes->has($key = 'test')) {
//             $attributes->put($key, 'test');
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
