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
        $this->templates('vertically_postcard');
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

            $this->postalCode($item->postalCode());
            $this->address($item->address(), $item->building());
            $this->name($item->lastName(), $item->firstName(), $item->office(), $item->department(), $item->position());

            $this->fromPostalCode($this->from->postalCode());
            $this->fromAddress($this->from->address(), $this->from->building());
            $this->fromName($this->from->name());
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
        //
    }

    /**
     * @param string $value
     * @return void
     */
    private function postalCode(string $value): void
    {
        /**
         * TODO XXX
         */
        $value = '1234567';

        $this->fonts($this->settings['pc_font']);
        $this->processor->SetFont($this->font, '', (float)$this->settings['pc_font_size'], '', true);

        if ($this->settings['pc_position'] === 'fixed') {
            $x = 45.5;
            $y = 14.0;
            $this->processor->text($x, $y, mb_substr($value, 0, 1));
            $this->processor->text($x + 7.0, $y, mb_substr($value, 1, 1));
            $this->processor->text($x + 14.0, $y, mb_substr($value, 2, 1));
            $this->processor->text($x + 21.6, $y, mb_substr($value, 3, 1));
            $this->processor->text($x + 28.4, $y, mb_substr($value, 4, 1));
            $this->processor->text($x + 35.2, $y, mb_substr($value, 5, 1));
            $this->processor->text($x + 42.0, $y, mb_substr($value, 6, 1));
        } elseif ($this->settings['pc_position'] === 'free') {
            $this->processor->setFontSpacing(0.5);
            $this->processor->text((float)$this->settings['pc_x'], (float)$this->settings['pc_y'], sprintf('%s%s-%s', (bool)$this->settings['pc_symbol'] ? '〒' : '', mb_substr($value, 0, 3), mb_substr($value, 3, 4)));
        }
    }

    /**
     * @param string $value
     * string $building|null
     * @return void
     */
    private function address(string $address, string $building = null): void
    {
        $this->fonts($this->settings['address_font']);
        $this->processor->SetFont($this->font, '', (float)$this->settings['address_font_size'], '', true);
        $this->processor->setFontSpacing(0);
        $this->processor->MultiCell(70.0, 20.0, sprintf("%s%s%s", $address, PHP_EOL, $building), 0, 'L', 0, 0, (float)$this->settings['address_x'], (float)$this->settings['address_y'], true, 0, false, true, 20.0, 'T', true);
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
        $this->fonts($this->settings['name_font']);
        $y = (float)$this->settings['name_y'];

        if (! is_null($company)) {
            $this->processor->SetFont($this->font, '', 13.0, '', true);// TODO company font and size
            $this->processor->setFontSpacing(2.0);
            $this->processor->MultiCell(70.0, 5.0, $company, 0, 'C', 0, 0, 15.0, $y, true, 0, false, true, 10.0, 'T', true);
            $y += 10.0;

            if (! is_null($department)) {
                if (! is_null($position)) {
                    $department = sprintf('%s　%s', $department, $position);
                }

                $this->processor->SetFont($this->font, '', 11.0, '', true);// TODO department font and size
                $this->processor->setFontSpacing(0.5);
                $this->processor->MultiCell(60.0, 5.0, $department, 0, 'C', 0, 0, 20.0, $y, true, 0, false, true, 10.0, 'T', true);
                $y += 10.0;
            }
        }

        $this->processor->SetFont($this->font, '', (float)$this->settings['name_font_size'], '', true);
        $this->processor->setFontSpacing(2.0);
        $this->processor->MultiCell(60.0, 20.0, sprintf('%s%s%s', $lastName, $firstName, '様'), 0, 'C', 0, 0, (float)$this->settings['name_x'], $y, true, 0, false, true, 20.0, 'T', true);
    }

    /**
     * @param string $value
     * @return void
     */
    private function fromPostalCode(string $value): void
    {
        if (! $this->settings['from_flag']) return;

        /**
         * TODO XXX
         */
        $value = '1234567';

        $this->fonts($this->settings['from_pc_font']);
        $this->processor->SetFont($this->font, '', (float)$this->settings['from_pc_font_size'], '', true);
        $this->processor->setFontSpacing(0.2);
        $this->processor->text((float)$this->settings['from_pc_x'], (float)$this->settings['from_pc_y'], sprintf('%s%s-%s', $this->settings['from_pc_symbol'] ? '〒' : '', mb_substr($value, 0, 3), mb_substr($value, 3, 4)));
    }

    /**
     * @param string $value
     * string $building|null
     * @return void
     */
    private function fromAddress(string $address, string $building = null): void
    {
        $this->fonts($this->settings['from_address_font']);
        $this->processor->SetFont($this->font, '', (float)$this->settings['from_address_font_size'], '', true);
        $this->processor->setFontSpacing(0);
        $this->processor->MultiCell(50.0, 15.0, sprintf("%s%s%s", $address, PHP_EOL, $building), 0, 'L', 0, 0, (float)$this->settings['from_address_x'], (float)$this->settings['from_address_y'], true, 0, false, true, 15.0, 'T', true);

    }

    /**
     * @param string $value
     * @return void
     */
    private function fromName(string $value): void
    {
        $this->fonts($this->settings['from_name_font']);
        $this->processor->SetFont($this->font, '', (float)$this->settings['from_name_font_size'], '', true);
        $this->processor->setFontSpacing(1.0);
        $this->processor->MultiCell(50.0, 10.0, $value, 0, 'R', 0, 0, (float)$this->settings['from_name_x'], (float)$this->settings['from_name_y'], true, 0, false, true, 10.0, 'T', true);
    }

}
