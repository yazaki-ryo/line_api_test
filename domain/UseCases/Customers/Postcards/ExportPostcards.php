<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Postcards;

use App\Services\Pdf\Handlers\Postcards\VerticallyPostcardHandler;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\ExportableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class ExportPostcards
{
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
            return false;
        }

        return $this->exporter
            ->pushHandler(app(VerticallyPostcardHandler::class))
            ->export($args);
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return array
     */
    private function domainize(User $user, Store $store, array $args = []): array
    {
        /** @var Collection $collection */
        $collection = collect($args);
        $collection->put('from', $store);

        if ($collection->has($key = 'selection')) {
            $ids = explode(',', $collection->get($key));
            $collection->put('data', $store->customers([
                'mourning_flag' => true,
                'ids'           => $ids,
            ])->toArray());
        }

        return $collection->all();
    }

}
