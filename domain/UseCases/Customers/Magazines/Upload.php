<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Magazines;

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

final class Upload
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
    public function excute(User $user, Store $store, array $args = [], UploadedFile $file = null, $CKEditorFuncNum)
    {
        $response = null;
        $args = $this->domainize($user, $args);
        $path = sprintf('images/attachments/magazines/%s', $store->id());
        $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName());
        $url = asset(sprintf('storage/images/attachments/magazines/%s/%s', $store->id(), $name));
        $result = $this->filesystem->disk('public')->putFileAs($path, $file, $name);
        if(!empty($result)) {
            $msg = '画像をアップロードしました。'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        }
        return $response;
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);
        // 
        return $args->all();
    }

}
