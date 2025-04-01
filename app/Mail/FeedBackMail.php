<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedBackMail extends Mailable
{
    use Queueable, SerializesModels;

    private    $template                = 'mails.feedback';
    private    $data                    = [];

    /**
     * Create a new mail.
     *
     * @return void
     */
    public function __construct($data)
    {
        $dataObj                    = new \stdClass();
        foreach ($data as $key => $_data) {
            $dataObj->{$key} = $_data;
        }
        $this->data = $dataObj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('app.admin_email'))
            ->view($this->template)
            ->with(
                [
                    'data' => $this->data
                ]
            );
    }
}
