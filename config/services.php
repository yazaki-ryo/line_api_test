<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Eloquents\EloquentUser::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
     * @param  string      $webhookUrl             Slack Webhook URL ※通知しない場合はnull
     * @param  string|null $channel                Slack channel (encoded ID or name) ※デフォルトチャンネルを上書きする場合はここに
     * @param  string|null $username               Name of a bot
     * @param  bool        $useAttachment          Whether the message should be added to Slack as attachment (plain text otherwise)
     * @param  string|null $iconEmoji              The emoji name to use (or null)
     * @param  bool        $useShortAttachment     Whether the the context/extra messages added to Slack as attachments are in a short style
     * @param  bool        $includeContextAndExtra Whether the attachment should include context and extra data
     * @param  int         $level                  The minimum logging level at which this handler will be triggered
     * @param  bool        $bubble                 Whether the messages that are handled can bubble up the stack or not
     * @param  array       $excludeFields          Dot separated list of fields to exclude from slack message. E.g. ['context.field1', 'extra.field2']
     */
    'slack'   => [
        'webhook_url'               => env('SLACK_WEBHOOK_URL'),
        'channel'                   => null,
        'username'                  => sprintf('%s Bot [%s]', env('APP_NAME', 'Laravel'), env('APP_ENV', 'local')),
        'use_attachment'            => true,
        'icon_emoji'                => null,
        'use_short_attachment'      => true,
        'include_context_and_extra' => true,
        'level'                     => env('SLACK_LOG_LEVEL', env('APP_LOG_LEVEL', \Monolog\Logger::ERROR)),
        'bubble'                    => true,
        'exclude_fields'            => [],
    ],

];
