<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Category;

class ShopController extends Controller
{
    public function shopAll(){
        $shops = Shop::all();
        $areas = Area::all();
        // $areas = $shops->area->id;
        // dd($shops);
        return view('allshop',['shops'=>$shops,'areas'=>$areas]);
    }

    public function favorite(Request $request){
        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $selectedArea = $request->area;
        // dd($userId,$shopId);
        if($request->area === 'All shop'){
            $areaId = Area::all();
        }else{
            $areaId = Area::where("area_name","=",$request->area)
            ->first();
        }
        
        $categoryName = $request->category_name;
        //リクエストされた店舗がお気に入り可動か取得
        $userFavorite = Favorite::where('user_id','=',$userId)
        ->where('shop_id','=',$shopId)
        ->first();
        //お気に入り登録か削除か判定&SQL実行
        if(!(isset($areaId))){
            if(is_null($userFavorite)){
            //お気に入り登録処理
                Favorite::create([
                    'user_id' => $userId ,
                    'shop_id'=> $shopId
                ]);
            }else{
                //お気に入り削除処理
                $userFavorite->delete();
            }
        }
        //Userのお気に入りの店舗取得
        $users = User::select('users.id','favorites.shop_id')
        ->where('users.id','=',$userId)
        ->join('favorites','users.id','=','favorites.user_id')
        ->get();
        //全店舗取得
        if(!isset($areaId) or $request->area === 'All shop'){
            $shops = Shop::all();
        }else{
            $shops = Shop::where("area_id","=",$areaId->id)
            ->get();
        }
        //全エリア取得
        $areas = Area::all();
        //全カテゴリー取得
        $categories = Category::all();
        //テスト用
        // dd($selectedArea);
        return view('allshop',['users'=>$users,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>$selectedArea]);
    }
}
