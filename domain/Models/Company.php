<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\CompanyRepository;
use App\Services\Collection\DomainCollection;

final class Company
{
    /** @var CompanyRepository */
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

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param CompanyRepository|null $repo
     * @return void
     */
    public function __construct(CompanyRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new CompanyRepository : $repo;
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
     * @return string
     */
    public function kana(): string
    {
        return $this->kana;
    }

    /**
     * @return string
     */
    public function postalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function buildingName(): string
    {
        return $this->buildingName;
    }

    /**
     * @return string
     */
    public function tel(): string
    {
        return $this->tel;
    }

    /**
     * @return string
     */
    public function fax(): string
    {
        return $this->fax;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return Datetime
     */
    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime
     */
    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return Datetime
     */
    public function deletedAt(): Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @return Plan
     */
    public function plan(): Plan
    {
        return $this->repo->plan();
    }

    /**
     * @return Prefecture
     */
    public function prefecture(): Prefecture
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
     * @param CompanyRepository $repo
     * @return self
     */
    public static function of(CompanyRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new CompanyRepository))->propertiesByArray($attributes);
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
            $this->{$camel = camel_case($key)} = Email::of($attributes->get($key));
        }

        if ($attributes->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }

        if ($attributes->has($key = 'deleted_at')) {
            $this->{$camel = camel_case($key)} = Datetime::of($attributes->get($key));
        }

        return $this;
    }

}
