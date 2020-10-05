<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewManagerAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Tus credenciales de acceso a '.config('app.name')))
            ->markdown('emails.new-management-admin')
            ->with('user',$this->user)
            ->with('password',$this->password);
    }
}
