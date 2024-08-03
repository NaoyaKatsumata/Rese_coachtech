<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use Carbon\Carbon;

class sendRemindMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $email;
    public $test;
    public $shopName;
    public $reservationTime;


    public function __construct()
    {
        parent::__construct();
        // $this->test = 'test';
    }

    public function handle()
    {
        $reservationDate = Carbon::now();
        $reservationDate->format('Y-m-d');

        $users = Reservation::join("users","users.id","=","reservations.user_id")
        ->join("shops","shops.id","=","reservations.shop_id")
        // ->where("reservations.reservation_date","<",$reservationDate)
        // ->where("reservations.reservation_date",">",$reservationDate)
        ->get();

        foreach($users as $user){
            $email = $user->email;
            $shopName = $user->shop_name;
            // $reservationTime = $this->$user->reservation_time;
            $reservationTime ="";
            Mail::to($email)->send(new ReminderMail($shopName,$reservationTime));
        }
    }
}
