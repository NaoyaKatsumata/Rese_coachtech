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
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            // dd($request);
            // $request->session()->invalidate();                   //この行を追加
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
            // return view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories]);
            // return response()->view('errors.419', [], 419);
            return response()->view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>$selectedArea,'selectedCategory'=>$selectedCategory]);
        }

        return parent::render($request, $exception);
    }
}
