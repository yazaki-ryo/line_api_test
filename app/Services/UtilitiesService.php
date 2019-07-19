<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

final class UtilitiesService
{
    /** @var Request */
    private $request;

    /**
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param ViewErrorBag $errorBags
     * @param string $name
     * @param string $forceTab
     * @return string
     */
    public function activatable(ViewErrorBag $errorBags, string $name, string $forceTab = ''): string
    {
        /** @var MessageBag $errorBag */
        foreach ($errorBags->getBags() as $key => $errorBag) {
            if ($errorBag->any()) {
                return $key === $name ? 'active' : '';
            }
        }

        if ($this->request->has('tab')) {
            /** 検索後のタブを一覧にする処理 **/
            if(!empty($this->request->get('searched'))) {
                $this->request->request->add(['tab' => 'index']);
            }

            return $this->request->get('tab') === $name ? 'active' : '';
        }

        if (strlen($forceTab) > 0) {
            return $forceTab === $name ? 'active' : '';
        }

        return '';
    }
}
