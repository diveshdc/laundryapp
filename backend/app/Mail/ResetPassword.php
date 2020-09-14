<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public  $user;
    public  $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $user)
    {
       $this->user = $user; 
       $this->token = $token; 
       // $this->logo = $logo; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_reset')->with([
            'user'=>$this->user,
            'token'=> $this->token,
        ]);
    }
}
