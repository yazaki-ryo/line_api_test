<?php
declare(strict_types=1);

namespace Domain\Models;

final class Role
{
    /** @var string */
    private $name;

    /** @var string */
    private $slug;

    /**
     * @param string $name
     * @param string $slug
     * @return void
     */
    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
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
     *
     * @param array $values
     * @return self
     */
    public static function ofByArray(array $values): self
    {
        return new self(
            $values['name'] ?? '',
            $values['slug'] ?? ''
        );
    }
}
