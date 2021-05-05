<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationCreateAccount extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $surname;
    public $temporaryPasswd;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname, $temporaryPasswd, $url)
    {
        $this->name             = $name;
        $this->surname          = $surname;
        $this->temporaryPasswd  =  $temporaryPasswd;
        $this->url              =  $url;
        $this->subject('Simplon - Confirmation inscritpion');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.createAccount');
    }
}
