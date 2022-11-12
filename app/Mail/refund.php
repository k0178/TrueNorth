<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class refund extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $name;
    public $attch;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg, $name, $attch)
    {
        $this->msg=$msg;
        $this->name=$name;
        $this->attch=$attch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.refund');
    }
}
