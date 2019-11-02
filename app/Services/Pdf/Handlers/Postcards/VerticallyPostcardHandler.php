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

    private $previousFontSize = 10;

    /**
     * @param DomainModel[] $data
     * @return void
     */
    public function process(array $data): void
    {
        $this->setData($data);
        $this->init();
        $this->loop();

        // test
//         $this->processor->Line(10, 160, 10 + 200 * cos(30 / 180 * 3.14), 160 - 200 * sin(30 / 180 * 3.14));
//         $this->processor->SetFont("gothic", "", 16);
//         $this->processor->Rotate(30, 10, 160);
//         $this->processor->Text(30, 30, "test");
//         $this->processor->Rotate(-30, 10, 160);
    }

    /**
     * @return void
     */
    protected function init(): void
    {
        $this->templates($this->mode === 'preview' ? 'preview' :
            ($this->settings->pcPosition() === 'fixed' && $this->settings->pcFrame()->asBoolean() ? 'with_pc_frame' : 'plain')
        );
        $this->processor->SetMargins(0,0,0);
        $this->processor->SetAutoPageBreak(false);
        $this->processor->setPrintHeader(false);
        $this->processor->setPrintFooter(false);
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

            // 郵便番号がある場合のみセット
            if(!empty($item->postalCode())) {
                $this->postalCode($item->postalCode()->asString());
            }
            
            $this->address($item->address(), $item->building());

            // 氏名がNULLの場合は空文字にする
            $this->name($item->lastName(), !is_null($item->firstName()) ? $item->firstName() : "", $item->office(), $item->department(), $item->position());

            // 郵便番号がある場合のみセット
            if(!empty($this->from->postalCode())) {
                $this->fromPostalCode($this->from->postalCode()->asString());
            }

            $this->fromAddress($this->from->address(), $this->from->building());
            
            $this->fromName($this->from->name());
            // 以下に差出人名を追加
            $personalName = !empty($this->from->personalName()) ? $this->from->personalName() : "";
            $this->fromPersonalName($personalName);
        }
    }

    /**
     * @return void
     */
    public function render(): void
    {
        if ($this->processor->getPage()) {
            $this->processor->Output($this->filename, 'I');
        }
    }

    /**
     * @return void
     */
    public function export(): void
    {
        if ($this->processor->getPage()) {
            $this->processor->Output($this->filename, 'D');
        }
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->processor->getPage()) {
            $this->processor->Output($this->filename, 'F');
        }
    }

    /**
     * @param string $value
     * @return void
     */
    private function postalCode(string $value): void
    {
        $this->fonts($this->settings->pcFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->pcFontSize(), '', true);

        if ($this->settings->pcPosition() === 'fixed') {
            $x = 45.5;
            $y = 14.0;
            $this->processor->text($x, $y, mb_substr($value, 0, 1));
            $this->processor->text($x += 7.0, $y, mb_substr($value, 1, 1));
            $this->processor->text($x += 7.0, $y, mb_substr($value, 2, 1));
            $this->processor->text($x += 7.6, $y, mb_substr($value, 3, 1));
            $this->processor->text($x += 6.8, $y, mb_substr($value, 4, 1));
            $this->processor->text($x += 6.8, $y, mb_substr($value, 5, 1));
            $this->processor->text($x += 6.8, $y, mb_substr($value, 6, 1));
        } elseif ($this->settings->pcPosition() === 'free') {
            $this->processor->setFontSpacing(0.5);
            $this->processor->text((float)$this->settings->pcX(), (float)$this->settings->pcY(), sprintf('%s%s-%s', $this->settings->pcSymbol()->asBoolean() ? '〒' : '', mb_substr($value, 0, 3), mb_substr($value, 3, 4)));
        }
    }

    /**
     * @param string $value
     * string $building|null
     * @return void
     */
    private function address(string $address, string $building = null): void
    {
        $address = mb_convert_kana($address, 'rn', 'UTF-8');
        $this->fonts($this->settings->addressFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->addressFontSize(), '', true);
        $this->processor->setFontSpacing(0);
        $this->variableMultiCell(73.0, 20.0, sprintf("%s", $address), 0, 'L', 0, 0, (float)$this->settings->addressX(), (float)$this->settings->addressY(), true, 0, false, true, 20.0, 'T', true, (float)$this->settings->addressFontSize());
        $this->variableMultiCell(65.0, 20.0, sprintf("%s", $building), 0, 'L', 0, 0, (float)$this->settings->addressX(), 45.0, true, 0, false, true, 20.0, 'T', true, (float)$this->previousFontSize);
    }

    /**
     * @param string $lastName
     * @param string $firstName
     * @param string|null $company
     * @param string|null $department
     * @param string|null $position
     * @return void
     */
    private function name(string $lastName, string $firstName, string $company = null, string $department = null, string $position = null): void
    {
        $this->fonts($this->settings->nameFont());
        $y = (float)$this->settings->nameY();

        if (! is_null($company)) {
            $this->processor->SetFont($this->font, '', (float)$this->settings->storeNameFontSize(), '', true);// TODO company font and size
            $this->processor->setFontSpacing(1.0);
            $this->variableMultiCell(75.0, 5.0, $company, 0, 'C', 0, 0, 20.0, $y, true, 0, false, true, 10.0, 'T', true, (float)$this->settings->storeNameFontSize());
            $y += 10.0;

            if (! is_null($department)) {
                if (! is_null($position)) {
                    $department = sprintf('%s　%s', $department, $position);
                }

                $this->processor->SetFont($this->font, '', (float)$this->settings->departmentNameFontSize(), '', true);// TODO department font and size
                $this->processor->setFontSpacing(0.5);
                $this->variableMultiCell(70.0, 5.0, $department, 0, 'C', 0, 0, 18.0, $y, true, 0, false, true, 10.0, 'T', true, (float)$this->previousFontSize);
                $y += 10.0;
            }
        }

        $this->processor->SetFont($this->font, '', (float)$this->settings->nameFontSize(), '', true);
        $this->processor->setFontSpacing(2.0);
        $this->processor->MultiCell(60.0, 15.0, sprintf('%s%s%s', $lastName, $firstName, '様'), 0, 'C', 0, 0, (float)$this->settings->nameX(), $y, true, 0, false, true, 15.0, 'T', true);
    }

    /**
     * @param string $value
     * @return void
     */
    private function fromPostalCode(string $value): void
    {
        if (! $this->settings->fromFlag()->asBoolean()) return;

        $this->fonts($this->settings->fromPcFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->fromPcFontSize(), '', true);

        if ($this->settings->fromPcPosition() === 'fixed') {
            $x = 9.4;
            $y = 118.3;
            $this->processor->text($x, $y, mb_substr($value, 0, 1));
            $this->processor->text($x += 3.7, $y, mb_substr($value, 1, 1));
            $this->processor->text($x += 3.7, $y, mb_substr($value, 2, 1));
            $this->processor->text($x += 4.5, $y, mb_substr($value, 3, 1));
            $this->processor->text($x += 3.7, $y, mb_substr($value, 4, 1));
            $this->processor->text($x += 3.7, $y, mb_substr($value, 5, 1));
            $this->processor->text($x += 3.7, $y, mb_substr($value, 6, 1));
        } elseif ($this->settings->fromPcPosition() === 'free') {
            $this->processor->setFontSpacing(0.2);
            $this->processor->text((float)$this->settings->fromPcX(), (float)$this->settings->fromPcY(), sprintf('%s%s-%s', $this->settings->fromPcSymbol()->asBoolean() ? '〒' : '', mb_substr($value, 0, 3), mb_substr($value, 3, 4)));
        }
    }

    /**
     * @param string $value
     * string $building|null
     * @return void
     */
    private function fromAddress(string $address, string $building = null): void
    {
        if (! $this->settings->fromFlag()->asBoolean()) return;

        $this->fonts($this->settings->fromAddressFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->fromAddressFontSize(), '', true);
        $this->processor->setFontSpacing(0);
        $this->processor->MultiCell(85.0, 15.0, sprintf("%s%s%s", $address, PHP_EOL, $building), 0, 'L', 0, 0, (float)$this->settings->fromAddressX(), (float)$this->settings->fromAddressY(), true, 0, false, true, 15.0, 'T', true);
    }

    /**
     * @param string $value
     * @return void
     */
    private function fromName(string $value): void
    {
        if (! $this->settings->fromFlag()->asBoolean()) return;

        $this->fonts($this->settings->fromNameFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->fromNameFontSize(), '', true);
        $this->processor->setFontSpacing(1.0);
        $this->processor->MultiCell(50.0, 10.0, $value, 0, 'R', 0, 0, (float)$this->settings->fromNameX(), (float)$this->settings->fromNameY(), true, 0, false, true, 10.0, 'T', true);
    }

    /**
     * @param string $value
     * @return void
     */
    private function fromPersonalName(string $value): void
    {
        if (! $this->settings->fromFlag()->asBoolean()) return;

        $this->fonts($this->settings->fromPersonalNameFont());
        $this->processor->SetFont($this->font, '', (float)$this->settings->fromPersonalNameFontSize(), '', true);
        $this->processor->setFontSpacing(1.0);
        $this->processor->MultiCell(50.0, 10.0, $value, 0, 'R', 0, 0, (float)$this->settings->fromPersonalNameX(), (float)$this->settings->fromPersonalNameY(), true, 0, false, true, 10.0, 'T', true);
    }

    private function variableMultiCell($w, $h, $txt, $border, $align, $fill, $ln, $x, $y, $reseth, $stretch, $ishtml, $autopadding, $maxh, $valign, $fitcell, $fontSize)
    {
        for ($i = 0; $i < 5; $i++ ) {
            // 文字列の幅を取得
            $strWidth = $this->processor->GetStringWidth($txt, $this->font, '', $fontSize);
            // $w >= ( mb_strlen(trim($txt), 'UTF-8')) * ($fontSize - $i) * 0.35
            if ( $w <= $strWidth ){
                $fontSize = $fontSize - $i;
            }
        }
        $this->processor->SetFontSize($fontSize, true);
        $this->previousFontSize = $fontSize;
        $this->processor->MultiCell($w, $h, $txt, $border, $align, $fill, $ln, $x, $y, $reseth, $stretch, $ishtml, $autopadding, $maxh, $valign, $fitcell);
    }

}
