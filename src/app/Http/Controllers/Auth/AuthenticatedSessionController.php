<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Shop;
use App\Models\User;
use App\Models\Area;
use App\Models\Category;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user_email = User::where('email','=',$request->email)->first()->email;
        $userFavorites = User::select('users.id','favorites.shop_id')
        ->where('users.email','=',$user_email)
        ->join('favorites','users.id','=','favorites.user_id')
        ->get();
        $shops = Shop::all();
        $areas = Area::all();
        $categories = Category::all();
        // dd($userFavorites);
        return view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>'','selectedCategory'=>'']);

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
