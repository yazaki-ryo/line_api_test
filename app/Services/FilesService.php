<?php
declare(strict_types=1);

namespace App\Services;

use Domain\Contracts\Handlers\HandlableContract;
use Domain\Contracts\Responses\ExportableContract;
use Domain\Contracts\File\ParsableContract;
// use Illuminate\Support\Collection;

final class FilesService implements
    ExportableContract,
    ParsableContract
{
//     /** @var Collection */
//     private $handlers;

    /**
     * @param HandlableContract[] $handlers
     * @return void
     */
    public function __construct(array $handlers = [])
    {
//         $this->handlers = collect([]);
//         $this->setHandlers($handlers);
    }

    /**
     * @param array $args
     */
    public function export(array $args)
    {
//         foreach ($this->handlers as $handler) {
//             $handler->process($args);
//         }
    }

    /**
     * @param \SplFileObject $file
     */
    public function parse(\SplFileObject $file)
    {
        dd($file);

//         foreach ($this->handlers as $handler) {
//             $handler->process($args);
//         }
    }

}
