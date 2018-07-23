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

    /** @var array */
    private static $customers = [
        [
            'id'            => 1,
            'store_id'      => 1,
            'sex_id'        => 1,
            'prefecture_id' => 27,
            'name'          => 'テスト顧客A',
            'kana'          => 'テストコキャク',
            'age'           => 35,
            'office'        => 'テスト工務店',
            'department'    => '営業部',
            'position'      => '部長',
            'postal_code'   => '541-0056',
            'address'       => '大阪市中央区久太郎町3-1-27',
            'building_name' => 'ヒグチビル1F',
            'tel'           => '06-1234-5678',
            'fax'           => '06-1234-8765',
            'email'         => 'shop@testtest.com',
            'mobile_phone'  => '090-3333-4444',
            'mourning_flag' => false,
            'likes_and_dislikes' => '人参',
            'note'          => 'テストメモ',
            'visited_cnt'   => 1,
            'cancel_cnt'    => 0,
            'noshow_cnt'    => 0,
        ],
        [
            'id'            => 2,
            'store_id'      => 1,
            'sex_id'        => 2,
            'prefecture_id' => 26,
            'name'          => 'テスト顧客B',
            'kana'          => 'テストコキャク',
            'age'           => 24,
            'office'        => 'テスト市役所',
            'department'    => '保健課',
            'position'      => '課長',
            'postal_code'   => '604-8142',
            'address'       => '京都府京都市中京区錦小路通高倉西入ル西魚屋町597',
            'building_name' => '烏丸ミズコートビル3F',
            'tel'           => '075-000-0000',
            'fax'           => '075-000-2222',
            'email'         => 'test@test.jp',
            'mobile_phone'  => '080-1212-6677',
            'mourning_flag' => true,
            'likes_and_dislikes' => '無し',
            'note'          => 'ノーショウ、キャンセル多し',
            'visited_cnt'   => 5,
            'cancel_cnt'    => 8,
            'noshow_cnt'    => 3,
        ],
        [
            'id'            => 3,
            'store_id'      => 2,
            'sex_id'        => 1,
            'prefecture_id' => 1,
            'name'          => 'テスト顧客C',
            'kana'          => 'テストコキャク',
            'age'           => 40,
            'office'        => 'TEST SHOP',
            'department'    => null,
            'position'      => 'CEO',
            'postal_code'   => '060-0004',
            'address'       => '北海道札幌市中央区北4条西3-1-1',
            'building_name' => '札幌駅前ビル2Ｆ',
            'tel'           => '050-3463-7474',
            'fax'           => null,
            'email'         => 'shop@testtest.com',
            'mobile_phone'  => null,
            'mourning_flag' => false,
            'likes_and_dislikes' => 'トマト',
            'note'          => null,
            'visited_cnt'   => 3,
            'cancel_cnt'    => 1,
            'noshow_cnt'    => 0,
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

                /**
                 * Customers
                 */
                collect(self::$customers)->each(function ($item) use ($connection, $now) {
                    $connection->table('customers')->insert(collect($item)->merge([
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ])->all());
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
