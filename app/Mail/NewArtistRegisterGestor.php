<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArtistRegisterGestor extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $last_name;
    private $name_project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $last_name, $name_project)
    {
        $this->name = $name;
        $this->last_name = $last_name;
        $this->name_project = $name_project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('CREA SONIDOS PACIFICO - HAS SIDO REGISTRADO' )
            ->markdown('emails.new-artist-register-gestor')
            ->with('name',$this->name)
            ->with('last_name',$this->last_name)
            ->with('name_project',$this->name_project);
    }
}
