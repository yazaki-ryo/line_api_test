<?php
declare(strict_types=1);

namespace App\Services\Pdf;

use Domain\Contracts\Handlers\HandlableContract;
use Domain\Contracts\Responses\OutputableContract;

final class PdfService implements OutputableContract
{
    /** @var HandlableContract */
    private $handler;

    /**
     * @param HandlableContract $handler
     * @return void
     */
    public function __construct(HandlableContract $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param  string $mode
     * @param  array $data
     */
    public function output(string $mode, array $data)
    {
        $this->handler->process();
    }

}
