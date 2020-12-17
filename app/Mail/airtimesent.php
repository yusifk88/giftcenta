<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class airtimesent extends Mailable
{
    use Queueable, SerializesModels;
    private $airtime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($airtime)
    {
        $this->airtime = $airtime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.airtimesent',['airtime'=>$this->airtime])->subject("Airtime Sent");
    }
}
