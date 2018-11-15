<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Attributes Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'companies' => [
        'id'                    => 'ID',
        'plan_id'               => 'プラン',
        'prefecture_id'         => '都道府県',
        'name'                  => '名称',
        'kana'                  => 'フリガナ',
        'postal_code'           => '郵便番号',
        'address'               => '市区町村・番地',
        'building'              => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',

        'user_limit'            => 'ユーザー上限数',
        'starts_at'             => 'サービス開始日時',
        'ends_at'               => 'サービス終了日時',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',
    ],

    'customers' => [
        'id'                    => 'ID',
        'store_id'              => '店舗',
        'prefecture_id'         => '都道府県',
        'sex_id'                => '性別',
        'last_name'             => '姓',
        'first_name'            => '名',
        'last_name_kana'        => '姓フリガナ',
        'first_name_kana'       => '名フリガナ',
        'office'                => '会社名',
        'office_kana'           => '会社名フリガナ',
        'department'            => '部署',
        'position'              => '役職',

        'postal_code'           => '郵便番号',
        'address'               => '市区町村・番地',
        'building'              => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',
        'mobile_phone'          => '携帯電話番号',

        'mourning_flag'         => '喪中設定',
        'birthday'              => '誕生日',
        'anniversary'           => '記念日',
        'likes_and_dislikes'    => '好き嫌い',
        'note'                  => 'メモ',

        'last_visited_at'       => '前回来店日時',
        'first_visited_at'      => '初回来店日時',

        'last_reserved_at'      => '前回予約日時',
        'first_reserved_at'     => '初回予約日時',

        'cancel_cnt'            => 'キャンセル回数',
        'noshow_cnt'            => 'ノーショウ回数',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',

        'search' => [
            'free_word'      => 'フリーワード',
            'mourning_flag'  => '喪中フラグ',
            'trashed'        => '削除データ',
            'visited_date_s' => '来店日（開始）',
            'visited_date_e' => '来店日（終了）',
            'tags'           => 'タグ',
        ],

        'tags'               => 'タグ',

        'postcards' => [
            'setting'   => '印刷設定',
            'selection' => '顧客選択',
        ],

        'files' => [
            'csv_file' => 'CSVファイル',
        ],

        'visited_histories' => [
            'visited_date' => '来店日',
            'visited_time' => 'チェックイン',
            'amount'       => '人数',
            'seat'         => '席',
            'note'         => 'メモ',
            'created_at'   => '登録日時',
            'updated_at'   => '更新日時',
        ],
    ],

    'reservations' => [
        'store_id'              => '店舗',
        'customer_id'           => '顧客',

        'reserved_date'         => '予約日',
        'reserved_time'         => '予約時間',
        'name'                  => 'お名前',
        'amount'                => '人数',
        'seat'                  => '席',
        'reservation_code'      => '予約コード',
        'floor'                 => 'フロア',
        'status'                => '状態',
        'note'                  => 'メモ',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
    ],

    'stores' => [
        'id'                    => 'ID',
        'company_id'            => '企業',
        'prefecture_id'         => '都道府県',
        'name'                  => '名称',
        'kana'                  => 'フリガナ',
        'postal_code'           => '郵便番号',
        'address'               => '市区町村・番地',
        'building'              => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',
    ],

    'tags' => [
        'name'                  => '名称',
        'label'                 => 'ラベル',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',

//         'search' => [
//         ],
    ],

    'users' => [
        'id'                    => 'ID',
        'name'                  => 'ログイン名',
        'email'                 => 'メールアドレス',
        'avatar'                => 'アイコン',
        'store_id'              => '店舗',
        'company_id'            => '企業',
        'role'                  => 'ロール',
        'password'              => 'パスワード',
        'password_confirmation' => 'パスワード(確認)',
        'remember'              => '次回から自動でログインする',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',

        'search' => [
            'free_word'      => 'フリーワード',
            'trashed'        => '削除データ',
        ],
    ],

    'settings' => [
        'printings' => [
            'name'              => '名称',
            'pc_position'       => '郵便番号出力位置',
            'pc_frame'          => '郵便番号枠出力',
            'pc_symbol'         => '〒マーク出力',
            'pc_x'              => '郵便番号 横（X）座標',
            'pc_y'              => '郵便番号 縦（Y）座標',
            'pc_font'           => '郵便番号書体',
            'pc_font_size'      => '郵便番号文字サイズ',

            'address_x'         => '住所 横（X）座標',
            'address_y'         => '住所 縦（Y）座標',
            'address_font'      => '住所書体',
            'address_font_size' => '住所文字サイズ',

            'name_x'            => '氏名 横（X）座標',
            'name_y'            => '氏名 縦（Y）座標',
            'name_font'         => '氏名書体',
            'name_font_size'    => '氏名文字サイズ',

            'from_flag'              => '差出人情報出力',
            'from_pc_symbol'         => '（差出人）〒マーク出力',
            'from_pc_x'              => '（差出人）郵便番号 横（X）座標',
            'from_pc_y'              => '（差出人）郵便番号 縦（Y）座標',
            'from_pc_font'           => '（差出人）郵便番号書体',
            'from_pc_font_size'      => '（差出人）郵便番号文字サイズ',

            'from_address_x'         => '（差出人）住所 横（X）座標',
            'from_address_y'         => '（差出人）住所 縦（Y）座標',
            'from_address_font'      => '（差出人）住所書体',
            'from_address_font_size' => '（差出人）住所文字サイズ',

            'from_name_x'            => '（差出人）氏名 横（X）座標',
            'from_name_y'            => '（差出人）氏名 縦（Y）座標',
            'from_name_font'         => '（差出人）氏名書体',
            'from_name_font_size'    => '（差出人）氏名文字サイズ',
        ],
    ],

    'trashed' => [
        'without' => '削除データ以外',
        'with'    => '削除データを含む',
        'only'    => '削除データのみ',
    ],

    'yes_or_no' => [
        1 => 'はい',
        0 => 'いいえ',
    ],

];
