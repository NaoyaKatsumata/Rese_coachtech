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
        $reservationDate = Carbon::now()->toDateString();
        $nextDate = Carbon::now()->addDay()->toDateString();

        $users = Reservation::join("users","users.id","=","reservations.user_id")
        ->join("shops","shops.id","=","reservations.shop_id")
        ->where("reservations.reservation_date","<=",$nextDate)
        ->where("reservations.reservation_date",">=",$reservationDate)
        ->get();

        foreach($users as $user){
            $email = $user->email;
            $shopName = $user->shop_name;
            $reservationTime = new Carbon($user->reservation_date);
            $time = $reservationTime->format('h:i:s');
            // $reservationTime = $reservationTime->format('Y-m-d H:i:s');
            Mail::to($email)->send(new ReminderMail($shopName,$time));
        }
    }
}
