<?php
declare(strict_types=1);

namespace App\Services\Pdf;

use Domain\Contracts\Handlers\HandlableContract;
use Domain\Contracts\Responses\ExportableContract;
use Illuminate\Support\Collection;

final class PdfService implements ExportableContract
{
    /** @var Collection */
    private $handlers;

    /**
     * @param HandlableContract[] $handlers
     * @return void
     */
    public function __construct(array $handlers = [])
    {
        $this->handlers = collect([]);
        $this->setHandlers($handlers);
    }

    /**
     * @param array $data
     * @param array $settings
     */
    public function export(array $data, array $settings = [])
    {
        /** @var HandlableContract $handler */
        foreach ($this->handlers as $handler) {
            $handler->setSettings($settings);
            $handler->process($data);
            $handler->render();
        }
    }

    /**
     * @param HandlableContract $handler
     * @return Collection
     */
    public function pushHandler(HandlableContract $handler): self
    {
        $this->handlers->push($handler);
        return $this;
    }

    /**
     * @return Collection
     */
    public function popHandler(): HandlableContract
    {
        if (!$this->handlers) {
            throw new \LogicException('You tried to pop from an empty handler stack.');
        }

        return $this->handlers->pop();
    }

    /**
     * @return Collection
     */
    public function getHandlers(): Collection
    {
        return $this->handlers;
    }

    /**
     * @param HandlableContract[] $handlers
     * @return Collection
     */
    public function setHandlers(array $handlers = []): self
    {
        foreach (collect($handlers) as $handler) {
            $this->pushHandler($handler);
        }

        return $this;
    }

}
