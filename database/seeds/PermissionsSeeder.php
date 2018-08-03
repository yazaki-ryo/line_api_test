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
        /**
         * Users
         */
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

        /**
         * Companies
         */
        [
            'name'  => '企業管理（全権）',
            'slug'  => 'companies.*',
        ],
        [
            'name'  => '企業閲覧',
            'slug'  => 'companies.select',
        ],
        [
            'name'  => '企業作成',
            'slug'  => 'companies.create',
        ],
        [
            'name'  => '企業更新',
            'slug'  => 'companies.update',
        ],
        [
            'name'  => '企業削除',
            'slug'  => 'companies.delete',
        ],
        [
            'name'  => '企業復旧',
            'slug'  => 'companies.restore',
        ],

        /**
         * Stores
         */
        [
            'name'  => '店舗管理（全権）',
            'slug'  => 'stores.*',
        ],
        [
            'name'  => '店舗閲覧',
            'slug'  => 'stores.select',
        ],
        [
            'name'  => '店舗作成',
            'slug'  => 'stores.create',
        ],
        [
            'name'  => '店舗更新',
            'slug'  => 'stores.update',
        ],
        [
            'name'  => '店舗削除',
            'slug'  => 'stores.delete',
        ],
        [
            'name'  => '店舗復旧',
            'slug'  => 'stores.restore',
        ],

        /**
         * Customers
         */
        [
            'name'  => '顧客管理（全権）',
            'slug'  => 'customers.*',
        ],
        [
            'name'  => '顧客閲覧',
            'slug'  => 'customers.select',
        ],
        [
            'name'  => '顧客作成',
            'slug'  => 'customers.create',
        ],
        [
            'name'  => '顧客更新',
            'slug'  => 'customers.update',
        ],
        [
            'name'  => '顧客削除',
            'slug'  => 'customers.delete',
        ],
        [
            'name'  => '顧客復旧',
            'slug'  => 'customers.restore',
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
