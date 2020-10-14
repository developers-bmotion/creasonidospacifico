<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewGestorAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('CREA SONIDOS PACIFICO - TUS CREDENCIALES DE ACCESO' )
            ->markdown('emails.new-gestor-admin')
            ->with('user',$this->user)
            ->with('password',$this->password);
    }
}
