<?php
declare(strict_types=1);

use App\Eloquents\EloquentCustomer;
use App\Eloquents\EloquentPermission;
use App\Eloquents\EloquentTag;
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
            'postal_code'   => '5430001',
            'address'       => '大阪市天王寺区上本町1-1-1',
            'building'      => '上本町ビル10F',
            'tel'           => '0667777777',
            'fax'           => '0667778888',
            'email'         => 'test@test.co.jp',
        ],
        [
            'id'            => 2,
            'plan_id'       => 2,
            'name'          => 'Test Corp.',
            'kana'          => 'テストコーポレーション',
            'postal_code'   => '5300047',
            'address'       => 'test',
            'building'      => 'test',
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
            'postal_code'      => '5300047',
            'address'          => '大阪市北区西天満2-6-8',
            'building'         => '堂島ビル6F',
            'tel'              => '0600000000',
            'fax'              => '0611111111',
            'email'            => 'osaka@test.co.jp',
            'payment_flag'     => true,
        ],
        [
            'id'               => 2,
            'company_id'       => 1,
            'prefecture_id'    => 27,
            'name'             => 'テスト料亭　京都店',
            'kana'             => 'テスト　キョウト',
            'postal_code'      => '6048161',
            'address'          => '京都市中京区烏丸通三条下ル饅頭屋町595-3',
            'building'         => '大同生命京都ビル6F',
            'tel'              => '0750000000',
            'fax'              => '0751111111',
            'email'            => 'kyoto@test.co.jp',
            'payment_flag'     => false,
        ],
        [
            'id'               => 3,
            'company_id'       => 2,
            'prefecture_id'    => 27,
            'name'             => 'テストフード　OSAKA',
            'kana'             => 'テストフード　オオサカ',
            'postal_code'      => '5300047',
            'address'          => '大阪市北区西天満2-6-8',
            'building'         => '堂島ビル6F',
            'tel'              => '0633334444',
            'fax'              => '0655556666',
            'email'            => 'test-food-osaka@testfood.co.jp',
            'payment_flag'     => true,
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
            'id'                 => 1,
            'store_id'           => 1,
            'sex_id'             => 1,
            'prefecture_id'      => 27,
            'last_name'          => 'テスト',
            'first_name'         => '顧客A',
            'last_name_kana'     => 'テスト',
            'first_name_kana'    => 'コキャク',
            'office'             => 'テスト工務店',
            'office_kana'        => 'テストコウムテン',
            'department'         => '営業部',
            'position'           => '部長',
            'postal_code'        => '5410056',
            'address'            => '大阪市中央区久太郎町3-1-27',
            'building'           => 'ヒグチビル1F',
            'tel'                => '0612345678',
            'fax'                => '0612348765',
            'email'              => 'shop@testtest.com',
            'mobile_phone'       => '09033334444',
            'mourned_at'         => null,
            'birthday'           => '1983-08-16',
            'anniversary'        => '2017-04-21',
            'likes_and_dislikes' => '人参',
            'note'               => 'テストメモ',
            'cancel_cnt'         => 0,
            'noshow_cnt'         => 0,
        ],
        [
            'id'                 => 2,
            'store_id'           => 1,
            'sex_id'             => 2,
            'prefecture_id'      => 26,
            'last_name'          => 'テスト',
            'first_name'         => '顧客B',
            'last_name_kana'     => 'テスト',
            'first_name_kana'    => 'コキャク',
            'office'             => 'テスト市役所',
            'office_kana'        => 'テストシヤクショ',
            'department'         => '保健課',
            'position'           => '課長',
            'postal_code'        => '6048142',
            'address'            => '京都市中京区錦小路通高倉西入ル西魚屋町597',
            'building'           => '烏丸ミズコートビル3F',
            'tel'                => '0750000000',
            'fax'                => '0750002222',
            'email'              => 'test@test.jp',
            'mobile_phone'       => '08012126677',
            'mourned_at'         => '2018-02-22 22:22:22',
            'birthday'           => null,
            'anniversary'        => '2000-01-01',
            'likes_and_dislikes' => '無し',
            'note'               => 'ノーショウ、キャンセル多し',
            'cancel_cnt'         => 8,
            'noshow_cnt'         => 3,
        ],
        [
            'id'                 => 3,
            'store_id'           => 2,
            'sex_id'             => 1,
            'prefecture_id'      => 1,
            'last_name'          => 'テスト',
            'first_name'         => '顧客C',
            'last_name_kana'     => 'テスト',
            'first_name_kana'    => 'コキャク',
            'office'             => 'TEST SHOP',
            'office_kana'        => 'テストショップ',
            'department'         => null,
            'position'           => 'CEO',
            'postal_code'        => '0600004',
            'address'            => '札幌市中央区北4条西3-1-1',
            'building'           => '札幌駅前ビル2Ｆ',
            'tel'                => '05034637474',
            'fax'                => null,
            'email'              => 'shop@testtest.com',
            'mobile_phone'       => null,
            'mourned_at'         => null,
            'birthday'           => '1978-07-09',
            'anniversary'        => null,
            'likes_and_dislikes' => 'トマト',
            'note'               => null,
            'cancel_cnt'         => 1,
            'noshow_cnt'         => 0,
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

                /**
                 * Tags
                 */
                $ids = EloquentTag::all()->pluck('id');
                foreach (EloquentCustomer::all() as $customer) {
                    $customer->tags()->sync($ids->random(mt_rand(0, $ids->count())));
                }
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
