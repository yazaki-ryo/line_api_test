<?php
declare(strict_types=1);

use App\Eloquents\EloquentTag;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
        /**
         * 1st store
         */
        [
            'name'     => 'タグ1',
            'label'    => 'primary',
            'store_id' => 1,
        ],
        [
            'name'     => 'タグ2',
            'label'    => 'primary',
            'store_id' => 1,
        ],
        [
            'name'     => 'タグ3',
            'label'    => 'primary',
            'store_id' => 1,
        ],
        [
            'name'     => 'グループA',
            'label'    => 'warning',
            'store_id' => 1,
        ],
        [
            'name'     => 'グループB',
            'label'    => 'warning',
            'store_id' => 1,
        ],
        [
            'name'     => 'トマト嫌い',
            'label'    => 'danger',
            'store_id' => 1,
        ],
        [
            'name'     => 'お酒好き',
            'label'    => 'success',
            'store_id' => 1,
        ],
        [
            'name'     => 'ワイン好き',
            'label'    => 'success',
            'store_id' => 1,
        ],
        [
            'name'     => 'Aさんの紹介',
            'label'    => 'info',
            'store_id' => 1,
        ],
        [
            'name'     => 'Bさんの紹介',
            'label'    => 'info',
            'store_id' => 1,
        ],
        [
            'name'     => 'その他1',
            'label'    => 'default',
            'store_id' => 1,
        ],
        [
            'name'     => 'その他2',
            'label'    => 'default',
            'store_id' => 1,
        ],

        /**
         * 2nd store
         */
        [
            'name'     => 'タグ1',
            'label'    => 'warning',
            'store_id' => 2,
        ],
        [
            'name'     => 'タグ2',
            'label'    => 'warning',
            'store_id' => 2,
        ],
        [
            'name'     => 'タグ3',
            'label'    => 'warning',
            'store_id' => 2,
        ],
        [
            'name'     => 'グループA',
            'label'    => 'primary',
            'store_id' => 2,
        ],
        [
            'name'     => 'グループB',
            'label'    => 'primary',
            'store_id' => 2,
        ],
    ];

    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect(self::$items)->each(function ($item) {
                    EloquentTag::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
