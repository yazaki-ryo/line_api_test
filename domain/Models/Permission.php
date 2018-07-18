<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PermissionRepository;
use App\Services\Collection\DomainCollection;

final class Permission
{
    /** @var PermissionRepository */
    private $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $slug;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /** @var Datetime */
    private $deletedAt;

    /**
     * @param PermissionRepository $repo
     * @return void
     */
    public function __construct(PermissionRepository $repo)
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
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        return $this->repo->users();
    }

    /**
     * @param PermissionRepository
     * @return self
     */
    public static function of(PermissionRepository $repo): self
    {
        return new self($repo);
    }

    /**
     * @param PermissionRepository $repo
     * @return void
     */
    private function propertiesByArray(PermissionRepository $repo): void
    {
        $attributes = collect($repo->attributesToArray());

        if ($attributes->has('id')) {
            $this->id = $attributes->get('id');
        }

        if ($attributes->has('name')) {
            $this->name = $attributes->get('name');
        }

        if ($attributes->has('slug')) {
            $this->slug = $attributes->get('slug');
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
