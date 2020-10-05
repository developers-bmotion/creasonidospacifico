<?php

namespace App\Mail;

use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManagerProjecApproved extends Mailable
{
    use Queueable, SerializesModels;
    private $project;
    private $artist_name;
    private $manage_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, $artits_name, $manage_name)
    {
        $this->project = $project;
        $this->artist_name = $artits_name;
        $this->manage_name = $manage_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Información del proyecto ') .$this->project->title)
            ->markdown('emails.management-approved-proyect')
            ->with('project',$this->project)
            ->with('artist',$this->artist_name)
            ->with('management',$this->manage_name);
    }
}
