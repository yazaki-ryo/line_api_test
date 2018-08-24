<?php
declare(strict_types=1);

return [

    /*
     |--------------------------------------------------------------------------
     | HTML Page Elements Language Lines
     |--------------------------------------------------------------------------
     |
     */

    'actions' => [
        'cancel'         => 'キャンセル',
        'copy'           => 'コピー',
        'create'         => '登録',
        'created'        => '登録',
        'delete'         => '削除',
        'deleted'        => '削除',
        'edit'           => '編集',
        'edited'         => '編集',
        'export'         => 'エクスポート',
        'history'        => '履歴',
        'import'         => 'インポート',
        'log'            => 'ログ',
        'login'          => 'ログイン',
        'logout'         => 'ログアウト',
        'menu'           => 'メニュー',
        'output'         => '出力',
        'print'          => '印刷',
        'printed'        => '印刷',
        'register'       => '登録',
        'registered'     => '登録',
        'reset_search'   => '条件リセット',
        'restore'        => '復旧',
        'restored'       => '復旧',
        'result'         => '結果',
        'save'           => '保存',
        'saved'          => '保存',
        'search'         => '検索',
        'select'         => '選択',
        'selected'       => '選択',
        'set'            => '設定',
        'submit'         => '送信',
        'update'         => '更新',
        'updated'        => '更新',
        'visit'          => '来店',
    ],

    'labels' => [
        'action'         => '操作',
        'data'           => 'データ',
        'image'          => '画像',
        'information'    => '情報',
        'joining'        => '参加中',
        'mode'           => 'モード',
        'name_collation' => '名寄せ',
        'no'             => 'いいえ',
        'notice'         => 'お知らせ',
        'notification'   => '通知',
        'paid'           => '済',
        'postcard'       => 'はがき',
        'pdf'            => 'PDF',
        'preview'        => 'プレビュー',
        'primary'        => 'メイン',
        'required'       => '必須',
        'sample'         => 'サンプル',
        'state' => [
            'without' => '以外',
            'with'    => 'を含む',
            'only'    => 'のみ',
        ],
        'tags'           => 'タグ',
        'test'           => 'テスト',
        'trashed'        => '削除データ',
        'unpaid'         => '未',
        'yes'            => 'はい',
    ],

    'menus' => [
        'customers'      => '顧客管理',
        'reservations'   => '予約管理',
        'tags'           => 'タグ管理',
        'menus'          => 'メニュー管理',
        'surveys'        => 'アンケート管理',
        'coupons'        => 'クーポン管理',
        'configurations' => '各種設定',
    ],

    'pages' => [
        'auth' => [
            'login' => 'ログイン',
            'logout' => 'ログアウト',
            'passwords' => [
                'reset'    => 'パスワードリセット',
                'reminder' => 'パスワードリマインダ',
            ],
            'register' => 'ユーザー登録',
        ],
        'configurations' => [
            'company' => '企業情報編集',
            'profile' => 'ユーザー情報編集',
            'store'   => '店舗情報編集',
        ],
        'customers' => [
            'index' => '顧客一覧',
            'add'   => '顧客登録',
            'edit'  => '顧客情報編集',
        ],
        'home' => 'ホーム',
    ],

    'placeholders' => [
        'customers' => [
            'last_name_kana'  => 'セイ',
            'first_name_kana' => 'メイ',
            'age'             => '35',
            'office'          => '株式会社サンプル',
            'office_kana'     => 'カブシキガイシャサンプル',
            'department'      => '営業部',
            'position'        => '課長',
            'postal_code'     => '5420085',
            'address'         => '大阪市中央区心斎橋筋2-2-30',
            'building_name'   => 'サンプルマンション801',
            'tel'             => '0661112222',
            'fax'             => '0663334444',
            'email'           => 'sample@sample.jp',
            'mobile_phone'    => '09011112222',
            'note'            => 'パーソナルメモとしてご利用ください',
        ],
    ],

    'postcards' => [
        'new_year_card'        => '年賀はがき',
        'summer_greeting_card' => '暑中見舞い',
    ],

    'resources' => [
        'companies' => '企業',
        'customers' => '顧客',
        'stores'    => '店舗',
        'users'     => 'ユーザー',
    ],

];
