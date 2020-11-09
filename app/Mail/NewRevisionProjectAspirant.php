<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRevisionProjectAspirant extends Mailable
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
            ->subject(__('CREA SONIDOS PACIFICO - SE HA ENVIADO DE NUEVO A REVISIÓN'))
            ->markdown('emails.new-revision-aspirante')
            ->with('name',$this->name)
            ->with('last_name',$this->last_name)
            ->with('name_project',$this->name_project);
    }
}
