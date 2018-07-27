<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\StoreRepository;
use App\Services\Collection\DomainCollection;

final class Store
{
    /** @var StoreRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $kana;

    /** @var string */
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
     * @return string|null
     */
    public function postalCode(): ?string
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
     * @return Company|null
     */
    public function company(): ?Company
    {
        return $this->repo->company();
    }

    /**
     * @return Prefecture|null
     */
    public function prefecture(): ?Prefecture
    {
        return $this->repo->prefecture();
    }

    /**
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        return $this->repo->users();
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
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new StoreRepository))->propertiesByArray($attributes);
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

        if ($attributes->has($key = 'kana')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'postal_code')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'address')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'building_name')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'tel')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'fax')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'email')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Email::of($attributes->get($key));
        }

        if ($attributes->has($key = 'payment_flag')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$attributes->get($key));
        }

        if ($attributes->has($key = 'user_limit')) {
            $this->{$camel = camel_case($key)} = Count::of($attributes->get($key));
        }

        if ($attributes->has($key = 'starts_at')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'ends_at')) {
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Datetime::of($attributes->get($key));
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
