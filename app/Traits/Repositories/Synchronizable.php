<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

trait Synchronizable
{
    /**
     * @param string $relation
     * @param array $args
     * @return void
     */
    public function sync(string $relation, array $args = []): void
    {
        $this->eloquent->{$relation}()->sync($args);
    }

    /**
     * @param string $relation
     * @param array $args
     * @return void
     */
    public function toggle(string $relation, array $args = []): void
    {
        $this->eloquent->{$relation}()->toggle($args);
    }
}
