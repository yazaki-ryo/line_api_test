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
        'postcard' => [
            'plain'         => storage_path('system/pdf/postcards/plain.pdf'),
            'preview'       => storage_path('system/pdf/postcards/preview.pdf'),
            'with_pc_frame' => storage_path('system/pdf/postcards/with_pc_frame.pdf'),
        ],
    ],

    'positions' => [
        'fixed' => '固定位置',
        'free'  => '自由位置',
    ],

    'defaults' => [
        'general' => [
            'name'                         => '官製ハガキ/暑中見舞',

            'pc_position'                  => 'fixed',
            'pc_frame'                     => false,
            'pc_symbol'                    => false,
            'pc_x'                         => 15,
            'pc_y'                         => 35,
            'pc_font'                      => 'gothic',
            'pc_font_size'                 => 12,

            'address_x'                    => 30,
            'address_y'                    => 40,
            'address_font'                 => 'gothic',
            'address_font_size'            => 10,

            'name_x'                       => 25,
            'name_y'                       => 60,
            'name_font'                    => 'gothic',
            'name_font_size'               => 10,

            'store_name_font_size'         => 10,

            'department_name_font_size'    => 10, 

            'from_flag'                    => true,
            'from_pc_position'             => 'free',
            'from_pc_symbol'               => true,
            'from_pc_x'                    => 40,
            'from_pc_y'                    => 105,
            'from_pc_font'                 => 'gothic',
            'from_pc_font_size'            => 10,

            'from_address_x'               => 40,
            'from_address_y'               => 110,
            'from_address_font'            => 'gothic',
            'from_address_font_size'       => 9,

            'from_name_x'                  => 40,
            'from_name_y'                  => 125,
            'from_name_font'               => 'gothic',
            'from_name_font_size'          => 9,
            
            'from_personal_name_x'         => 39,
            'from_personal_name_y'         => 135,
            'from_personal_name_font'      => 'gothic',
            'from_personal_name_font_size' => 8,
        ],

        'new_year' => [
            'name'                         => '年賀ハガキ/かもめ〜る',

            'pc_position'                  => 'fixed',
            'pc_frame'                     => false,
            'pc_symbol'                    => false,
            'pc_x'                         => 15,
            'pc_y'                         => 35,
            'pc_font'                      => 'gothic',
            'pc_font_size'                 => 12,

            'address_x'                    => 30,
            'address_y'                    => 35,
            'address_font'                 => 'gothic',
            'address_font_size'            => 10,

            'name_x'                       => 25,
            'name_y'                       => 55,
            'name_font'                    => 'gothic',
            'name_font_size'               => 10,

            'store_name_font_size'         => 10,

            'department_name_font_size'    => 10, 

            'from_flag'                    => true,
            'from_pc_position'             => 'fixed',
            'from_pc_symbol'               => false,
            'from_pc_x'                    => 40,
            'from_pc_y'                    => 95,
            'from_pc_font'                 => 'gothic',
            'from_pc_font_size'            => 10,

            'from_address_x'               => 40,
            'from_address_y'               => 94,
            'from_address_font'            => 'gothic',
            'from_address_font_size'       => 9,

            'from_name_x'                  => 40,
            'from_name_y'                  => 104,
            'from_name_font'               => 'gothic',
            'from_name_font_size'          => 9,

            'from_personal_name_x'         => 39,
            'from_personal_name_y'         => 110,
            'from_personal_name_font'      => 'gothic',
            'from_personal_name_font_size' => 8,
        ],
    ],

];
