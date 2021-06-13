<?php
declare(strict_types=1);

namespace Domain\UseCases\PrintHistories;

use App\Traits\Database\Transactionable;
use App\Services\DomainCollection;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Domain\Models\PrintHistory;

final class DeletePrintHistory
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

    public function deleteMultiple(User $user, array $targetPrintHistoriyIds) {
        $print_histories = $this->getPrintHistories(['print_history_ids' => $targetPrintHistoriyIds])->all();
        return $this->transaction(function () use ($print_histories) {
            foreach ($print_histories as $print_history) {
                $print_history->forceDelete();
            }
            return true;
        });
    }

    public function getPrintHistories(array $args): DomainCollection
    {
        if (is_null($resource = $this->finder->findAll($args))) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param  array $args
     * @return PrintHistory
     * @throws NotFoundException
     */
    public function getPrintHistory(array $args): PrintHistory
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param PrintHistory $printHistory
     * @return void
     */
    public function excute(User $user, PrintHistory $printHistory): void
    {
        $this->transaction(function () use ($printHistory) {
            $printHistory->delete();
        });
    }

}
