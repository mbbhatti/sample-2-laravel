<?php

namespace App\Services;

class Recipient
{
    /**
     * Use for multiple recipients MailGun.
     *
     * @var array
     */
    protected $mailGunTo;

    /**
     * Use for multiple recipients Mailjet.
     *
     * @var array
     */
    protected $mailJetTo;

    /**
     * Use for email list.
     *
     * @var array
     */
    protected $emails;

    /**
     * Create a new recipient instance.
     *
     * @param  string  $emails
     *
     * @return void
     */
    public function __construct($emails)
    {
        $this->emails = $emails;
        $this->setRecipients();
    }

    /**
    * Set multiple recipients emails
    */
    public function setRecipients()
    {
        $list = preg_split("/[;,]+/", $this->emails);                
        foreach ($list as $email) {
            $this->mailGunTo .= trim($email).',';
            $this->mailJetTo[] = ['Email' => trim($email)];
        }
    }

    /**
    * get MailJet to list.
    *
    * @return array
    */
    public function getMailJetTo()
    {
        return $this->mailJetTo;
    }

    /**
    * get Mailgun to list.
    *
    * @return array
    */
    public function getMailGunTo()
    {
        return substr($this->mailGunTo, 0, -1);
    }
}
