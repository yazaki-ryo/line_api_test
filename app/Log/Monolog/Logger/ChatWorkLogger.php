<?php
declare(strict_types=1);

namespace App\Log\Monolog\Logger;

use App\Log\Monolog\Handler\ChatworkHandler;
use Monolog\Logger;

final class ChatWorkLogger
{
    /**
     * @param  array $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        return new Logger('chatwork', [
            new ChatWorkHandler(
                $config['token'],
                $config['room'],
                $config['level'],
                $config['bubble']
            ),
        ]);
    }
}
