<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Attachment;
use Domain\Models\Customer;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

final class CreateCustomer
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /** @var FilesystemFactory */
    private $filesystem;

     /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder, FilesystemFactory $factory)
    {
        $this->finder = $finder;
        $this->filesystem = $factory;
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
     * @return Customer
     */
    public function excute(User $user, Store $store, array $args = [], UploadedFile $file = null): Customer
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($store, $args, $file) {
            $customer = $store->addCustomer($args);

            if (isset($args['visited_at'])) {
                $customer->addVisitedHistory([
                    'visited_at' => $args['visited_at'],
                ]);
            }

            if (! is_null($file)) {
                $this->addAttachment($customer, $file);
            }

            $customer->sync('tags', $args['tags']);
            
            return $customer;
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'mourning_flag') && (bool)$args->get($key)) {
            $args['mourned_at'] = now();
        }

        if ($args->has($key1 = 'visited_date') && ! is_null($date = $args->get($key1))) {
            if ($args->has($key2 = 'visited_time') && ! is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::parse($date));
        }

        if (! $args->has($key = 'tags')) {
            $args->put($key, []);
        }

        return $args->all();
    }

    /**
     * @param Customer $customer
     * @param UploadedFile $file
     * @return Attachment
     */
    private function addAttachment(Customer $customer, UploadedFile $file): Attachment
    {
        $attachment = $customer->addAttachment([
            'path' => $path = sprintf('images/attachments/customers/%s', $customer->id()),
            'name' => $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName()),
        ]);

        $this->filesystem->disk('public')->putFileAs($path, $file, $name);

        return $attachment;
    }

}
