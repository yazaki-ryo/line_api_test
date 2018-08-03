<?php
declare(strict_types=1);

namespace App\Services\Prefectures;

use App\Repositories\PrefectureRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Prefectures\GetPrefectureInterface;
use Domain\Contracts\Prefectures\GetPrefecturesInterface;
use Domain\Models\Prefecture;

final class PrefecturesService implements
    GetPrefectureInterface,
    GetPrefecturesInterface
{
    /** @var PrefectureRepository */
    private $repo;

    /**
     * @param PrefectureRepository $repo
     */
    public function __construct(PrefectureRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param int $id
     * @return Prefecture|null
     */
    public function findById(int $id): ?Prefecture
    {
        return $this->repo->findById($id);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        return cache()->remember('prefectures', 120, function () use ($args) {
            return $this->repo->findAll($args);
        });
    }

}
