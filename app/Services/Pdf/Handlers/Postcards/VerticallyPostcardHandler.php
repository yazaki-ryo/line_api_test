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
            $this->address($item->address(), $item->buildingName());
            $this->name($item->lastName(), $item->firstName());
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
        $this->fonts('gothic');
        $this->processor->SetFont($this->font, '', 12, '', true);
        $value = '1234567';//test

        /**
         * 枠内出力
         */
        $x = 45.5;
        $y = 14.0;
        $this->processor->text($x, $y, mb_substr($value, 0, 1));
        $this->processor->text($x + 7.0, $y, mb_substr($value, 1, 1));
        $this->processor->text($x + 14.0, $y, mb_substr($value, 2, 1));
        $this->processor->text($x + 21.6, $y, mb_substr($value, 3, 1));
        $this->processor->text($x + 28.4, $y, mb_substr($value, 4, 1));
        $this->processor->text($x + 35.2, $y, mb_substr($value, 5, 1));
        $this->processor->text($x + 42.0, $y, mb_substr($value, 6, 1));

        /**
         * 任意位置
         */
        $this->fonts('mincho');
        $this->processor->SetFont($this->font, '', 12, '', true);
        $this->processor->setFontSpacing(0.5);
        $this->processor->text(15.0, 40.0, sprintf('〒%s-%s', mb_substr($value, 0, 3), mb_substr($value, 3, 4)));
    }

    /**
     * @param string $value
     * string $building
     * @return void
     */
    private function address(string $address, string $building = ''): void
    {
        $this->fonts('mincho');
        $this->processor->SetFont($this->font, '', 12, '', true);
        $this->processor->setFontSpacing(0);
        $this->processor->MultiCell(70.0, 20.0, sprintf("%s%s%s", $address, PHP_EOL, $building), 0, 'L', 0, 0, 15.0, 45.0, true, 0, false, true, 20, 'T', true);
    }

    /**
     * @param string $lastName
     * @param string $firstName
     * @return void
     */
    private function name(string $lastName, string $firstName): void
    {
        $this->fonts('mincho');
        $this->processor->SetFont($this->font, '', 14, '', true);
        $this->processor->setFontSpacing(3.0);
        $this->processor->MultiCell(60.0, 20.0, sprintf('%s%s%s', $lastName, $firstName, '様'), 0, 'L', 0, 0, 20.0, 65.0, true, 0, false, true, 20, 'T', true);
    }

}
