<?php
declare(strict_types=1);

namespace Domain\Models;

use Carbon\Carbon;

final class Datetime
{
    use ValueObjectOf;

    /** @var Carbon */
    private $value;

    /**
     * @param string $datetime
     * @return void
     */
    private function __construct(?string $datetime)
    {
        $this->value = is_null($datetime) ? null : Carbon::parse($datetime);
    }

    /**
     * @return string
     */
    public function format($format): string
    {
        return $this->value->format($format);
    }

    /**
     * @return Datetime
     */
    public static function now(): self
    {
        return new self(Carbon::now());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value->toDateTimeString();
    }
}
