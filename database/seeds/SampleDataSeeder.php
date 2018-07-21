<?php
declare(strict_types=1);

use App\Eloquents\EloquentPermission;
use App\Eloquents\EloquentUser;
use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /** @var array */
    private static $companies = [
        [
            'id'            => 1,
            'plan_id'       => 1,
            'prefecture_id' => 27,
            'name'          => '株式会社テスト',
            'kana'          => 'カブシキガイシャ　テスト',
            'postal_code'   => '543-0001',
            'address'       => '大阪市天王寺区上本町1-1-1',
            'building_name' => '上本町ビル10F',
            'tel'           => '06-6777-7777',
            'fax'           => '06-6777-8888',
            'email'         => 'test@test.co.jp',
        ],
        [
            'id'            => 2,
            'plan_id'       => 2,
            'name'          => 'Test Corp.',
            'kana'          => 'テストコーポレーション',
            'postal_code'   => '530-0047',
            'address'       => 'test',
            'building_name' => 'test',
        ],
    ];

    /** @var array */
    private static $stores = [
        [
            'id'               => 1,
            'company_id'       => 1,
            'prefecture_id'    => 27,
            'name'             => 'テスト料亭　大阪店',
            'kana'             => 'テスト　オオサカ',
            'postal_code'      => '530-0047',
            'address'          => '大阪市北区西天満2-6-8',
            'building_name'    => '堂島ビル6F',
            'tel'              => '06-0000-0000',
            'fax'              => '06-1111-1111',
            'email'            => 'osaka@test.co.jp',
        ],
        [
            'id'               => 2,
            'company_id'       => 1,
            'prefecture_id'    => 27,
            'name'             => 'テスト料亭　京都店',
            'kana'             => 'テスト　キョウト',
            'postal_code'      => '604-8161',
            'address'          => '京都市中京区烏丸通三条下ル饅頭屋町595-3',
            'building_name'    => '大同生命京都ビル6F',
            'tel'              => '075-000-0000',
            'fax'              => '075-111-1111',
            'email'            => 'kyoto@test.co.jp',
        ],
        [
            'id'               => 3,
            'company_id'       => 2,
            'prefecture_id'    => 27,
            'name'             => 'テストフード　OSAKA',
            'kana'             => 'テストフード　オオサカ',
            'postal_code'      => '530-0047',
            'address'          => '大阪市北区西天満2-6-8',
            'building_name'    => '堂島ビル6F',
            'tel'              => '06-3333-4444',
            'fax'              => '06-5555-6666',
            'email'            => 'test-food-osaka@testfood.co.jp',
        ],
    ];

    /** @var array */
    private static $users = [
        [
            'id'       => 1,
            'store_id' => 1,
            'role_id'  => 1,
            'name'     => '管理者',
            'email'    => 'company-admin@test.jp',
        ],
        [
            'id'       => 2,
            'store_id' => 1,
            'role_id'  => 2,
            'name'     => '店舗担当者',
            'email'    => 'store-user@test.jp',
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

                /**
                 * Companies
                 */
                collect(self::$companies)->each(function ($item) use ($connection, $now) {
                    $connection->table('companies')->insert(collect($item)->merge([
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all());
                });

                /**
                 * Stores
                 */
                collect(self::$stores)->each(function ($item) use ($connection, $now) {
                    $connection->table('stores')->insert(collect($item)->merge([
                        'created_at'       => $now,
                        'updated_at'       => $now,
                        'starts_at'        => $now->copy()->addDays(mt_rand(0, 100)),
                        'ends_at'          => $now->copy()->addDays(mt_rand(100, 200)),
                        'user_limit'       => mt_rand(1, 10),
                    ])->all());
                });

                /**
                 * Users
                 */
                collect(self::$users)->each(function ($item) use ($connection, $now) {
                    $connection->table('users')->insert(collect($item)->merge([
                        'created_at' => $now,
                        'updated_at' => $now,
                        'password'   => bcrypt('testtest'),
                    ])->all());
                });

                /**
                 * Permissions
                 */
                $ids = EloquentPermission::slug('.*', 'like')->pluck('id');
                EloquentUser::find(1)->permissions()->sync($ids->all());

                $ids = EloquentPermission::slugs([
                    'stores.select',
                    'stores.update',
                    'customers.select',
                    'customers.create',
                    'customers.update',
                ])->pluck('id');
                EloquentUser::find(2)->permissions()->sync($ids->all());
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
