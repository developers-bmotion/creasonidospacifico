<?php

namespace App\Mail;

use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArtistProjectRevision extends Mailable
{
    use Queueable, SerializesModels;
    private $name_project;
    private $artist_name;
    private $mesage;
    private $dateValidate;

    public function __construct($name_project, $artist_name, $mesage, $dateValidate)
    {
        $this->name_project = $name_project;
        $this->artist_name = $artist_name;
        $this->mesage = $mesage;
        $this->dateValidate = $dateValidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('CREA SONIDOS PACIFICO - DEBES ACTUALIZAR TUS DATOS'))
            ->markdown('emails.artist-project-revision')
            ->with('project',$this->name_project)
            ->with('artist',$this->artist_name)
            ->with('mesage',$this->mesage)
            ->with('dateValidate',$this->dateValidate);
    }
}
