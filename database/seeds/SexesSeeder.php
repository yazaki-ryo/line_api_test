<?php
declare(strict_types=1);

use App\Eloquents\EloquentSex;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class SexesSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
        [
            'id'   => 1,
            'name' => '男性',
        ],
        [
            'id'   => 2,
            'name' => '女性',
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
                    /** @var EloquentSex $sex */
                    $sex = EloquentSex::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
