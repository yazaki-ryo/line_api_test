<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\Contracts\Database\TransactionalInterface;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

final class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TransactionalInterface::class, function () {
            return new class implements TransactionalInterface
            {
                /**
                 * @param callable $callee
                 * @return mixed
                 * @throws \Throwable
                 */
                public function transaction(callable $callee)
                {
                    /** @var Connection $connection */
                    $connection = app(Connection::class);

                    return $connection->transaction($callee);
                }
            };
        });
    }
}
