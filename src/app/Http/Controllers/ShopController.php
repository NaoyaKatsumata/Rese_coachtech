<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;

class ShopController extends Controller
{
    public function shopAll(){
        $shops = Shop::all();
        // $areas = $shops->area->id;
        // dd($shops);
        return view('allshop',['shops'=>$shops]);
    }

    public function favorite(Request $request){
        $user_id = $request->user_id;
        $shop_id = $request->shop_id;
        $users = User::select('users.id','favorites.shop_id')
        ->where('users.id','=',$user_id)
        ->join('favorites','users.id','=','favorites.user_id')
        ->get();
        $shops = Shop::all();
        // $json = json_encode($user,JSON_PRETTY_PRINT);
        // dd($users,$shops);
        return view('allshop',['users'=>$users,'shops'=>$shops]);//->json(['user'=>$user]);
        // return response()->json(['user'=>$user]);
    }
}
