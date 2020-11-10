<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRevisionProjectSubsanador extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $name_aspirante;
    private $last_name;
    private $last_name_aspirante;
    private $name_project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $last_name, $name_project, $name_aspirante, $last_name_aspirante)
    {
        $this->name = $name;
        $this->last_name = $last_name;
        $this->name_project = $name_project;
        $this->name_aspirante = $name_aspirante;
        $this->last_name_aspirante = $last_name_aspirante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   return $this
        ->subject(__('CREA SONIDOS PACIFICO - NUEVA REVISIÓN'))
        ->markdown('emails.new-revision-subsanador')
        ->with('name',$this->name)
        ->with('last_name',$this->last_name)
        ->with('name_project',$this->name_project)
        ->with('name_aspirante',$this->name_aspirante)
        ->with('last_name_aspirante',$this->last_name_aspirante);
    }
}
