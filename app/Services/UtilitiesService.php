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
     * @return string
     */
    public function activatable(ViewErrorBag $errorBags, string $name = null): string
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
        return is_null($name) ? 'active' : '';
    }
}
