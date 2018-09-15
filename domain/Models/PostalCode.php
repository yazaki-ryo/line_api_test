<?php
declare(strict_types=1);

namespace Domain\Models;

use Domain\Exceptions\InvariantException;

final class PostalCode
{
    use ValueObjectString;

    /**
     * @param string $value
     * @throws InvariantException
     */
    private function __construct(string $value)
    {
        if (self::validate($value) === false) {
            throw new InvariantException(sprintf('Invalid postal code: %s', $value));
        }
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function validate(string $value): bool
    {
        return preg_match("/^[\d]{7}$/u", $value) > 0;
    }
}
