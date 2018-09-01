<?php
declare(strict_types=1);

namespace App\Services\Pdf\Handlers\Postcards;

use App\Services\Pdf\Handlers\PdfHandler;
use App\Services\Pdf\Processors\TcpdfFpdiProcessor;
use Domain\Contracts\Handlers\HandlableContract;
use Domain\Models\DomainModel;

final class VerticallyPostcardHandler extends PdfHandler implements HandlableContract
{
    use TcpdfFpdiProcessor;

    /** @var string */
    private $filename = 'postcard.pdf';

    /**
     * @param DomainModel[] $data
     * @return void
     */
    public function process(array $data): void
    {
        $this->setData($data);
        $this->init();
        $this->loop();
        $this->output();

        // test
//         $this->processor->Line(10, 160, 10 + 200 * cos(30 / 180 * 3.14), 160 - 200 * sin(30 / 180 * 3.14));
//         $this->processor->SetFont("kozgopromedium", "", 16);
//         $this->processor->Rotate(30, 10, 160);
//         $this->processor->Text(30, 30, "test");
//         $this->processor->Rotate(-30, 10, 160);
    }

    /**
     * @return void
     */
    protected function init(): void
    {
        $this->processor->SetMargins(0,0,0);
        $this->processor->SetAutoPageBreak(false);
        $this->processor->setPrintHeader(false);
        $this->processor->setPrintFooter(false);
        $this->templates('vertically_postcard');
        $this->fonts('hanamina');// TODO Use variables.
        $this->processor->SetTitle($this->filename);
//         $this->processor->SetSubject('Hello World!');
    }

    /**
     * @return void
     */
    protected function loop(): void
    {
        foreach ($this->data as $item) {
            $this->processor->AddPage();
            $this->processor->useTemplate($this->tpl, 0, 0, null, null, true);

            $this->postalCode($item->postalCode());
        }
    }

    /**
     * @return void
     */
    protected function output(): void
    {
        if ($this->processor->getPage()) {
            $this->processor->Output($this->filename, 'I');
        }
    }

    /**
     * @param string $value
     * @return void
     */
    private function postalCode(string $value): void
    {
        $this->processor->SetFont($this->font, '', 20, '', true);
        $this->processor->setFontSpacing(3.5);
        $this->processor->text(45.0, 12.0, $value);
    }

}
