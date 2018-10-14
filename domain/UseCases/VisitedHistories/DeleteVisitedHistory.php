<?php
declare(strict_types=1);

namespace Domain\UseCases\VisitedHistories;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Domain\Models\VisitedHistory;

final class DeleteVisitedHistory
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param  int $id
     * @return VisitedHistory
     * @throws NotFoundException
     */
    public function getVisitedHistory(int $id): VisitedHistory
    {
        if (is_null($resource = $this->finder->find($id))) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param VisitedHistory $visitedHistory
     * @return void
     */
    public function excute(User $user, VisitedHistory $visitedHistory): void
    {
        $this->transaction(function () use ($visitedHistory) {
            $visitedHistory->delete();
        });
    }

}
