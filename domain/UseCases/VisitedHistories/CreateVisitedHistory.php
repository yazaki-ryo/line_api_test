<?php
declare(strict_types=1);

namespace Domain\UseCases\VisitedHistories;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Attachment;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

final class CreateVisitedHistory
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /** @var FilesystemFactory */
    private $filesystem;

    /**
     * @param FindableContract $finder
     * @param FilesystemFactory $factory
     * @return void
     */
    public function __construct(FindableContract $finder, FilesystemFactory $factory)
    {
        $this->finder = $finder;
        $this->filesystem = $factory;
    }

    /**
     * @param  array $args
     * @return Customer
     * @throws NotFoundException
     */
    public function getCustomer(array $args): Customer
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Customer $customer
     * @param array $args
     * @param UploadedFile|null $file
     * @return Customer
     */
    public function excute(User $user, Customer $customer, array $args = [], UploadedFile $file = null): VisitedHistory
    {
        $args = $this->domainize($user, $customer, $args);

        return $this->transaction(function () use ($customer, $args, $file) {
            $visitedHistory = $customer->addVisitedHistory($args);

            if (! is_null($file)) {
                $this->addAttachment($visitedHistory, $file);
            }

            return $visitedHistory;
        });
    }

    /**
     * @param User $user
     * @param Customer $customer
     * @param array $args
     * @return array
     */
    private function domainize(User $user, Customer $customer, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key1 = 'visited_date') && ! is_null($date = $args->get($key1))) {
            if ($args->has($key2 = 'visited_time') && ! is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::parse($date));
        }

        return $args->all();
    }

    /**
     * @param VisitedHistory $visitedHistory
     * @param UploadedFile $file
     * @return Attachment
     */
    private function addAttachment(VisitedHistory $visitedHistory, UploadedFile $file): Attachment
    {
        $attachment = $visitedHistory->addAttachment([
            'path' => $path = sprintf('images/attachments/visited_histories/%s', $visitedHistory->customerId()),
            'name' => $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName()),
        ]);

        $this->filesystem->disk('public')->putFileAs($path, $file, $name);

        return $attachment;
    }

}
