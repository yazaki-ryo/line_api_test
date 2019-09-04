<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Attachment;
use Domain\Models\Customer;
use Domain\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

final class UpdateCustomer
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
     * @param  User $user
     * @param  Customer $customer
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, Customer $customer, array $args = [], UploadedFile $file = null): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($customer, $args, $file) {
            $customer->toggleTimestamp('mourned_at', (bool)$args['mourning_flag']);

            if (isset($args['drop_attachment'])) {
                $this->dropAttachments($customer);
            }

            if (! is_null($file)) {
                $this->dropAttachments($customer); // Maximum number of registrations is 1.
                $this->addAttachment($customer, $file);
            }

            return $customer->update($args);
        });
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
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

    /**
     * @param Customer $customer
     * @return void
     */
    private function dropAttachments(Customer $customer): void
    {
        /** @var Attachment $attachment */
        foreach ($customer->attachments() as $attachment) {
            $attachment->delete();
            // Per file.
            // $this->filesystem->disk('public')->delete(str_finish($attachment->path(), '/') . $attachment->name());
        }

        // Per directory.
        $this->filesystem->disk('public')->deleteDirectory(sprintf('images/attachments/customers/%s', $customer->id()));
    }

}
