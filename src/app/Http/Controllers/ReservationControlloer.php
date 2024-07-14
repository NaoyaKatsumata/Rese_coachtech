<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationControlloer extends Controller
{
    public function done(ReservationRequest $request){
        // dd($request);
        $userId = $request->userId;
        $shopId = $request->shopId;
        $strnum = $request->num;
        $num = preg_replace("/[^0-9]/", "", $strnum);
        $date = $request->date;
        $time = $request->time;
        Reservation::create([
            'user_id'=>$userId,
            'shop_id'=>$shopId,
            'reservation_number'=>$num,
            'reservation_date'=>$date,
            'reservation_time'=>$time,
        ]);
        // dd($request);
        $request->session()->regenerateToken();
        return view('done',['userId'=>$userId]);
    }
}
