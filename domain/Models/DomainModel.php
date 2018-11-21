<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\EloquentRepository;
use Domain\Traits\Models\Synchronizable;

abstract class DomainModel
{
    use Synchronizable;

    /** @var EloquentRepository */
    protected $repo;

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->repo->delete($this->id());
    }

    /**
     * @return void
     */
    public function restore(): void
    {
        $this->repo->restore($this->id());
    }

    /**
     * @param array $args
     * @return bool
     */
    public function update(array $args = []): bool
    {
        return $this->repo->update($this->id(), $args);
    }
}
