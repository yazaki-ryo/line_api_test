<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\PrefectureRepository;
use Domain\Contracts\Model\FindableInterface;
use Domain\Models\Prefecture;

final class PrefecturesService implements
    FindableInterface
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
     * @param bool $trashed
     * @return Prefecture|null
     */
    public function findById(int $id, bool $trashed = false): ?Prefecture
    {
        return $this->repo->findById($id, $trashed);
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
