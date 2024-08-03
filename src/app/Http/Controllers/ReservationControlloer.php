<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Carbon\Carbon;

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
        $reservation_date = new Carbon($date.' '.$time);

        //アルファベットと数字と記号の配列を登録
	    $words = array_merge( range( 'a', 'z'), range( 'A', 'Z'), range( '0', '9') , range( '!' , '/' ));
        //8文字をランダムに組み合わせる
        $random_words = "";
		for( $i = 0 ; $i < 16 ; $i++)
		{
			$random = rand( 0 , 76 );
			$random_words = $random_words . $words[ $random ] ;
		}

        Reservation::create([
            'user_id'=>$userId,
            'shop_id'=>$shopId,
            'reservation_number'=>$num,
            'reservation_date'=>$reservation_date,
            'qr_code'=>$random_words
        ]);
        // dd($request);
        $request->session()->regenerateToken();
        return view('done',['userId'=>$userId]);
    }
}
