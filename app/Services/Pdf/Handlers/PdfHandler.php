<?php
declare(strict_types=1);

namespace App\Services\Pdf\Handlers;

use Domain\Contracts\Handlers\HandlableContract;
use Domain\Models\DomainModel;
use Domain\Models\PrintSetting;
use Illuminate\Support\Collection;

abstract class PdfHandler implements HandlableContract
{
    /** @var Collection */
    protected $data;

    /** @var DomainModel|null */
    protected $from;

    /** @var PrintSetting */
    protected $settings;

    /** @var string */
    protected $mode;

    /**
     * @param array $args
     * @return void
     */
    abstract public function process(array $args): void;

    /**
     * @return void
     */
    abstract public function render(): void;

    /**
     * @return void
     */
    abstract public function export(): void;

    /**
     * @return void
     */
    abstract protected function init(): void;

    /**
     * @return void
     */
    abstract protected function loop(): void;

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
     * @param DomainModel[] $args
     * @return $this
     */
    public function setData(array $args = []): self
    {
        $this->data = collect([]);

        foreach (collect($args) as $value) {
            $this->pushData($value);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return DomainModel|null
     */
    public function getFrom(): ?DomainModel
    {
        return $this->from;
    }

    /**
     * @param DomainModel $model
     * @return $this
     */
    public function setFrom(DomainModel $model = null): self
    {
        $this->from = $model;
        return $this;
    }

    /**
     * @return PrintSetting|null
     */
    public function getSettings(): ?PrintSetting
    {
        return $this->settings;
    }

    /**
     * @param PrintSetting $args
     * @return $this
     */
    public function setSettings(PrintSetting $args): self
    {
        $this->settings = $args;
        return $this;
    }
}
