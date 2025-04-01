<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedBackMail;

class SendFeedBackJob implements ShouldQueue
{
    use Queueable;

    private    $params                    = [];

    /**
     * Create a new job instance.
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::mailer(config('mail.mail_mode'))->to($this->params['to'])->send(new FeedBackMail($this->params));
    }
}
