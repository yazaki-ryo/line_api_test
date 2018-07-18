<?php
declare(strict_types=1);

namespace Domain\Models;

use Domain\Exceptions\InvariantException;

final class Price
{
    use ValueObjectInt;

    /**
     * @param int $value
     * @throws InvariantException
     */
    private function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvariantException('The price model should not be less than zero.');
        }
        $this->value = $value;
    }

    /**
     * @param self $price
     * @return bool
     */
    public function lessThan(self $price): bool
    {
        return $this->value < $price->asInt();
    }
}
