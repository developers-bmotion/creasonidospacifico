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
    private $project;
    private $artist_name;
    private $mesage;

    public function __construct(Project $project, $artist_name, $mesage)
    {
        $this->project = $project;
        $this->artist_name = $artist_name;
        $this->mesage = $mesage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Debes revisar tus datos'))
            ->markdown('emails.artist-project-revision')
            ->with('project',$this->project)
            ->with('artist',$this->artist_name)
            ->with('mesage',$this->mesage);
    }
}
