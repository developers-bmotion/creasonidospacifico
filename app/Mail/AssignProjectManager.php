<?php

namespace App\Mail;

use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignProjectManager extends Mailable
{
    use Queueable, SerializesModels;

    private $project;
    private $artist_name;
    // private $end_time;
    private $artist_pro;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($project, $artist_name,$artist_pro)
    {
        $this->project = $project;
        $this->artist_name = $artist_name;
        // $this->end_time = $end_time;
        $this->artist_pro = $artist_pro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('CREA SONIDOS PACIFICO - NUEVA PROPUESTA MUSICAL ASIGNADA'))
            ->markdown('emails.new-project-assign-manager')
            ->with('project',$this->project)
            ->with('artist',$this->artist_name)
            ->with('img_artist',$this->artist_pro);
            // ->with('end_time',$this->end_time)
    }
}
