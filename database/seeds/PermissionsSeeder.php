<?php
declare(strict_types=1);

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /** @var string */
    private $table = 'permissions';

    /** @var array */
    private static $items = [
        [
            'name'  => 'ユーザー管理（全権）',
            'slug'  => 'users.*',
        ],
        [
            'name'  => 'ユーザー閲覧',
            'slug'  => 'users.select',
        ],
        [
            'name'  => 'ユーザー作成',
            'slug'  => 'users.create',
        ],
        [
            'name'  => 'ユーザー更新',
            'slug'  => 'users.update',
        ],
        [
            'name'  => 'ユーザー削除',
            'slug'  => 'users.delete',
        ],
        [
            'name'  => 'ユーザー復旧',
            'slug'  => 'users.restore',
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
