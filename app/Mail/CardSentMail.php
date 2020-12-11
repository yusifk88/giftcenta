<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CardSentMail extends Mailable
{
    use Queueable, SerializesModels;
    private $card;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($card)
    {
        $this->card = $card;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Gift card sent')
        ->markdown('emails.CardSnetMail',['card'=>$this->card]);
    }
}
