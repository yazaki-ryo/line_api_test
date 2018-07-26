<?php

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

    /**
     * XXX TODO auth -> usersに変更する
     */
    'auth' => [
        'id'                    => 'ID',
        'name'                  => 'ログイン名',
        'email'                 => 'メールアドレス',
        'store_id'              => '店舗',
        'company_id'            => '企業',
        'role_id'               => 'ロール',
        'password'              => 'パスワード',
        'password_confirmation' => 'パスワード(確認)',
        'remember'              => 'ログイン状態を記憶する',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',
    ],

    'companies' => [
        'id'                    => 'ID',
        'plan_id'               => 'プラン',
        'prefecture_id'         => '都道府県',
        'name'                  => '名称',
        'kana'                  => 'フリガナ',
        'postal_code'           => '郵便番号',
        'address'               => '住所',
        'building_name'         => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',
    ],

    'customers' => [
        'id'                    => 'ID',
        'store_id'              => '店舗',
        'prefecture_id'         => '都道府県',
        'sex_id'                => '性別',
//         'group_id'              => 'グループ',
//         'introducer_id'         => '紹介者',
        'name'                  => '氏名',
        'kana'                  => 'フリガナ',
        'age'                   => '年齢',
        'office'                => '勤務先',
        'department'            => '部署',
        'position'              => '役職',

        'postal_code'           => '郵便番号',
        'address'               => '住所',
        'building_name'         => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',
        'mobile_phone'          => '携帯電話番号',

        'mourning_flag'         => '喪中フラグ',
        'likes_and_dislikes'    => '好き嫌い',
        'note'                  => 'メモ',
        'visited_cnt'           => '来店回数',
        'cancel_cnt'            => 'キャンセル回数',
        'noshow_cnt'            => 'ノーショウ回数',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',

        'free_word'             => 'フリーワード',
    ],

    'stores' => [
        'id'                    => 'ID',
        'company_id'            => '企業',
        'prefecture_id'         => '都道府県',
        'name'                  => '名称',
        'kana'                  => 'フリガナ',
        'postal_code'           => '郵便番号',
        'address'               => '住所',
        'building_name'         => '建物名',
        'tel'                   => 'TEL',
        'fax'                   => 'FAX',
        'email'                 => 'メールアドレス',

        'payment_flag'          => '入金フラグ',
        'user_limit'            => 'ユーザー上限数',
        'starts_at'             => 'サービス開始日時',
        'ends_at'               => 'サービス終了日時',

        'created_at'            => '登録日時',
        'updated_at'            => '更新日時',
        'deleted_at'            => '削除日時',
    ],

];
