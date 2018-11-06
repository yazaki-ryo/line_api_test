<?php
declare(strict_types=1);

namespace Domain\Models;

trait ValueObjectFloat
{
    use ValueObjectOf;

    /** @var float */
    private $value;

    /**
     * @param float $value
     * @return void
     */
    private function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function asFloat(): float
    {
        return $this->value;
    }
}
