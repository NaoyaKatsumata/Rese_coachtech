<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $shopName;
    public $reservationTime;

    public function __construct($shopName,$reservationTime)
    {
        $this->title = '本日の予約者へ';
        $this->shopName = $shopName;
        $this->reservationTime = $reservationTime;
    }

    public function build()
    {
        return $this->subject('リマインドメール')
                    ->view('reminder');
    }
}
