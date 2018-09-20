<?php
declare(strict_types=1);

use App\Eloquents\EloquentCompany;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
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

    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect(self::$items)->each(function ($item) {
                    EloquentCompany::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
