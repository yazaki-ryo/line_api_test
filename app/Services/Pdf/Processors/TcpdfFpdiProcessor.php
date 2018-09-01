<?php
declare(strict_types=1);

namespace App\Services\Pdf\Processors;

use setasign\Fpdi\TcpdfFpdi;
use TCPDF_FONTS;

trait TcpdfFpdiProcessor
{
    /** @var TcpdfFpdi */
    private $processor;

    /** @var TCPDF_FONTS */
    private $fonts;

    /** @var string */
    private $font;

    /** @var string */
    private $tpl;

    /**
     * @param TcpdfFpdi $processor
     * @param TCPDF_FONTS $fonts
     */
    public function __construct(TcpdfFpdi $pdf, TCPDF_FONTS $fonts)
    {
        $this->processor = $pdf;
        $this->fonts     = $fonts;
    }

    /**
     * @param string $name
     * @return void
     */
    private function fonts(string $name): void
    {
        $this->font = $name;

        // Conversion is necessary except pre-installed fonts.
        switch ($name) {
            case 'hanamina':
            case 'hanaminb':
                $path = config(sprintf('pdf.fonts.%s', $name));
                $this->fonts->addTTFfont($path);
        }
    }

    /**
     * @param string $name
     * @param int $idx
     * @return void
     */
    private function templates(string $name, int $idx = 1): void
    {
        $path = config(sprintf('pdf.templates.%s', $name));
        $this->processor->setSourceFile($path);
        $this->tpl = $this->processor->importPage($idx);
    }
}
