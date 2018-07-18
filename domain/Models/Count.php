<?php
declare(strict_types=1);

namespace Domain\Models;

use Domain\Exceptions\InvariantException;

final class Count
{
    use ValueObjectInt;

    /**
     * @param int $value
     * @throws InvariantException
     */
    private function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvariantException('The count model should not be less than zero.');
        }
        $this->value = $value;
    }

    /**
     * @return Count
     * @throws InvariantException
     */
    public function increment(): self
    {
        return new self($this->value + 1);
    }

    /**
     * @return Count
     * @throws InvariantException
     */
    public function decrement(): self
    {
        return new self($this->value - 1);
    }

    /**
     * @param self $count
     * @return bool
     */
    public function lessThan(self $count): bool
    {
        return $this->value < $count->asInt();
    }
}
