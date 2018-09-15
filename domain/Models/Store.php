<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\StoreRepository;
use App\Services\DomainCollection;

final class Store extends DomainModel
{
    /** @var StoreRepository */
    protected $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $kana;

    /** @var PostalCode */
    private $postalCode;

    /** @var string */
    private $address;

    /** @var string */
    private $buildingName;

    /** @var string */
    private $tel;

    /** @var string */
    private $fax;

    /** @var Email */
    private $email;

    /** @var Flag */
    private $paymentFlag;

    /** @var Count */
    private $userLimit;

    /** @var Datetime */
    private $startsAt;

    /** @var Datetime */
    private $endsAt;

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
    public function kana(): ?string
    {
        return $this->kana;
    }

    /**
     * @return PostalCode|null
     */
    public function postalCode(): ?PostalCode
    {
        return $this->postalCode;
    }

    /**
     * @return string|null
     */
    public function address(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function buildingName(): ?string
    {
        return $this->buildingName;
    }

    /**
     * @return string|null
     */
    public function tel(): ?string
    {
        return $this->tel;
    }

    /**
     * @return string|null
     */
    public function fax(): ?string
    {
        return $this->fax;
    }

    /**
     * @return Email|null
     */
    public function email(): ?Email
    {
        return $this->email;
    }

    /**
     * @return Flag|null
     */
    public function paymentFlag(): ?Flag
    {
        return $this->paymentFlag;
    }

    /**
     * @return Count|null
     */
    public function userLimit(): ?Count
    {
        return $this->userLimit;
    }

    /**
     * @return Datetime|null
     */
    public function startsAt(): ?Datetime
    {
        return $this->startsAt;
    }

    /**
     * @return Datetime|null
     */
    public function endsAt(): ?Datetime
    {
        return $this->endsAt;
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
     * @return int|null
     */
    public function companyId(): ?int
    {
        return $this->companyId;
    }

    /**
     * @return Company|null
     */
    public function company(): ?Company
    {
        return $this->repo->company();
    }

    /**
     * @return int|null
     */
    public function prefectureId(): ?int
    {
        return $this->prefectureId;
    }

    /**
     * @return Prefecture|null
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

        if ($args->has($key = 'postal_code')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : PostalCode::of($args->get($key));
        }

        if ($args->has($key = 'address')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'building_name')) {
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

        if ($args->has($key = 'payment_flag')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$args->get($key));
        }

        if ($args->has($key = 'user_limit')) {
            $this->{$camel = camel_case($key)} = Count::of($args->get($key));
        }

        if ($args->has($key = 'starts_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'ends_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
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

        if ($user->can('roles', 'company-admin')) {
            if ($company->stores()->containsStrict(function ($item) use ($value) {
                return $item->id() === $value;
            })) {
                return true;
            }
        } else {
            if ($store->id() === $value) {
                return true;
            }
        }

        return false;
    }

}
