<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\CustomerRepository;
use App\Services\Collection\DomainCollection;

final class Customer
{
    /** @var CustomerRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $kana;

    /** @var int */
    private $age;

    /** @var string */
    private $office;

    /** @var string */
    private $department;

    /** @var string */
    private $position;

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

    /** @var string */
    private $mobilePhone;

    /** @var Flag */
    private $mourningFlag;

    /** @var string */
    private $likesAndDislikes;

    /** @var string */
    private $note;

    /** @var Count */
    private $visitedCnt;

    /** @var Count */
    private $cancelCnt;

    /** @var Count */
    private $noshowCnt;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param CustomerRepository|null $repo
     * @return void
     */
    public function __construct(CustomerRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new CustomerRepository : $repo;
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
     * @return int
     */
    public function age(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function office(): string
    {
        return $this->office;
    }

    /**
     * @return string
     */
    public function department(): string
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function position(): string
    {
        return $this->position;
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
     * @return string
     */
    public function mobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @return Flag
     */
    public function mourningFlag(): Flag
    {
        return $this->mourningFlag;
    }

    /**
     * @return string
     */
    public function likesAndDislikes(): string
    {
        return $this->likesAndDislikes;
    }

    /**
     * @return string
     */
    public function note(): string
    {
        return $this->note;
    }

    /**
     * @return Count
     */
    public function visitedCnt(): Count
    {
        return $this->visitedCnt;
    }

    /**
     * @return Count
     */
    public function cancelCnt(): Count
    {
        return $this->cancelCnt;
    }

    /**
     * @return Count
     */
    public function noshowCnt(): Count
    {
        return $this->noshowCnt;
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
     * @return Prefecture
     */
    public function prefecture(): Prefecture
    {
        return $this->repo->prefecture();
    }

    /**
     * @return Sex
     */
    public function sex(): Sex
    {
        return $this->repo->sex();
    }

    /**
     * @return Store
     */
    public function store(): Store
    {
        return $this->repo->store();
    }

    /**
     * @param CustomerRepository $repo
     * @return self
     */
    public static function of(CustomerRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $attributes
     * @return self
     */
    public static function ofByArray(array $attributes = []): self
    {
        return (new self(new CustomerRepository))->propertiesByArray($attributes);
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

        if ($attributes->has($key = 'age')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'office')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'department')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'position')) {
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

        if ($attributes->has($key = 'mobile_phone')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'mourning_flag')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$attributes->get($key));
        }

        if ($attributes->has($key = 'likes_and_dislikes')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'note')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'visited_cnt')) {
            $this->{$camel = camel_case($key)} = Count::of($attributes->get($key));
        }

        if ($attributes->has($key = 'cancel_cnt')) {
            $this->{$camel = camel_case($key)} = Count::of($attributes->get($key));
        }

        if ($attributes->has($key = 'noshow_cnt')) {
            $this->{$camel = camel_case($key)} = Count::of($attributes->get($key));
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
