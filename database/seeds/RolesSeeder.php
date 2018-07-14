<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /** @var array */
    private static $items = [
        [
            'id'    => 1,
            'name'  => '管理者',
            'allows' => [
                'users' => [
                    'index'   => true,//仮定義
                    'create'  => true,//仮定義
                    'update'  => true,//仮定義
                    'delete'  => true,//仮定義
                    'restore' => true,//仮定義
                ],
            ],
        ],
        [
            'id'    => 2,
            'name'  => '店舗担当者',
            'allows' => [
                'users' => [
                    'index'   => true,//仮定義
                    'create'  => true,//仮定義
                    'update'  => true,//仮定義
                    'delete'  => false,//仮定義
                    'restore' => false,//仮定義
                ],
            ],
        ],
        [
            'id'    => 3,
            'name'  => '一般ユーザー',
            'allows' => [
                'users' => [
                    'index'   => true,//仮定義
                    'create'  => false,//仮定義
                    'update'  => false,//仮定義
                    'delete'  => false,//仮定義
                    'restore' => false,//仮定義
                ],
            ],
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
                    $item['allows'] = json_encode($item['allows']);
                    $connection->table('roles')->insert(collect($item)->merge([
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
