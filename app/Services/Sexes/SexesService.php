<?php
declare(strict_types=1);

namespace App\Services\Sexes;

use App\Repositories\SexRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Sexes\GetSexInterface;
use Domain\Contracts\Sexes\GetSexesInterface;
use Domain\Models\Sex;

final class SexesService implements
    GetSexInterface,
    GetSexesInterface
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
     * @param int $id
     * @return Sex|null
     */
    public function findById(int $id): ?Sex
    {
        return $this->repo->findById($id);
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
