<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\CustomerRepository;
use App\Services\DomainCollection;

final class Customer extends DomainModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $lastName;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastNameKana;

    /** @var string */
    private $firstNameKana;

    /** @var string */
    private $office;

    /** @var string */
    private $officeKana;

    /** @var string */
    private $department;

    /** @var string */
    private $position;

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

    /** @var string */
    private $mobilePhone;

    /** @var Datetime */
    private $mournedAt;

    /** @var Datetime */
    private $birthday;

    /** @var Datetime */
    private $anniversary;

    /** @var string */
    private $likesAndDislikes;

    /** @var string */
    private $note;

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
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function firstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function lastNameKana(): ?string
    {
        return $this->lastNameKana;
    }

    /**
     * @return string|null
     */
    public function firstNameKana(): ?string
    {
        return $this->firstNameKana;
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
    public function officeKana(): ?string
    {
        return $this->officeKana;
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
     * @return string|null
     */
    public function mobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @return Datetime|null
     */
    public function mournedAt(): ?Datetime
    {
        return $this->mournedAt;
    }

    /**
     * @return Datetime|null
     */
    public function birthday(): ?Datetime
    {
        return $this->birthday;
    }

    /**
     * @return Datetime|null
     */
    public function anniversary(): ?Datetime
    {
        return $this->anniversary;
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
     * @param  array $args
     * @return DomainCollection
     */
    public function reservations(array $args = []): DomainCollection
    {
        return $this->repo->reservations($args);
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
    public function visitedHistories(array $args = []): DomainCollection
    {
        return $this->repo->visitedHistories($args);
    }

    /**
     * @param  array $args
     * @return VisitedHistory
     */
    public function addVisitedHistory(array $args = []): VisitedHistory
    {
        return $this->repo->addVisitedHistory($args);
    }

    /**
     * @param string $column
     * @param bool $arg
     * @return void
     */
    public function toggleTimestamp(string $column, bool $arg)
    {
        if ($arg === true && is_null($this->{$camel = camel_case($column)}())) {
            $this->update([$column => now()]);
        } elseif ($arg === false && !empty($this->{$camel = camel_case($column)}())) {
            $this->update([$column => null]);
        }
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->visitedHistories()->destroy();
        $this->reservations()->destroy();
        $this->sync('tags', []);

        parent::delete();
    }

    /**
     * @param  CustomerRepository $repo
     * @return  self
     */
    public static function of(CustomerRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new CustomerRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'last_name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'first_name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'last_name_kana')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'first_name_kana')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'office')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'office_kana')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'department')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'position')) {
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

        if ($args->has($key = 'mobile_phone')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'mourned_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'birthday')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'anniversary')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'likes_and_dislikes')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'note')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'cancel_cnt')) {
            $this->{$camel = camel_case($key)} = Count::of($args->get($key));
        }

        if ($args->has($key = 'noshow_cnt')) {
            $this->{$camel = camel_case($key)} = Count::of($args->get($key));
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

        if ($args->has($key = 'prefecture_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'sex_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'store_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

    /**
     * @param User $user
     * @param int $value
     * @return bool
     */
    public static function validateCustomerId(User $user, int $value): bool
    {
        if (is_null($store = $user->store())
            || is_null($company = $store->company())
        ) {
            return false;
        }

        if ($user->can('authorize', 'customers.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers.select')) {
            if ($company->customers()->containsStrict(function ($item) use ($value) {
                return $item->id() === $value;
            })) {
                return true;
            }
        } elseif ($user->can('authorize', 'own-company-self-store-customers.select')) {
            if ($store->customers()->containsStrict(function ($item) use ($value) {
                return $item->id() === $value;
            })) {
                return true;
            }
        }

        return false;
    }

}
