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

    /**
     * Create a new message instance.
     */
    public function __construct($onetime_token) {
        // $this->email = $email;
        $this->onetime_token = $onetime_token;
    }

    /**
     **メール作成
     */
    public function build() {
        // return $this->to($this->email)
        return $this->subject("認証コード")
            ->view('auth.mail')
            ->with([
                'onetime_token' => $this->onetime_token
            ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Token Email',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     // return new Content(
    //     //     view: 'view.name',
    //     // );
    //     return $this->to($this->email)
    //         ->subject("認証コード")
    //         ->view('auth.mail')
    //         ->with([
    //             'onetime_token' => $this->onetime_token
    //         ]);
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
}
