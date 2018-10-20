<?php
declare(strict_types=1);

use App\Eloquents\EloquentCustomer;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
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
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect(self::$items)->each(function ($item) {
                    /** @var EloquentCustomer $customer */
                    $customer = EloquentCustomer::create($item);

                    /**
                     * Tags
                     */
                    $ids = $customer->store->tags()->pluck('id');
                    $customer->tags()->sync($ids->random(mt_rand(0, (int)(($ids->count() + 1) / 3))));

                    /**
                     * Visited histories
                     */
                    if ($customer->getKey() & 1) {// odd
                        $customer->visitedHistories()->create([
                            'visited_at' => now()->subMonth($customer->id)->setTime($customer->id + 17, 30),
                            'seat'       => sprintf('テスト%s席', $customer->id),
                            'amount'     => $customer->id,
                            'note'       => '忘れ物有り',
                        ]);
                    }
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
