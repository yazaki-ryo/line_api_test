<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /** @var string */
    private $table = 'tags';

    /** @var array */
    private static $items = [
        [
            'name'  => 'タグ1',
        ],
        [
            'name'  => 'タグ2',
        ],
        [
            'name'  => 'タグ3',
        ],
        [
            'name'  => 'トマト嫌い',
        ],
        [
            'name'  => 'お酒好き',
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
