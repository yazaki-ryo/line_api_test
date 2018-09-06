<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Pdf\Handlers\Postcards\VerticallyPostcardHandler;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\ExportableContract;
use Domain\Models\User;

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
     * @param User $user
     * @param array $args
     */
    public function excute(User $user, array $args)
    {
        $args = $this->domainize($user, $args);
        $data = $this->finder->findMany($args['ids'])->toArray();

        return $this->exporter
            ->pushHandler(app(VerticallyPostcardHandler::class))
            ->export($data, $args['settings']);
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        /** @var Collection $collection */
        $collection = collect($args);

        if ($collection->has($key = 'selection')) {
            $collection->put('ids', explode(',', $collection->get($key)));
            $collection->forget($key);
        }

        return $collection->all();
    }

}
