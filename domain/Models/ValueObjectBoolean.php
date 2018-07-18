<?php
declare(strict_types=1);

namespace Domain\Models;

trait ValueObjectBoolean
{
    use ValueObjectOf;

    /** @var bool */
    private $value;

    /**
     * @param bool $value
     */
    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function asBoolean(): bool
    {
        return $this->value;
    }
}
