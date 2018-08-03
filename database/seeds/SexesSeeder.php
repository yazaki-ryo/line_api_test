<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class SexesSeeder extends Seeder
{
    /** @var string */
    private $table = 'sexes';

    /** @var array */
    private static $items = [
        1 => '男性',
        2 => '女性',
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
                collect(self::$items)->each(function ($item, $key) use ($connection, $now) {
                    $connection->table($this->table)->insert([
                        'id' => $key,
                        'name' => $item,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
