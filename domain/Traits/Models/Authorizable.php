<?php
declare(strict_types=1);

namespace Domain\Traits\Models;

trait Authorizable
{
    /**
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function can($ability, $arguments = []): bool
    {
        return $this->repo->can($ability, $arguments);
    }

    /**
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function cant($ability, $arguments = []): bool
    {
        return ! $this->can($ability, $arguments);
    }
}
