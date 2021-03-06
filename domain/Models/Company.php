<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\CompanyRepository;
use App\Services\DomainCollection;

final class Company extends DomainModel
{
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
    private $building;

    /** @var string */
    private $tel;

    /** @var string */
    private $fax;

    /** @var Email */
    private $email;

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
    private $planId;

    /** @var int */
    private $prefectureId;

    /**
     * @param CompanyRepository|null $repo
     * @return void
     */
    public function __construct(CompanyRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new CompanyRepository : $repo;
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
    public function building(): ?string
    {
        return $this->building;
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
    public function planId(): ?int
    {
        return $this->planId;
    }

    /**
     * @return Plan|null
     */
    public function plan(): ?Plan
    {
        return $this->repo->plan();
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
    public function stores(array $args = []): DomainCollection
    {
        return $this->repo->stores($args);
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
    public function users(array $args = []): DomainCollection
    {
        return $this->repo->users($args);
    }

    /**
     * @param CompanyRepository $repo
     * @return self
     */
    public static function of(CompanyRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new CompanyRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'plan_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'prefecture_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

}
