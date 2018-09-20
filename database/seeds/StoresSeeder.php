<?php
declare(strict_types=1);

use App\Eloquents\EloquentStore;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
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

    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                $now = now();

                collect(self::$items)->each(function ($item) use ($now) {
                    EloquentStore::create(array_merge($item, [
                        'starts_at'        => $now->copy()->addDays(mt_rand(0, 100)),
                        'ends_at'          => $now->copy()->addDays(mt_rand(100, 200)),
                        'user_limit'       => mt_rand(1, 10),
                    ]));
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
