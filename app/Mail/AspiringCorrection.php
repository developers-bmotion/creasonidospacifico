<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AspiringCorrection extends Mailable
{
    use Queueable, SerializesModels;
    private $name_project;
    private $last_name;
    private $artist_name;
    private $mesage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artist_name, $last_name, $name_project, $mesage)
    {
        $this->name_project = $name_project;
        $this->artist_name = $artist_name;
        $this->last_name = $last_name;
        $this->mesage =$mesage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('CREA SONIDOS PACIFICO - INFORMACIÓN IMPORTANTE'))
            ->markdown('emails.artist-project-correction-aspirant')
            ->with('project',$this->name_project)
            ->with('artist_name',$this->artist_name)
            ->with('las_name',$this->last_name)
            ->with('mesage',$this->mesage);
    }
}
