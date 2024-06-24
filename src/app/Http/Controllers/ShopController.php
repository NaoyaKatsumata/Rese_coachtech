<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Favorite;

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
        // dd($user_id,$shop_id);
        //リクエストされた店舗がお気に入り可動か取得
        $userFavorite = Favorite::where('user_id','=',$user_id)
        ->where('shop_id','=',$shop_id)
        ->first();
        // dd($userFavorite);
        //お気に入り登録か削除か判定&SQL実行
        if(is_null($userFavorite)){
        //お気に入り登録処理
            Favorite::create([
                'user_id' => $user_id ,
                'shop_id'=> $shop_id
            ]);
        }else{
            //お気に入り削除処理
            $userFavorite->delete();
        }
        //Userのお気に入りの店舗取得
        $users = User::select('users.id','favorites.shop_id')
        ->where('users.id','=',$user_id)
        ->join('favorites','users.id','=','favorites.user_id')
        ->get();
        //全店舗取得
        $shops = Shop::all();
        //テスト用
        // dd($users,$shops);
        return view('allshop',['users'=>$users,'shops'=>$shops]);
    }
}
