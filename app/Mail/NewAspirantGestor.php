<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAspirantGestor extends Mailable
{
    use Queueable, SerializesModels;
    private $artist_name;
    private $last_name;
    private $name_gestor;
    private $last_name_gestor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artist_name, $last_name, $name_gestor, $last_name_gestor)
    {
        $this->artist_name = $artist_name;
        $this->last_name = $last_name;
        $this->name_gestor = $name_gestor;
        $this->last_name_gestor = $last_name_gestor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('CREA SONIDOS PACIFICO - ASPIRANTE HAS SIDO REGISTRADO' )
            ->markdown('emails.new-artist-gestor')
            ->with('artist',$this->artist_name)
            ->with('last_name',$this->last_name)
            ->with('name_gestor',$this->name_gestor)
            ->with('last_name_gestor',$this->last_name_gestor);
    }
}
