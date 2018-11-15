<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\UserRepository;
use App\Services\DomainCollection;
use Domain\Traits\Models\Authorizable;
use Domain\Traits\Models\Notifiable;

final class User extends DomainModel
{
    use Authorizable, Notifiable;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /** @var int */
    private $storeId;

    /**
     * @param UserRepository|null $repo
     * @return void
     */
    public function __construct(UserRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new UserRepository : $repo;
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
     * @return Email|null
     */
    public function email(): ?Email
    {
        return $this->email;
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
     * @param  array $args
     * @return DomainCollection
     */
    public function avatars(array $args = []): DomainCollection
    {
        return $this->repo->avatars($args);
    }

    /**
     * @param  array $args
     * @return Avatar
     */
    public function addAvatar(array $args = []): Avatar
    {
        return $this->repo->addAvatar($args);
    }

    /**
     * @param  array $args
     * @return PrintSetting
     */
    public function addPrintSetting(array $args = []): PrintSetting
    {
        return $this->repo->addPrintSetting($args);
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
     * @return Company|null
     */
    public function company(): ?Company
    {
        return $this->repo->company();
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function permissions(array $args = []): DomainCollection
    {
        return $this->repo->permissions($args);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function printSettings(array $args = []): DomainCollection
    {
        return $this->repo->printSettings($args);
    }

    /**
     * @param string $side
     * @return string
     */
    public function role($side = 'general'): string
    {
        $permissions = $this->permissions();

        foreach (config(sprintf('permissions.default.%s', $side)) as $role => $defaults) {
            $i = count($defaults);
            foreach ($defaults as $permission) {
                if (! $permissions->containsStrict(function (Permission $item) use ($permission) {
                    return $item->slug() === $permission;
                })) {
                    break;
                } elseif (--$i === 0) {
                    return $role;
                }
            }
        }

        return '';
    }

    /**
     * @param UserRepository $repo
     * @return self
     */
    public static function of(UserRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new UserRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'store_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        return $this;
    }

}
