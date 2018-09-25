<?php
declare(strict_types=1);

use App\Eloquents\EloquentPermission;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    use Transactionable;

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

        /**
         * Settings
         */
        [
            'name'  => '各種設定',
            'slug'  => 'settings.*',
        ],

        /**
         * Tags
         */
        [
            'name'  => 'タグ管理（全権）',
            'slug'  => 'tags.*',
        ],
        [
            'name'  => 'タグ閲覧',
            'slug'  => 'tags.select',
        ],
        [
            'name'  => 'タグ作成',
            'slug'  => 'tags.create',
        ],
        [
            'name'  => 'タグ更新',
            'slug'  => 'tags.update',
        ],
        [
            'name'  => 'タグ削除',
            'slug'  => 'tags.delete',
        ],
        [
            'name'  => 'タグ復旧',
            'slug'  => 'tags.restore',
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
                    EloquentPermission::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
