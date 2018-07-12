<?php
declare(strict_types=1);

namespace Domain\Models;

final class User
{
    /** @var Email */
    private $email;

    /** @var string */
    private $name;

    /**
     *
     * @param Email $email
     * @param string $name
     * @return void
     */
    public function __construct(Email $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
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
    public function name(): string
    {
        return $this->name;
    }

    /**
     *
     * @param array $values
     * @return self
     */
    public static function ofByArray(array $values): self
    {
        return new self(
            Email::of($values['email'] ?? ''),
            $values['name'] ?? ''
        );
    }
}
