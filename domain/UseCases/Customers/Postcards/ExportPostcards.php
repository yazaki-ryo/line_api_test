<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Postcards;

use App\Services\Pdf\Handlers\Postcards\VerticallyPostcardHandler;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\ExportableContract;
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
     * @param User $user
     * @param array $args
     */
    public function excute(User $user, array $args)
    {
        $args = $this->domainize($user, $args);

        if (empty($args['data'])) {
            return false;
        }

        return $this->exporter
            ->pushHandler(app(VerticallyPostcardHandler::class))
            ->export($args);
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
        $collection->put('from', $user->store());

        if ($collection->has($key = 'selection')) {
            $ids = explode(',', $collection->get($key));
            $collection->put('data', $this->finder->findAll([
                'mourning_flag' => true,
                'ids'           => $ids,
            ])->toArray());
        }

        return $collection->all();
    }

}
