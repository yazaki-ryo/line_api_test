<?php
declare(strict_types=1);

namespace App\Services\Pdf\Handlers\Postcards;

use Domain\Contracts\Handlers\HandlableContract;
use Domain\Models\DomainModel;
use Illuminate\Support\Collection;

abstract class AbstractPdfHandler implements HandlableContract
{
    /** @var Collection */
    protected $args;

    /**
     * @param DomainModel[] $args
     * @return void
     */
    abstract public function process(array $args): void;

    /**
     * @return void
     */
    abstract protected function init(): void;

    /**
     * @return void
     */
    abstract protected function loop(): void;

    /**
     * @return void
     */
    abstract protected function output(): void;

    /**
     * @param DomainModel $model
     * @return $this
     */
    public function pushData(DomainModel $model): self
    {
        $this->data->push($model);
        return $this;
    }

    /**
     * @return DomainModel
     */
    public function popData(): DomainModel
    {
        if (!$this->data) {
            throw new \LogicException('You tried to pop from an empty data stack.');
        }

        return $this->data->pop();
    }

    /**
     * @return Collection
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    /**
     * @param DomainModel[] $model
     * @return $this
     */
    public function setData(array $args = []): self
    {
        foreach (collect($args) as $value) {
            $this->pushData($value);
        }

        return $this;
    }
}
