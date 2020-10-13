<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArtist extends Mailable
{
    use Queueable, SerializesModels;
    private $artist_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artist_name)
    {
        $this->artist_name = $artist_name;
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
            ->markdown('emails.new-artist')
            ->with('artist',$this->artist_name);
    }
}
