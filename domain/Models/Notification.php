<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\NotificationRepository;

final class Notification extends DomainModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $type;

    /** @var string */
    private $data;

    /** @var int */
    private $notifiableId;

    /** @var string */
    private $notifiableType;

    /** @var Datetime */
    private $readAt;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /**
     * @param NotificationRepository $repo
     * @return void
     */
    public function __construct(NotificationRepository $repo)
    {
        $this->repo = is_null($repo) ? new NotificationRepository : $repo;
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
    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function notifiableId(): ?int
    {
        return $this->notifiableId;
    }

    /**
     * @return string|null
     */
    public function notifiableType(): ?string
    {
        return $this->notifiableType;
    }

    /**
     * @return array|null
     */
    public function data(): ?array
    {
        return $this->data;
    }

    /**
     * @return Datetime|null
     */
    public function readAt(): ?Datetime
    {
        return $this->readAt;
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
    public function notifiable(): DomainModel
    {
        return $this->repo->notifiable();
    }

    /**
     * @param NotificationRepository $repo
     * @return self
     */
    public static function of(NotificationRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new NotificationRepository))->propertiesByArray($args);
    }

    /**
     * @param array $args
     * @return array
     */
    public static function domainizeAttributes(array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'test')) {
//             $args->put($key, 'test');
        }

        return $args->all();
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

        if ($args->has($key = 'type')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'notifiable_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'notifiable_type')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'data')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'read_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
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
