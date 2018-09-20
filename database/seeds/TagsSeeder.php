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
        [
            'name'     => 'タグ1',
            'store_id' => 1,
        ],
        [
            'name'     => 'タグ2',
            'store_id' => 1,
        ],
        [
            'name'     => 'タグ3',
            'store_id' => 1,
        ],
        [
            'name'     => 'トマト嫌い',
            'store_id' => 2,
        ],
        [
            'name'     => 'お酒好き',
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
