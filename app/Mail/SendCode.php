<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $user)
    {s
        $this->code = $code; 
        $this->user = $user; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendcode')->subject('Code Validation')->from('example@example.com', 'RealWorld');
    }
}
