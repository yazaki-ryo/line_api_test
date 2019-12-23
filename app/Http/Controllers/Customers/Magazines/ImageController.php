<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Magazines;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Magazines\ImageRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\Magazines\Upload;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

final class ImageController extends Controller
{
    /** @var Upload */
    private $useCase;

    /**
     * @param  Upload $useCase
     * @return void
     */
    public function __construct(Upload $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.create'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(ImageRequest $request)
    {   
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        /** @var UploadedFile $file */
        $file = $request->file('file');
        $url = $this->useCase->excute($store, $file);
        echo $url;
    }

}
