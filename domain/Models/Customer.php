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

    /** @var int */
    private $prefectureId;

    /** @var int */
    private $sexId;

    /** @var int */
    private $storeId;

    /**
     * @param CustomerRepository|null $repo
     * @return void
     */
    public function __construct(CustomerRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new CustomerRepository : $repo;
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
     * @return int|null
     */
    public function age(): ?int
    {
        return $this->age;
    }

    /**
     * @return string|null
     */
    public function office(): ?string
    {
        return $this->office;
    }

    /**
     * @return string|null
     */
    public function department(): ?string
    {
        return $this->department;
    }

    /**
     * @return string|null
     */
    public function position(): ?string
    {
        return $this->position;
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
     * @return string|null
     */
    public function mobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @return Flag|null
     */
    public function mourningFlag(): ?Flag
    {
        return $this->mourningFlag;
    }

    /**
     * @return string|null
     */
    public function likesAndDislikes(): ?string
    {
        return $this->likesAndDislikes;
    }

    /**
     * @return string|null
     */
    public function note(): ?string
    {
        return $this->note;
    }

    /**
     * @return Count|null
     */
    public function visitedCnt(): ?Count
    {
        return $this->visitedCnt;
    }

    /**
     * @return Count|null
     */
    public function cancelCnt(): ?Count
    {
        return $this->cancelCnt;
    }

    /**
     * @return Count|null
     */
    public function noshowCnt(): ?Count
    {
        return $this->noshowCnt;
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
     * @return int|null
     */
    public function sexId(): ?int
    {
        return $this->sexId;
    }

    /**
     * @return Sex|null
     */
    public function sex(): ?Sex
    {
        return $this->repo->sex();
    }

    /**
     * @return int|null
     */
    public function storeId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @return Store|null
     */
    public function store(): ?Store
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
            $this->{$camel = camel_case($key)} = is_null($attributes->get($key)) ? null : Email::of($attributes->get($key));
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

        if ($attributes->has($key = 'prefecture_id')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'sex_id')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        if ($attributes->has($key = 'store_id')) {
            $this->{$camel = camel_case($key)} = $attributes->get($key);
        }

        return $this;
    }

}
