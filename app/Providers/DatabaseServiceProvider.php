<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\Contracts\Transaction;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

final class DatabaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->bind(Transaction::class, function () {
            return new class implements Transaction
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
