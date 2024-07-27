<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Category;
use App\Mail\TokenEmail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // return view('auth.register');
        return view('auth.register');
    }

    public function createAdmin(Request $request)
    {
        // dd($request);
        $userId = $request->userId;
        return view('auth.register-admin',['userId'=>$userId]);
    }

    /**
     **引数で渡されたメールアドレスとワンタイムトークンをusersテーブルに追加するコントロール
     */
    public static function storeEmailAndToken($email, $onetime_token, $onetime_expiration) {
        User::create([
            'email' => $email,
            'onetime_token' => $onetime_token,
            'ontime_expiration' => $onetime_expiration
        ]);
    }

    /**
     **引数で渡されたワンタイムトークンをusersテーブルに追加するコントロール
     */
    public static function storeToken($email, $onetime_token, $onetime_expiration) {
        User::where('email', $email)->update([
            'onetime_token' => $onetime_token,
            'onetime_expiration' => $onetime_expiration
        ]);
    }

    /**
     **ワンタイムトークンが含まれるメールを送信する
     */
    public function sendTokenEmail(Request $request) {
        $email = $request->email;
        $onetime_token = "";

        for ($i = 0; $i < 4; $i++) {
            $onetime_token .= strval(rand(0, 9)); // ワンタイムトークン
        }
        $onetime_expiration = now()->addMinute(3); // 有効期限

        $user = User::where('email', $email)->first(); // 受け取ったメールアドレスで検索
        if ($user === null) {
            RegisteredUserController::storeEmailAndToken($email, $onetime_token, $onetime_expiration);
        } else {
            RegisteredUserController::storeToken($email, $onetime_token, $onetime_expiration);
        }

        session()->flash('email', $email); // 認証処理で利用するために一時的に格納
        Mail::to($email)->send(new TokenEmail($onetime_token));

        return view("auth.onetime");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userId = User::where('email','=',$request->email)
        ->first();

        // event(new Registered($user));

        // Auth::login($user);

        return view('thanks',['userId'=>$userId]);
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'authority' => $request->authority,
        ]);

        $userId = $request->userId;
        $selectedArea = '';
        $selectedCategory = '';

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
        // dd($userFavorites,$shops,$areas,$categories);

        return view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>$selectedArea,'selectedCategory'=>$selectedCategory]);
    }
}
