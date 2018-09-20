<?php
declare(strict_types=1);

use App\Eloquents\EloquentUser;
use App\Eloquents\EloquentPermission;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [
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
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect(self::$items)->each(function ($item) {
                    EloquentUser::create(array_merge($item, [
                        'password'   => bcrypt('testtest'),
                    ]));
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
