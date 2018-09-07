<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\CreatableContract;
use Domain\Contracts\File\ParsableContract;
use Domain\Models\User;

final class ImportFiles
{
    /** @var ParsableContract $parser */
    private $parser;

    /** @var CreatableContract */
    private $creator;

    /**
     * @param  ParsableContract $parser
     * @param  CreatableContract $creator
     * @return void
     */
    public function __construct(ParsableContract $parser, CreatableContract $creator)
    {
        $this->parser = $parser;
        $this->creator = $creator;
    }

    /**
     * @param User $user
     * @param array $args
     */
    public function excute(User $user, array $args)
    {
//         $args = $this->domainize($user, $args);

        /** @var \Illuminate\Http\UploadedFile $uploadedFile */
//         $uploadedFile = $args['csv_file'];

        $file = new \SplFileObject($args['csv_file']->getRealPath());

        /**
         * TODO ここかリクエストのどちらかでアップロードファイルの中身のバリデート
         */
        $this->parser->parse($file);

        /**
         * TODO 登録処理
         */
//         $this->creator->create();
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
//     private function domainize(User $user, array $args = []): array
//     {
        /** @var Collection $collection */
//         $collection = collect($args);

//         if ($collection->has($key = 'selection')) {
//             $collection->put('ids', explode(',', $collection->get($key)));
//             $collection->forget($key);
//         }

//         return $collection->all();
//     }

}
