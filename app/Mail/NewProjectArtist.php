<?php

namespace App\Mail;

use App\Artist;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProjectArtist extends Mailable
{
    use Queueable, SerializesModels;

    private $project;
    private $artist_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, $artist_name)
    {
        $this->project = $project;
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
            ->subject('CREA SONIDOS PACIFICO - PROPUESTA MUSICAL REGISTRADA' )
            ->markdown('emails.new-project-artist')
            ->with('project',$this->project)
            ->with('artist',$this->artist_name);
    }
}
