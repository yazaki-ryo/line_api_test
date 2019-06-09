<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\ReservationRepository;

final class Reservation extends DomainModel
{
    /** @var int */
    private $id;

    /** @var Datetime */
    private $reservedAt;

    /** @var string */
    private $name;

    /** @var string */
    private $seat;

    /** @var int */
    private $amount;

    /** @var string */
    private $reservationCode;

    /** @var int */
    private $floor;

    /** @var int */
    private $status;

    /** @var string */
    private $note;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /** @var int */
    private $storeId;

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
     * @export
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return Datetime|null
     * @export
     */
    public function reservedAt(): ?Datetime
    {
        return $this->reservedAt;
    }

    /**
     * @return string|null
     * @export
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @export
     */
    public function seat(): ?string
    {
        return $this->seat;
    }

    /**
     * @return int|null
     * @export
     */
    public function amount(): ?int
    {
        return $this->amount;
    }

    /**
     * @return string|null
     * @export
     */
    public function reservationCode(): ?string
    {
        return $this->reservationCode;
    }

    /**
     * @return int|null
     * @export
     */
    public function floor(): ?int
    {
        return $this->floor;
    }

    /**
     * @return int|null
     * @export
     */
    public function status(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     * @export
     */
    public function note(): ?string
    {
        return $this->note;
    }

    /**
     * @return Datetime|null
     * @export
     */
    public function createdAt(): ?Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime|null
     * @export
     */
    public function updatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return Datetime|null
     * @export
     */
    public function deletedAt(): ?Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @return Store|null
     */
    public function store(): ?Store
    {
        return $this->repo->store();
    }

    /**
     * @return int|null
     * @export
     */
    public function storeId(): ?int
    {
        return $this->storeId;
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
     * @export
     */
    public function customerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @return VisitedHistory|null
     */
    public function visitedHistory(): ?VisitedHistory
    {
        return $this->repo->visitedHistory();
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

        if ($args->has($key = 'reserved_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'seat')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'amount')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'reservation_code')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'floor')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'status')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'note')) {
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

        if ($args->has($key = 'store_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'customer_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

}
