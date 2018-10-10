<?php
declare(strict_types=1);

return [

    'name' => [
        $key = 'printings' => sprintf('%s_%s', str_slug(env('SYS_NAME', 'laravel'), '_'), $key),
    ],

];
