<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PlanRepository;
use App\Services\Collection\DomainCollection;

final class Plan
{
    /** @var PlanRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Price */
    private $price;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param PlanRepository $repo
     * @return void
     */
    public function __construct(PlanRepository $repo)
    {
        $this->repo = is_null($repo) ? new PlanRepository : $repo;
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
     * @return Price
     */
    public function price(): Price
    {
        return $this->price;
    }

    /**
     * @return Datetime
     */
    public function createdAt(): ?Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime
     */
    public function updatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return Datetime
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
     * @param PlanRepository $repo
     * @return self
     */
    public static function of(PlanRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new PlanRepository))->propertiesByArray($attributes);
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

        if ($attributes->has($key = 'price')) {
            $this->{$camel = camel_case($key)} = Price::of($attributes->get($key));
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
