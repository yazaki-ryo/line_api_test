<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\StoreRepository;
use App\Services\DomainCollection;

final class Store extends DomainModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $kana;

    /** @var string */
    private $personalName;

    /** @var PostalCode */
    private $postalCode;

    /** @var string */
    private $address;

    /** @var string */
    private $building;

    /** @var string */
    private $tel;

    /** @var string */
    private $fax;

    /** @var Email */
    private $email;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /** @var int */
    private $companyId;

    /** @var int */
    private $prefectureId;

    /**
     * @param StoreRepository $repo
     * @return void
     */
    public function __construct(StoreRepository $repo)
    {
        $this->repo = is_null($repo) ? new StoreRepository : $repo;
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
    public function kana(): ?string
    {
        return $this->kana;
    }

    /**
     * @return string|null
     * @export
     */
    public function personalName(): ?string
    {
        return $this->personalName;
    }

    /**
     * @return PostalCode|null
     * @export
     */
    public function postalCode(): ?PostalCode
    {
        return $this->postalCode;
    }

    /**
     * @return string|null
     * @export
     */
    public function address(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     * @export
     */
    public function building(): ?string
    {
        return $this->building;
    }

    /**
     * @return string|null
     * @export
     */
    public function tel(): ?string
    {
        return $this->tel;
    }

    /**
     * @return string|null
     * @export
     */
    public function fax(): ?string
    {
        return $this->fax;
    }

    /**
     * @return Email|null
     * @export
     */
    public function email(): ?Email
    {
        return $this->email;
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
     * @return int|null
     * @export
     */
    public function companyId(): ?int
    {
        return $this->companyId;
    }

    /**
     * @return Company|null
     * @export
     */
    public function company(): ?Company
    {
        return $this->repo->company();
    }

    /**
     * @return int|null
     * @export
     */
    public function prefectureId(): ?int
    {
        return $this->prefectureId;
    }

    /**
     * @return Prefecture|null
     * @export
     */
    public function prefecture(): ?Prefecture
    {
        return $this->repo->prefecture();
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
     * @return int
     */
    public function numCustomers(array $args = []): int
    {
        return $this->repo->numCustomers($args);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function reservations(array $args = []): DomainCollection
    {
        return $this->repo->reservations($args);
    }

    /**
     * @param  array $args
     * @return int
     */
    public function numReservations(array $args = []): int
    {
        return $this->repo->numReservations($args);
    }
    
    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function tags(array $args = []): DomainCollection
    {
        return $this->repo->tags($args);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function seats(array $args = []): DomainCollection
    {
        return $this->repo->seats($args);
    }

    /**
     * @param  array $args
     * @return Customer
     */
    public function addCustomer(array $args = []): Customer
    {
        return $this->repo->addCustomer($args);
    }

    /**
     * @param  array $args
     * @return Reservation
     */
    public function addReservation(array $args = []): Reservation
    {
        return $this->repo->addReservation($args);
    }

    /**
     * @param  array $args
     * @return Tag
     */
    public function addTag(array $args = []): Tag
    {
        return $this->repo->addTag($args);
    }

    /**
     * @param  array $args
     * @return Seat
     */
    public function addSeat(array $args = []): Seat
    {
        return $this->repo->addSeat($args);
    }

    /**
     * @param  array $args
     * @return User
     */
    public function addUser(array $args = []): User
    {
        return $this->repo->addUser($args);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function users(array $args = []): DomainCollection
    {
        return $this->repo->users($args);
    }

    /**
     * @param StoreRepository $repo
     * @return self
     */
    public static function of(StoreRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new StoreRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'kana')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'personal_name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'postal_code')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : PostalCode::of($args->get($key));
        }

        if ($args->has($key = 'address')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'building')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'tel')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'fax')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'email')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Email::of($args->get($key));
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

        if ($args->has($key = 'company_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'prefecture_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

    /**
     * @param User $user
     * @param int $value
     * @return bool
     */
    public static function validateStoreId(User $user, int $value): bool
    {
        if (is_null($store = $user->store())
            || is_null($company = $store->company())
        ) {
            return false;
        }

        if ($user->can('authorize', 'stores.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-stores.select')) {
            if ($company->stores()->containsStrict(function ($item) use ($value) {
                return $item->id() === $value;
            })) {
                return true;
            }
        } elseif ($user->can('authorize', 'own-company-self-store.select')) {
            if ($store->id() === $value) {
                return true;
            }
        }

        return false;
    }

}
