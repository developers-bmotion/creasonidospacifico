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
    private $end_time;
    private $img_artist;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, $artist_name, $end_time, $img_artist)
    {
        $this->project = $project;
        $this->artist_name = $artist_name;
        $this->end_time = $end_time;
        $this->img_artist = $img_artist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Un nuevo proyecto se te ha sido asignado'))
            ->markdown('emails.new-project-assign-manager')
            ->with('project',$this->project)
            ->with('artist',$this->artist_name)
            ->with('end_time',$this->end_time)
            ->with('img_artist',$this->img_artist);
    }
}
