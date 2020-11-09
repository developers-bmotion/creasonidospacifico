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
    private $name;
    private $last_name;
    private $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $last_name, $user,$password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->name =$name;
        $this->last_name = $last_name;
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
            ->with('name', $this->name)
            ->with('last_name', $this->last_name)
            ->with('user',$this->user)
            ->with('password',$this->password);
    }
}
