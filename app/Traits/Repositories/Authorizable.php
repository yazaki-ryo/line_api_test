<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

trait Authorizable
{
    /**
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function can($ability, $arguments = []): bool
    {
        return $this->eloquent->can($ability, $arguments);
    }
}
