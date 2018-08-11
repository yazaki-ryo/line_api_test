<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\SexRepository;
use Domain\Contracts\Model\FindableInterface;
use Domain\Models\Sex;

final class SexesService implements
    FindableInterface
{
    /** @var SexRepository */
    private $repo;

    /**
     * @param SexRepository $repo
     */
    public function __construct(SexRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Sex|null
     */
    public function findById(int $id, bool $trashed = false): ?Sex
    {
        return $this->repo->findById($id, $trashed);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        return cache()->remember('sexes', 120, function () use ($args) {
            return $this->repo->findAll($args);
        });
    }

}
