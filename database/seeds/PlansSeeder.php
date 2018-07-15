<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /** @var string */
    private $table = 'plans';

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
     * @param Connection $connection
     * @return void
     */
    public function run(Connection $connection)
    {
        try {
            $connection->transaction(function ($connection) {
                $now = now();
                collect(self::$items)->each(function ($item) use ($connection, $now) {
                    $connection->table($this->table)->insert(collect($item)->merge([
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all());
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
