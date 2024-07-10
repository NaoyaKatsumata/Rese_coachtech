<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;

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
        ->orderBy('reservation_time','asc')
        ->get();
        $favorites = Shop::join("favorites","shops.id","=","favorites.shop_id")
        ->join("areas","areas.id","=","shops.area_id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->get();

        // dd($userName,$reservations,$favorites);
        return view('mypage',['userName'=>$userName,'reservations'=>$reservations,'favorites'=>$favorites]);
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
        ->orderBy('reservation_time','asc')
        ->get();
        $favorites = Shop::join("favorites","shops.id","=","favorites.shop_id")
        ->join("areas","areas.id","=","shops.area_id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->get();

        // dd($userName,$reservations,$favorites);
        return view('mypage',['userName'=>$userName,'reservations'=>$reservations,'favorites'=>$favorites]);
    }

    public function edit(Request $request){
        $userId = $request->userId;
        $shopId = $request->shopId;
        $number = $request->number;
        $date = $request->date;
        $time = $request->time;

        $shop = Shop::select("reservations.reservation_number","reservations.reservation_date","reservations.reservation_time",
        "reservations.user_id","shops.shop_name","shops.img","shops.detail","shops.id","areas.area_name","categories.category_name")
        ->join("reservations","reservations.shop_id","=","shops.id")
        ->join("areas","shops.area_id","=","areas.id")
        ->join("categories","categories.id","=","shops.category_id")
        ->where("user_id","=",$userId)
        ->where("shop_id","=",$shopId)
        ->where("reservation_number","=",$number)
        ->where("reservation_date","=",$date)
        ->where("reservation_time","=",$time)
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

        $updateData = Reservation::where("user_id","=",$userId)
        ->where("shop_id","=",$shopId)
        ->where("reservation_number","=",$prevNum)
        ->where("reservation_date","=",$prevDate)
        ->where("reservation_time","=",$prevTime)
        ->first();

        $updateData->update(['reservation_number'=>$num,
                             'reservation_date'=>$date,
                             'reservation_time'=>$time]);
        
        return view('done',['userId'=>$userId]);
    }

    public function review(){
        return view('review');
    }
}
