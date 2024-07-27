<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Owner;
use App\Models\User;
use App\Models\Reservation;
use App\Mail\SendInfo;
use Illuminate\Support\Facades\Mail;

class ShopEditController extends Controller
{
    public function view(Request $request){
        $selectedCategory=$request->category;
        $selectedArea=$request->area;
        $shopId=$request->shopId;
        $categories=Category::all();
        $areas=Area::all();
        $shop=Shop::where("id","=",$shopId)
        ->first();
    }

    public function edit(Request $request){
        $category=$request->categoryId;
        $area=$request->areaId;
        $detail=$request->detail;
    }

    public function editOwner(Request $request){
        $userId=$request->userId;
        $shopId=$request->shopId;
        $errStatus=0;
        // dd($userId,$shopId);

        if($userId==0){
            $errStatus=1;
        }else{
            try{
                Owner::create([
                    'user_id' => $userId ,
                    'shop_id'=> $shopId,
                ]);
            }catch (\Exception $e){
                $errStatus=2;
            }
        }

        $shop = Shop::where("id","=",$shopId)
        ->first();
        $selectedArea = Shop::select('areas.area_name')
        ->join("areas","shops.area_id","=","areas.id")
        ->where("shops.id","=",$shopId)
        ->first();
        $areas = Area::all();

        $selectedCategory = Shop::select('categories.category_name')
        ->join("categories","shops.category_id","=","categories.id")
        ->where("shops.id","=",$shopId)
        ->first();
        $categories = Category::all();

        $owners = User::where("authority","=","2")
        ->get();

        $reservationDate = date("Y/m/d");
        // $reservationDate->format('Y-m-d');
        // dd($reservationDate);
        $reservationList = Reservation::join("shops","shops.id","=","reservations.shop_id")
        ->where("shop_id","=",$shopId)
        ->where("reservation_date",">=",$reservationDate)
        ->get();
        // dd($reservationList,$shopId);
        // dd($request,$shop,$area,$category);
        return view('detail',['shop'=>$shop,'selectedArea'=>$selectedArea,'selectedCategory'=>$selectedCategory,'owners'=>$owners,'areas'=>$areas,'categories'=>$categories,'reservationList'=>$reservationList,'selectedUserId'=>$userId,'errStatus'=>$errStatus]);

    }

    public function editDetail(Request $request){
        // dd($request);
        $shopName=$request->shopName;
        $areaId=$request->area;
        $categoryId=$request->category;
        $shopId=$request->shopId;
        $detail=$request->detail;
        $ownerId="０";
        $userId=$request->userId;
        $errStatus=0;
        $file=$request->file('path');
        if(is_null($file)){
            $fileName='';
        }else{
            $fileName=$file->getClientOriginalName();
            $file->storeAs('public/img',$fileName);
        }

        $shop=Shop::where("id","=",$shopId)
        ->first();
        
        if(is_null($file)){
            $shop->update([
                "shop_name"=>$shopName,
                "detail"=>$detail,
                "category_id"=>$categoryId,
                "area_id"=>$areaId,
            ]);
        }else{
            $shop->update([
                "shop_name"=>$shopName,
                "detail"=>$detail,
                "category_id"=>$categoryId,
                "area_id"=>$areaId,
                "img"=>'img/'.$fileName
            ]);
        }
        $shop=Shop::where("id","=",$shopId)
        ->first();

        $categories = Category::all();


        $owners = User::where("authority","=","2")
        ->get();

        $areas = Area::all();
        $categories = Category::all();

        $selectedArea = Shop::select('areas.id')
        ->join("areas","shops.area_id","=","areas.id")
        ->where("shops.id","=",$shopId)
        ->first();
        $selectedCategory = Shop::select('categories.id')
        ->join("categories","shops.category_id","=","categories.id")
        ->where("shops.id","=",$shopId)
        ->first();

        $reservationDate = date("Y/m/d");
        // $reservationDate->format('Y-m-d');
        // dd($reservationDate);
        $reservationList = Reservation::join("shops","shops.id","=","reservations.shop_id")
        ->where("shop_id","=",$shopId)
        ->where("reservation_date",">=",$reservationDate)
        ->get();
        // dd($selectedArea,$selectedCategory);
        // dd($reservationList,$shopId);
        // dd($request,$shop,$area,$category);
        return view('editComp',['userId'=>$userId]);
    }

    public function addShop(){
        $areas = Area::all();
        $categories = Category::all();
        $owners = User::where("authority","=","2")
        ->get();
        // dd($areas);
        return view('addShop',["areas"=>$areas,"categories"=>$categories,"owners"=>$owners]);
    }

    public function store(Request $request){
        $shopName = $request->shopName;
        $categoryId = $request->category;
        $areaId = $request->area;
        $owner = $request->owner;
        $file = $request->file('path');
        $fileName=$file->getClientOriginalName();
        $file->storeAs('public/img',$fileName);
        $detail = $request->detail;

        // dd($request,$shopName,$category,$area,$owner,$fileName,$detail);
        Shop::create([
            'shop_name' => $shopName ,
            'detail'=> $detail,
            'category_id'=> $categoryId,
            'img'=> 'img/'.$fileName,
            'area_id'=> $areaId,
        ]);
        return view('storeComp');
    }

    public function createMail(Request $request){
        $email = $request->email;
        return view('createMail',['email'=>$email]);
    }

    public function sendMail(Request $request){
        $userId = $request->userId;
        $email = $request->email;
        $text = $request->info;

        session()->flash('email', $email); // 認証処理で利用するために一時的に格納
        Mail::to($email)->send(new SendInfo($text));


        return view('sendMailComp',['userId'=>$userId]);
    }
}
