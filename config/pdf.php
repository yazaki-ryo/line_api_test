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

    'defaults' => [
        'pc_position'              => 'fixed',
        'pc_frame'                 => false,
        'pc_symbol'                => true,
        'pc_x'                     => 15,
        'pc_y'                     => 35,
        'pc_font'                  => 'gothic',
        'pc_font_size'             => 12,

        'address_x'                => 15,
        'address_y'                => 40,
        'address_font'             => 'gothic',
        'address_font_size'        => 12,

        'name_x'                   => 20,
        'name_y'                   => 70,
        'name_font'                => 'gothic',
        'name_font_size'           => 14,

        'from_flag'                => true,
        'from_pc_symbol'           => true,
        'from_pc_x'                => 0,
        'from_pc_y'                => 0,
        'from_pc_font'             => 'gothic',
        'from_pc_font_size'        => 10,

        'from_address_x'           => 0,
        'from_address_y'           => 0,
        'from_address_font'        => 'gothic',
        'from_address_font_size'   => 10,

        'from_name_x'              => 0,
        'from_name_y'              => 0,
        'from_name_font'           => 'gothic',
        'from_name_font_size'      => 12,
    ],

];
