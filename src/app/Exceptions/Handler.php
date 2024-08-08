<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use App\Models\Shop;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Category;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            $email = $request->email;
            $userId = $request->userId;
            $selectedArea = 'All area';
            $selectedCategory = 'All';
            $areas = Area::all();
            $categories = Category::all();
            $shops = Shop::all();
            if(isset($email)){
                $userFavorites = Favorite::join("users","users.id","=","user_id")
                ->where('users.email','=',$email)
                ->get();
            }elseif(isset($userId)){
                $userFavorites = Favorite::where('user_id','=',$userId)
                ->get();
            }
            return response()->view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>$selectedArea,'selectedCategory'=>$selectedCategory]);
        }

        return parent::render($request, $exception);
    }
}
