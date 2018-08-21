<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\AvatarRepository;

final class Avatar extends DomainModel
{
    /** @var AvatarRepository */
    protected $repo;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $avatarableId;

    /** @var string */
    private $avatarableType;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /**
     * @param AvatarRepository|null $repo
     * @return void
     */
    public function __construct(AvatarRepository $repo = null)
    {
        $this->repo = is_null($repo) ? new AvatarRepository : $repo;
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
     * @return int|null
     */
    public function avatarableId(): ?int
    {
        return $this->avatarableId;
    }

    /**
     * @return string|null
     */
    public function avatarableType(): ?string
    {
        return $this->avatarableType;
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
    public function avatarable(): DomainModel
    {
        return $this->repo->avatarable();
    }

    /**
     * @param AvatarRepository $repo
     * @return self
     */
    public static function of(AvatarRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new AvatarRepository))->propertiesByArray($args);
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

        if ($args->has($key = 'avatarable_id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'avatarable_type')) {
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
