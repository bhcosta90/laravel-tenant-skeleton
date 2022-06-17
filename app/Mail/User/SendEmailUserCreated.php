<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailUserCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $name,
        private string $email,
        private string $password
    ) {
        //
    }

    public function build()
    {
        return $this->to($this->email, $this->name)->subject(__('Usuário criado'))->markdown('email.user.create', [
            'password' => $this->password,
            'name' => $this->name,
        ]);
    }
}
