<?php

return [

    /*
     * API endpoint settings.
     *
     */
    'api' => [
        'endpoint' => 'api.mailgun.net',
        'version' => 'v3',
        'ssl' => true
    ],

    /*
     * Domain name registered with Mailgun
     *
     */
    'domain' => env('MAILGUN_DOMAIN'),

    /*
     * Mailgun (private) API key
     *
     */
    'api_key' => env('MAILGUN_PRIVATE'),

    /*
     * Mailgun public API key
     *
     */
    'public_api_key' => env('MAILGUN_PUBLIC'),

    /*
     * You may wish for all e-mails sent with Mailgun to be sent from
     * the same address. Here, you may specify a name and address that is
     * used globally for all e-mails that are sent by this application through Mailgun.
     *
     */
    'from' => [
        'address' => env('MAIL_FROM_EMAIL'),
        'name' => env('MAIL_FROM_NAME'),
    ],

    /*
     * Global reply-to e-mail address
     *
     */
    'reply_to' => env('MAIL_REPLY_TO')

];
