<?php
declare(strict_types=1);

namespace App\Services\Pdf;

use App\Services\Pdf\Handlers\Postcards\VerticallyPostcardHandler;
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
     */
    public function export(array $data)
    {
        foreach ($this->handlers as $handler) {
            $handler->process($data);
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

    /**
     * @param array|string $keys
     * @return Collection
     */
    public function setHandlersByKeys($keys): self
    {
        $keys = is_array($keys) ? $keys : [$keys];

        foreach (collect($keys) as $key) {
            switch ($key) {
                case ('new_year_card'):
                    $this->pushHandler(app(VerticallyPostcardHandler::class));
                    break;

//                 case ('summer_greeting_card'):
//                     $this->pushHandler();
//                     break;

                default:
                    throw new \LogicException('The specified mode name is invalid.');
            }
        }

        return $this;
    }

}
