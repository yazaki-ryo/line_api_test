<?php
declare(strict_types=1);

use App\Eloquents\EloquentPlan;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
        [
            'id'    => 1,
            'name'  => 'ライト',
            'price' => 5000,
        ],
        [
            'id'    => 2,
            'name'  => 'スタンダード',
            'price' => 10000,
        ],
        [
            'id'    => 3,
            'name'  => 'プレミアム',
            'price' => 20000,
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
                    /** @var EloquentPlan $plan */
                    $plan = EloquentPlan::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
