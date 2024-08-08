<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TokenEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $onetime_token;

    public function __construct($onetime_token) {
        $this->onetime_token = $onetime_token;
    }

    /**
     **メール作成
     */
    public function build() {
        return $this->subject("認証コード")
            ->view('auth.mail')
            ->with([
                'onetime_token' => $this->onetime_token
            ]);
    }
}
