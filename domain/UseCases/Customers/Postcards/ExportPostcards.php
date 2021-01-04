<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Postcards;

use App\Services\Pdf\Handlers\Postcards\VerticallyPostcardHandler;
use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\ExportableContract;
use Domain\Exceptions\InvariantException;
use Domain\Exceptions\NotFoundException;
use Domain\Models\PrintSetting;
use Domain\Models\Store;
use Domain\Models\User;
use Domain\Models\PrintHistory;
use Illuminate\Support\Collection;

final class ExportPostcards
{
    use Transactionable;

    /** @var ExportableContract $exporter */
    private $exporter;

    /** @var FindableContract */
    private $finder;

    /**
     * @param  ExportableContract $exporter
     * @param  FindableContract $finder
     * @return void
     */
    public function __construct(ExportableContract $exporter, FindableContract $finder)
    {
        $this->exporter = $exporter;
        $this->finder = $finder;
    }

    /**
     * @param User $user
     * @param int $settingId
     * @return PrintSetting|null
     */
    public function getPrintSetting(User $user, int $settingId): ?PrintSetting
    {
        if (is_null($resource = $user->printSettings()->domainizePrintSettings(true)->get($settingId))) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param  array $args
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(array $args): Store
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     */
    public function excute(User $user, Store $store, array $args)
    {
        $args = $this->domainize($user, $store, $args);

        if (empty($args['data'])) {
            \Log::debug( 'empty!!!' );
            return false;
        }

        foreach ($args['data'] as $customer) {

            $_args['store_id'] = $store->id();
            $_args['customer_id'] = $customer->id();
            $_args['print_setting_id'] = $args['settings']->id();

            if(is_null( $_args['print_setting_id'] )){
                $_args['print_setting_id'] = $args['settings']->defaultSettingId();
            }

            $this->transaction(function () use ($store, $_args, $customer) {

                try{
                    $store->addPrintHistory($_args);
                } catch (\Exception $e) {
                    /** Do nothing */
                }
            });
        }

        return $this->exporter
            ->pushHandler(app(VerticallyPostcardHandler::class))
            ->export($args);
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @throws InvariantException
     * @return array
     */
    private function domainize(User $user, Store $store, array $args = []): array
    {
        //\Log::debug( 'empty?' );
        //\Log::debug( var_export($store, true) );
        if (! $store->postalCode() || ! $store->name() || ! $store->address()) {
            throw new InvariantException('The sender\'s name, zip code, and address are required items.');
        }

        /** @var Collection $collection */
        $collection = collect($args);
        $collection->put('from', $store);

        if ($collection->has($key = 'selection')) {
            //\Log::debug( 'selection??' );
            //\Log::debug( var_export($collection->get($key), true) );
            $collection->put('data', $store->customers([
                'ids'           => $collection->get($key),
                'mourning_flag' => true,
                'notNull'       => [
                    'last_name',
                    //'first_name',
                    //'postal_code',
                    'address',
                ],
                'address' => '[0-9０－９]+',
            ])->toArray());
        }
        //\Log::debug( 'empty???' );

        //\Log::debug( var_export($collection, true) );

        return $collection->all();
    }

}
