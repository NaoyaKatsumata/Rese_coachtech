<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class MypageController extends Controller
{
    public function mypage(Request $request){
        $userId = $request->userId;
        $userName = User::select('name')
        ->where("id","=",$userId)
        ->first();
        $reservations = Reservation::join("shops","shops.id","=","reservations.shop_id")
        ->where("user_id","=",$userId)
        ->orderBy('reservation_date','asc')
        ->get();
        $shops = Shop::join("favorites","shops.id","=","favorites.shop_id")
        ->join("areas","areas.id","=","shops.area_id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->get();

        return view('mypage',['userName'=>$userName,'reservations'=>$reservations,'shops'=>$shops,"userId"=>$userId]);
    }

    public function delete(Request $request){
        $userId = $request->userId;
        $shopId = $request->shopId;
        $userName = User::select('name')
        ->where("id","=",$userId)
        ->first();

        Reservation::where("user_id","=",$userId)
        ->where("shop_id","=",$shopId)
        ->delete();

        $reservations = Reservation::join("shops","shops.id","=","reservations.shop_id")
        ->where("user_id","=",$userId)
        ->orderBy('reservation_date','asc')
        ->get();
        $favorites = Shop::join("favorites","shops.id","=","favorites.shop_id")
        ->join("areas","areas.id","=","shops.area_id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->get();
        $shops = Shop::join("favorites","shops.id","=","favorites.shop_id")
        ->join("areas","areas.id","=","shops.area_id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->get();

        return view('mypage',['userName'=>$userName,'reservations'=>$reservations,'favorites'=>$favorites,'shops'=>$shops]);
    }

    public function edit(Request $request){
        $userId = $request->userId;
        $shopId = $request->shopId;
        $number = $request->number;
        $date = $request->date;
        $time = $request->time;
        $reservation_date = new Carbon($date.' '.$time);

        $shop = Shop::select("reservations.reservation_number","reservations.reservation_date",
        "reservations.user_id","shops.shop_name","shops.img","shops.detail","shops.id","areas.area_name","categories.category_name")
        ->join("reservations","reservations.shop_id","=","shops.id")
        ->join("areas","shops.area_id","=","areas.id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->where("shop_id","=",$shopId)
        ->where("reservation_number","=",$number)
        ->where("reservation_date","=",$reservation_date)
        ->first();

        return view('edit',['shop'=>$shop]);
    }

    public function update(Request $request){
        $prevDate = $request->prevDate;
        $prevTime = $request->prevTime;
        $prevNum = $request->prevNum;
        $userId = $request->userId;
        $shopId = $request->shopId;
        $strnum = $request->num;
        $num = preg_replace("/[^0-9]/", "", $strnum);
        $date = $request->date;
        $time = $request->time;
        $prevReservationDate = new Carbon($prevDate.' '.$prevTime);
        $reservationDate = new Carbon($date.' '.$time);

        $updateData = Reservation::where("user_id","=",$userId)
        ->where("shop_id","=",$shopId)
        ->where("reservation_number","=",$prevNum)
        ->where("reservation_date","=",$prevReservationDate)
        ->first();

        $updateData->update(['reservation_number'=>$num,
                             'reservation_date'=>$reservationDate]);
        
        return view('done',['userId'=>$userId]);
    }

    public function review(Request $request){
        $userId = $request->userId;
        $shopId = $request->shopId;
        return view('review',['userId'=>$userId,'shopId'=>$shopId]);
    }
}
