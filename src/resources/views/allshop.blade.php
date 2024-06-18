<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
</head>
<body>
    <div class="flex">
        <div class="p-10">
            @auth
                <div id="loginMenu" class="w-[40px] h-[40px] bg-blue-500 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                    <div class="w-[70%] mx-auto">
                        <div class="absolute top-[10px] w-[50%] h-[2px] bg-white mx-auto"></div>
                        <div class="absolute top-[20px] w-[70%] h-[2px] bg-white"></div>
                        <div class="absolute top-[30px] w-[20%] h-[2px] bg-white"></div>
                    </div>
                </div>
            @else
                <div id="gestMenu" class="w-[40px] h-[40px] bg-blue-500 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                    <div class="w-[70%] mx-auto">
                        <div class="absolute top-[10px] w-[50%] h-[2px] bg-white mx-auto"></div>
                        <div class="absolute top-[20px] w-[70%] h-[2px] bg-white"></div>
                        <div class="absolute top-[30px] w-[20%] h-[2px] bg-white"></div>
                    </div>
                </div>
            @endauth
        </div>
        <div class="px-8 py-[40px] text-4xl text-blue-500">Rese</div>
    </div>
<!-- @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            <p>test</p>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
@endif -->
<div class="absolute w-[90%] mx-auto top-[40px] left-[40px]">
    <div id="menuBg" class="w-full h-full fixed top-[0px] left-[0px] bottom-[0px] bg-white"></div>
    <div id="close" class="w-[40px] h-[40px] bg-blue-500 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
        <div class="w-[70%] mx-auto">
            <div class="absolute top-[10px] w-[50%] h-[2px] bg-white mx-auto"></div>
            <div class="absolute top-[20px] w-[70%] h-[2px] bg-white"></div>
            <div class="absolute top-[30px] w-[20%] h-[2px] bg-white"></div>
        </div>
    </div>
    <div id="gestContainer" class="absolute w-full my-32 text-center">
        <ul>
            <li class="mb-2 text-2xl text-blue-500"><a href="/">Home</a></li>
            <li class="mb-2 text-2xl text-blue-500"><a href="/register">Registration</a></li>
            <li class="mb-2 text-2xl text-blue-500"><a href="/login">Login</a></li>
        </ul>
    </div>
</div>

<div class="absolute w-[90%] mx-auto top-[40px] left-[40px]">
    <div id="menuBg" class="w-full h-full fixed top-[0px] left-[0px] bottom-[0px] bg-white"></div>
    <div id="close" class="w-[40px] h-[40px] bg-blue-500 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
        <div class="w-[70%] mx-auto">
            <div class="absolute top-[10px] w-[50%] h-[2px] bg-white mx-auto"></div>
            <div class="absolute top-[20px] w-[70%] h-[2px] bg-white"></div>
            <div class="absolute top-[30px] w-[20%] h-[2px] bg-white"></div>
        </div>
    </div>
    <div id="loginContainer" class="absolute w-full my-32 text-center">
        <ul>
            <li class="mb-2 text-2xl text-blue-500"><a href="/">Home</a></li>
            <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form></li>
            <li class="mb-2 text-2xl text-blue-500"><a href="">Mypage</a></li>
        </ul>
    </div>
</div>
<script src="{{ asset('js/loginmenu.js') }}"></script>
<script src="{{ asset('js/gestmenu.js') }}"></script>
</body>
</html>