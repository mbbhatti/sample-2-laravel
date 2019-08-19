<?php

namespace App\Services;

use Mailjet\LaravelMailjet\Facades\Mailjet;
use \Mailjet\Resources;
use App\Services\Recipient;
use View;

class MailJetEmail
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
     * @param  array  $data
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
            // Get view based on data
            $view = View::make('emails.template', $this->data);
            $contents = $view->render();        
            $contents = (string) $view;

            // Prepare Body
            $body = [
                "FromEmail" => env("MAIL_FROM_EMAIL"),
                "FromName" => env('MAIL_FROM_NAME'),
                "Subject" => env('MAIL_SUBJECT'),
                "Html-part" => $contents,
                "Recipients" => $this->recipient->getMailJetTo()
            ];
            
            // Send Email
            $response = Mailjet::post(Resources::$Email, ['body' => $body]);
            
            // Return response
            return $response->getStatus();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
