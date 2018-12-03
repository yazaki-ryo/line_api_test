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
     * @param string|null $name
     * @param bool $default
     * @param bool $request
     * @return string
     */
    public function activatable(ViewErrorBag $errorBags, string $name = null, bool $default = false, bool $request = false): string
    {
        /** @var MessageBag $errorBag */
        foreach ($errorBags->getBags() as $key => $errorBag) {
            if ($errorBag->any()) {
                return $key === $name ? 'active' : '';
            }
        }

        if ($this->request->has('tab')) {
            return $request ? 'active' : '';
        } else {
            return $default ? 'active' : '';
        }
    }
}
