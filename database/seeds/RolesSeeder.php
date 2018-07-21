<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /** @var string */
    private $table = 'roles';

    /** @var array */
    private static $items = [
        [
            'id'    => 1,
            'name'  => '管理者',
            'slug'  => 'company-admin',
        ],
        [
            'id'    => 2,
            'name'  => '店舗担当者',
            'slug'  => 'store-master',
        ],
        [
            'id'    => 3,
            'name'  => '一般ユーザー',
            'slug'  => 'general-user',
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
