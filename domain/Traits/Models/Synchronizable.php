<?php
declare(strict_types=1);

namespace Domain\Traits\Models;

trait Synchronizable
{
    /**
     * @param string $relation
     * @param array $args
     * @return void
     */
    public function sync(string $relation, array $args = []): void
    {
        $this->repo->sync($relation, $args);
    }

    /**
     * @param string $relation
     * @param array $args
     * @return void
     */
    public function toggle(string $relation, array $args = []): void
    {
        $this->repo->toggle($relation, $args);
    }
}
