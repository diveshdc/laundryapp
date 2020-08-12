<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCredentials extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->view('view.name');
    // }

    public function build()
    {
  
         return $this->view('emails.send_credentials')->with([
            'name' => $this->data->first_name.''.$this->data->last_name,
            'email' => $this->data->email,
            'password' => $this->data->first_name.'12345',
         ]);
}

}
