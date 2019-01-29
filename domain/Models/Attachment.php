<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\AttachmentRepository;

final class Attachment extends DomainModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $path;

    /** @var string */
    private $name;

    /** @var int */
    private $attachmentableId;

    /** @var string */
    private $attachmentableType;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /**
     * @param AttachmentRepository|null $repo
     * @return void
     */
    public function __construct(AttachmentRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new AttachmentRepository : $repo;
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
    public function path(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function attachmentableId(): ?int
    {
        return $this->attachmentableId;
    }

    /**
     * @return string|null
     */
    public function attachmentableType(): ?string
    {
        return $this->attachmentableType;
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
     * @return mixed DomainModel
     */
    public function attachmentable(): DomainModel
    {
        return $this->repo->attachmentable();
    }

    /**
     * @param AttachmentRepository $repo
     * @return self
     */
    public static function of(AttachmentRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new AttachmentRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'path')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'attachmentable_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'attachmentable_type')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        return $this;
    }

}
