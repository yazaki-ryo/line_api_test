<?php
declare(strict_types=1);

namespace App\Log\Monolog\Handler;

use GuzzleHttp\Client;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

final class ChatWorkHandler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $room;

    /**
     * @var string
     */
    protected $requestUrl = 'https://api.chatwork.com/v2';

    /**
     * @param string $token
     * @param string $room
     * @param int    $level
     * @param bool   $bubble
     */
    public function __construct(string $token, string $room, $level = Logger::EMERGENCY, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->token = $token;
        $this->room = $room;
    }

    /**
     * @param array $record
     * @return void
     *
     * {@inheritDoc}
     * @see \Monolog\Handler\AbstractProcessingHandler::write()
     */
    protected function write(array $record)
    {
        (new Client)->post(
            sprintf("%s/rooms/%s/messages", $this->requestUrl, $this->room),
            [
                'headers' => [
                    'X-ChatWorkToken' => $this->token,
                ],
                'form_params' => [
                    'body' => sprintf('[info]%s[/info]', $record['formatted']),
                ],
            ]
        );
    }
}
