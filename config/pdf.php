<?php
declare(strict_types=1);

return [

    'fonts' => [
        'hanamina' => storage_path('system/fonts/HanaMinA.ttf'),
        'hanaminb' => storage_path('system/fonts/HanaMinB.ttf'),
    ],

    'fonttypes' => [
        'gothic' => 'ゴシック',
        'mincho' => '明朝',
    ],

    'fontsizes' => [
        9 => '9（ポイント）',
        10 => '10（ポイント）',
        11 => '11（ポイント）',
        12 => '12（ポイント）',
        13 => '13（ポイント）',
        14 => '14（ポイント）',
        15 => '15（ポイント）',
        16 => '16（ポイント）',
        17 => '17（ポイント）',
        18 => '18（ポイント）',
    ],

    'templates' => [
        'vertically_postcard' => storage_path('system/pdf/postcards/postcard.pdf'),
    ],

    'positions' => [
        'fixed' => '固定位置',
        'free'  => '自由位置',
    ],

];
