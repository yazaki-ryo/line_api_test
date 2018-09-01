<?php
declare(strict_types=1);

namespace App\Services\Pdf\Handlers\Postcards;

use App\Services\Pdf\Handlers\PdfHandler;
use Domain\Contracts\Handlers\HandlableContract;
use Domain\Models\DomainModel;
use setasign\Fpdi\TcpdfFpdi;
use TCPDF_FONTS;

final class VerticallyPostcardHandler extends PdfHandler implements HandlableContract
{
    /** @var TcpdfFpdi */
    private $processor;

    /** @var TCPDF_FONTS */
    private $fonts;

    /** @var string */
    private $jfont;

    /** @var string */
    private $fontPath;

    /** @var string */
    private $tpl;

    /** @var string */
    private $tplPath;

    /** @var string */
    private $filename = 'postcard.pdf';

    /**
     * @param TcpdfFpdi $processor
     * @param TCPDF_FONTS $fonts
     */
    public function __construct(TcpdfFpdi $pdf, TCPDF_FONTS $fonts)
    {
        $this->tplPath  = storage_path('system/pdf/postcards/postcard.pdf');
        $this->fontPath = storage_path('system/fonts/HanaMinA.ttf');

        $this->processor = $pdf;
        $this->fonts = $fonts;
        $this->data = collect([]);
    }

    /**
     * @param DomainModel[] $args
     * @return void
     */
    public function process(array $args): void
    {
        $this->setData($args);
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
        $this->processor->setSourceFile($this->tplPath);
        $this->tpl = $this->processor->importPage(1);
        $this->jfont = $this->fonts->addTTFfont($this->fontPath);
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
        $this->processor->SetFont($this->jfont, '', 20, '', true);
        $this->processor->setFontSpacing(3.5);
        $this->processor->text(45.0, 12.0, $value);
    }

}
