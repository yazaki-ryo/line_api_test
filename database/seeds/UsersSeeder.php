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
            'name'     => '企業管理者',
            'email'    => 'company-admin@test.jp',
        ],
        [
            'id'       => 2,
            'store_id' => 1,
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
                    /** @var EloquentUser $user */
                    $user = EloquentUser::create(array_merge($item, [
                        'password'   => bcrypt('testtest'),
                    ]));
                });

                /**
                 * Permissions
                 */
                $slugs = config('permissions.default.general.company-admin');
                $ids = EloquentPermission::slugs($slugs)->pluck('id');
                EloquentUser::find(1)->permissions()->sync($ids->all());

                $slugs = config('permissions.default.general.store-user');
                $ids = EloquentPermission::slugs($slugs)->pluck('id');
                EloquentUser::find(2)->permissions()->sync($ids->all());
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
