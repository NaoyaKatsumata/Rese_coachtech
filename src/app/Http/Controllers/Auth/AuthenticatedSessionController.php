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
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function sendTokenEmail(Request $request) {
        return view('auth.onetime');
    }

    public function auth(Request $request)
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        $expiration = new Carbon($user->onetime_expiration);

        if ($user['onetime_token'] == $request->onetime_token && $expiration > now()) {
            Auth::login($user);
            $userFavorites = User::select('users.id','favorites.shop_id')
            ->where('users.email','=',$email)
            ->join('favorites','users.id','=','favorites.user_id')
            ->get();
            $shops = Shop::all();
            $areas = Area::all();
            $categories = Category::all();
            $request->session()->regenerateToken();
            return view('allshop',['userFavorites'=>$userFavorites,'shops'=>$shops,'areas'=>$areas,'categories'=>$categories,'selectedArea'=>'','selectedCategory'=>'']);
        }
        $errorMessage = [
            'sessionOut' => '認証コードの期限が切れました。再度お試しください。',
        ];
        return redirect('/login')
                         ->with('customErrors', $errorMessage)
                         ->withInput($request->all());
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
