<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\UserRepository;
use App\Services\Collection\DomainCollection;

final class User
{
    /** @var UserRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Email */
    private $email;

    /** @var string */
    private $code;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param UserRepository $repo
     * @return void
     */
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->propertiesByArray($repo);
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
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
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
     * @return Role
     */
    public function role(): Role
    {
//         return $this->repo->role();
    }

    /**
     * @return DomainCollection
     */
    public function permissions(): DomainCollection
    {
        return $this->repo->permissions();
    }

    /**
     * @param UserRepository
     * @return self
     */
    public static function of(UserRepository $repo): self
    {
        return new self($repo);
    }

    /**
     * @param UserRepository $repo
     * @return void
     */
    private function propertiesByArray(UserRepository $repo): void
    {
        $attributes = collect($repo->attributesToArray());

        if ($attributes->has('id')) {
            $this->id = $attributes->get('id');
        }

        if ($attributes->has('name')) {
            $this->name = $attributes->get('name');
        }

        if ($attributes->has('email')) {
            $this->email = Email::of($attributes->get('email'));
        }

        if ($attributes->has('code')) {
            $this->code = $attributes->get('code');
        }

        if ($attributes->has('created_at')) {
            $this->createdAt = Datetime::of($attributes->get('created_at'));
        }

        if ($attributes->has('updated_at')) {
            $this->updatedAt = Datetime::of($attributes->get('updated_at'));
        }

        if ($attributes->has('deleted_at')) {
            $this->deletedAt = Datetime::of($attributes->get('deleted_at'));
        }

    }

}
