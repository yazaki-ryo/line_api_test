<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

final class UtilitiesService
{
    /**
     * @param ViewErrorBag $errorBags
     * @param string $name
     * @param bool $default
     * @return string
     */
    public function activeTab(ViewErrorBag $errorBags, string $name = 'default', bool $default = true): string
    {
        /** @var MessageBag $errorBag */
        foreach ($errorBags->getBags() as $key => $errorBag) {
            if ($errorBag->any()) {
                if ($key === $name) {
                    return 'active';
                } elseif ($default) {
                    return '';
                }
            }
        }
        return $default ? 'active' : '';
    }
}
