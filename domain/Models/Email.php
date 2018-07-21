<?php
declare(strict_types=1);

namespace Domain\Models;

use Domain\Exceptions\InvariantException;

final class Email
{
    use ValueObjectString;

    /**
     * @param string $value
     * @throws InvariantException
     */
    private function __construct(string $value)
    {
        if (self::validate($value) === false) {
            throw new InvariantException(sprintf('Invalid email: %s', $value));
        }
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function validate(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
