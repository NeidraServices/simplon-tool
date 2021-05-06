<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationsReponse extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $surname;
    public $projet;
    public $com;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname,$com)
    {
        $this->name             = $name;
        $this->surname          = $surname;
        $this->com          = $com;
        $this->subject('Simplon - reponse à un commentaire');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notificationreponse');
    }
}