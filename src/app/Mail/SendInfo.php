<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $text;

    /**
     * Create a new message instance.
     */
    public function __construct($text) {
        // $this->email = $email;
        $this->text = $text;
    }

    /**
     **メール作成
     */
    public function build() {
        // return $this->to($this->email)
        return $this->subject("お知らせ")
            ->view('auth.info-mail')
            ->with([
                'text' => $this->text
            ]);
    }
}
