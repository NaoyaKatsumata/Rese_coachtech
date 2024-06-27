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
        $categories = Category::all();
        // dd($shops);
        // dd($areas);
        return view('allshop',['shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>'','selectedCategory'=>'']);
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
        $userFavorites = User::select('users.id','favorites.shop_id')
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
        // dd($userFavorites);
        return view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>$selectedArea]);
    }

    public function search(Request $request){
        $userId = $request->user_id;
        $selectedArea = $request->area;
        $selectedAreaId = Area::where("area_name","=",$selectedArea)
        ->first();
        $selectedCategory = $request->category;
        $selectedCategoryId = Category::where("category_name","=",$selectedCategory)
        ->first();
        $selectedShop = $request->shop;
        if(isset($selectedAreaId)){
            $shops = Shop::where("area_id","=",$selectedAreaId->id)
            ->get();
        }
        if(isset($selectedCategoryId)){
            $shops = Shop::where("category_id","=",$selectedCategoryId->id)
            ->get();
        }
        if(isset($selectedShop)){
            $shops = Shop::where("shop_name","like","%".$selectedShop."%")
            ->get();
        }
        if($selectedArea==='All area' or $selectedCategory==='All genre'){
            $shops = Shop::all();
        }
        $areas = Area::all();
        $categories = Category::all();
        $userFavorites = Favorite::where('user_id','=',$userId)
        ->get();
        // dd($userId,$selectedArea,$selectedCategory,$selectedShop,$shops);
        return view('allshop',['shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'userFavorites'=>$userFavorites,'selectedArea'=>$selectedArea,'selectedCategory'=>$selectedCategory,'selectedShop'=>$selectedShop]);
    }
}
