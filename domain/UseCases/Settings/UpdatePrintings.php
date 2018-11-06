<?php
declare(strict_types=1);

namespace Domain\UseCases\Settings;

use App\Traits\Database\Transactionable;
use Domain\Models\PrintSetting;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class UpdatePrintings
{
    use Transactionable;

    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param int $settingId
     * @return PrintSetting|null
     */
    public function getPrintSetting(User $user, int $settingId): ?PrintSetting
    {
        /**
         * TODO take by $settingId
         * TODO order by latest.
         */
        return $user->printSettings()->first();
    }

    /**
     * @param User $user
     * @param int $settingId
     * @param array $args
     * @return void
     */
    public function excute(User $user, int $settingId, array $args = []): void
    {
        $args = $this->domainize($user, $args);

        $printSetting = $this->getPrintSetting($user, $settingId);

        $this->transaction(function () use ($user, $args, $printSetting) {
            is_null($printSetting) ? $user->addPrintSetting($args) : $printSetting->update($args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $collection = collect([]);

        $collection->put('data', json_encode($args));

        return $collection->all();
    }

}
