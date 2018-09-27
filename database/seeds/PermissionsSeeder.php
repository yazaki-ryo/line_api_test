<?php
declare(strict_types=1);

use App\Eloquents\EloquentPermission;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private static $items = [];

    /**
     * @return void
     */
    public function __construct()
    {
        self::$items = config('permissions.seeds');
    }

    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect(self::$items)->each(function (array $resource) {
                    collect($resource)->each(function (array $item) {
                        EloquentPermission::create($item);
                    });
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
