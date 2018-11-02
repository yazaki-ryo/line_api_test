<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

final class UtilitiesService
{
    /**
     * @param ViewErrorBag $errorBags
     * @param string|null $name
     * @param bool $request
     * @return string
     */
    public function activatable(ViewErrorBag $errorBags, string $name = null, bool $request = false): string
    {
        /** @var MessageBag $errorBag */
        foreach ($errorBags->getBags() as $key => $errorBag) {
            if ($errorBag->any()) {
                if (is_null($name)) {
                    return '';
                } elseif ($key === $name) {
                    return 'active';
                }
            }
        }

        if (request()->has('tab')) {
            return $request ? 'active' : '';
        } else {
            return is_null($name) ? 'active' : '';
        }
    }
}
