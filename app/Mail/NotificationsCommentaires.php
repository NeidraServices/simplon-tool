<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationsCommentaires extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $surname;
    public $projet;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname, $projet)
    {
        $this->name             = $name;
        $this->surname          = $surname;
        $this->projet  =  $projet;
        $this->subject('Simplon - Nouveau commentaire');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notification');
    }
}