<?php
declare(strict_types=1);

namespace App\Services\Pdf\Handlers\Postcards;

use Domain\Contracts\Handlers\HandlableContract;
use setasign\Fpdi\TcpdfFpdi;
use TCPDF_FONTS;

final class VerticallyPostcardHandler implements HandlableContract
{
    /** @var TcpdfFpdi */
    private $processor;

    /** @var TCPDF_FONTS */
    private $fonts;

    /**
     * @param TcpdfFpdi $processor
     * @param TCPDF_FONTS $fonts
     */
    public function __construct(TcpdfFpdi $pdf, TCPDF_FONTS $fonts)
    {
        $this->processor = $pdf;
        $this->fonts = $fonts;
    }

    /**
     * @return void
     */
    public function process($data): void
    {
        $this->processor->SetMargins(0,0,0);
        $this->processor->SetAutoPageBreak(false);
        $this->processor->setPrintHeader(false);
        $this->processor->setPrintFooter(false);

        $this->processor->setSourceFile(storage_path('system/pdf/postcards/postcard.pdf'));
        $tpl = $this->processor->importPage(1);

        $hanamina = $this->fonts->addTTFfont(storage_path('system/fonts/HanaMinA.ttf'));

        $this->processor->SetTitle($filename = 'postcard.pdf');
//         $this->processor->SetSubject('Hello World!');

        // Start of loop.
        $this->processor->AddPage();
        $this->processor->useTemplate($tpl, 0, 0, null, null, true);

        $this->processor->SetFont($hanamina, '', 24, '', true);
        $this->processor->setFontSpacing(3.5);
        $this->processor->text(44, 50, "花園明朝A");

        $this->processor->SetFont($hanamina, '', 20, '', true);
        $this->processor->setFontSpacing(3.5);
        $this->processor->text(45.0, 12.0, "5430001");
        // End of loop.

        if ($this->processor->getPage()) {
            $this->processor->Output($filename, 'I');
        }

// test
//         $this->processor->Line(10, 160, 10 + 200 * cos(30 / 180 * 3.14), 160 - 200 * sin(30 / 180 * 3.14));
//         $this->processor->SetFont("kozgopromedium", "", 16);
//         $this->processor->Rotate(30, 10, 160);
//         $this->processor->Text(30, 30, "test");
//         $this->processor->Rotate(-30, 10, 160);
    }
}
