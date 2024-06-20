<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function shopAll(){
        $shops = Shop::all();
        // $areas = $shops->area->id;
        // dd($shops);
        return view('allshop',['shops'=>$shops]);
    }
}
