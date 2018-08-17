<?php
declare(strict_types=1);

namespace App\Services;

use Domain\Contracts\Responses\OutputableContract;
use setasign\Fpdi\TcpdfFpdi;

final class PdfService implements OutputableContract
{
    /** @var TcpdfFpdi */
    private $processor;

    /**
     * @param TcpdfFpdi $processor
     */
    public function __construct(TcpdfFpdi $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @param  string $mode
     * @param  array $data
     */
    public function output(string $mode, array $data)
    {
        $this->processor = new TcpdfFpdi;
        $this->processor->SetMargins(0,0,0);
        $this->processor->SetAutoPageBreak(false);
        $this->processor->setPrintHeader(false);
        $this->processor->setPrintFooter(false);
        $this->processor->SetTitle($filename = 'postcard.pdf');
//         $this->processor->SetSubject('Hello World!');

        $this->processor->setSourceFile(storage_path('system/pdf/postcards/postcard.pdf'));
        $index = $this->processor->importPage(1);

        $this->processor->AddPage();

        $this->processor->useTemplate($index, null, null, null, null, true);
        $this->processor->SetFont("kozgopromedium"/*"kozminproregular"*/, "", 12);
        $this->processor->Text(0, 0, __('Dedicated development in progress.'));

//         $this->processor->Line(10, 160, 10 + 200 * cos(30 / 180 * 3.14), 160 - 200 * sin(30 / 180 * 3.14));
//         $this->processor->SetFont("kozgopromedium", "", 16);
//         $this->processor->Rotate(30, 10, 160);
//         $this->processor->Text(30, 30, "test");
//         $this->processor->Rotate(-30, 10, 160);

        $this->processor->Output($filename, 'I');
    }

}
