<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectProjectAspiranteCron extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('CREA SONIDOS PACIFICO - PROPUESTA RECHAZADA'))
            ->markdown('emails.rejected-project-aspirante')
            ->with('name',$this->name);
    }
}
