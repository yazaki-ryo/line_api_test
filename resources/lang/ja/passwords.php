<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => 'パスワードは最低6文字で、確認のために2回入力してください。',
    'reset'    => 'パスワードを再設定しました。',
    'sent'     => 'パスワード再設定用メールを送信しました。',
    'token'    => '入力されたEメールアドレスと一致しないか、有効期限切れ、またはURLが不正です。',

    /**
     * メールアドレスの探索目的回避のため、登録アドレスが無くても正常送信したように見せかける
     */
//     'user'     => '入力されたEメールは登録されていません。',
    'user'     => 'パスワード再設定用メールを送信しました。',

];
