<?php
declare(strict_types=1);

use App\Eloquents\EloquentRole;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
        [
            'id'    => 1,
            'name'  => '管理者',
            'slug'  => 'company-admin',
        ],
        [
            'id'    => 2,
            'name'  => '店舗担当者',
            'slug'  => 'store-user',
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
                    EloquentRole::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
