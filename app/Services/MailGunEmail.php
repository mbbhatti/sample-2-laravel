<?php

namespace App\Services;

use App\Services\Recipient;
use Mailgun;

class MailGunEmail
{
    /**
     * Use for recipients object.
     *
     * @var array
     */
    protected $recipient;

    /**
     * Use for request data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // Set post request
        $this->data = $data;

        // Recipient object
        $this->recipient = new Recipient($data['email']);
    }
    
    /**
     * Send email.
     *
     * @return object|boolean
     */
    public function send()
    {
        try {        
            // Send Email
            $response = Mailgun::send('emails.template', $this->data, function ($message) {
                $message->to($this->recipient->getMailGunTo())
                        ->from(env('MAIL_FROM_EMAIL'))
                        ->replyTo(env('MAIL_REPLY_TO'))
                        ->subject(env('MAIL_SUBJECT'));
            });
            
            // Return response
            return $response->status;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
