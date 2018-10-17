<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\ReservationRepository;

final class Reservation extends DomainModel
{
    /** @var ReservationRepository */
    protected $repo;

    /** @var int */
    private $id;

    /** @var Datetime */
    private $visitedAt;

    /** @var string */
    private $seat;

    /** @var int */
    private $amount;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var int */
    private $customerId;

    /**
     * @param ReservationRepository|null $repo
     * @return void
     */
    public function __construct(ReservationRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new ReservationRepository : $repo;
    }

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return Datetime|null
     */
    public function visitedAt(): ?Datetime
    {
        return $this->visitedAt;
    }

    /**
     * @return string|null
     */
    public function seat(): ?string
    {
        return $this->seat;
    }

    /**
     * @return int|null
     */
    public function amount(): ?int
    {
        return $this->amount;
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
     * @return Customer|null
     */
    public function customer(): ?Customer
    {
        return $this->repo->customer();
    }

    /**
     * @return int|null
     */
    public function customerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param ReservationRepository $repo
     * @return self
     */
    public static function of(ReservationRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new ReservationRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'visited_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'seat')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'amount')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'customer_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

}
