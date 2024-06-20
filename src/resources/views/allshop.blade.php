<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
</head>
<body class="bg-zinc-100">
    <!-- アイコン&タイトル -->
    <header class="fixed w-full bg-zinc-100">
        <div class="flex">
            <div class="pl-16 py-6">
                @auth
                    <div id="loginMenu" class="w-[40px] h-[40px] bg-blue-600 rounded-[5px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                        <div class="w-[70%] mx-auto">
                            <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                            <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                            <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                        </div>
                    </div>
                @else
                    <div id="gestMenu" class="w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                        <div class="w-[70%] mx-auto">
                            <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                            <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                            <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="px-16 py-6 text-4xl text-blue-600 font-bold">Rese</div>
        </div>
    </header>

    <div class="py-24 mx-auto w-[90%]">
        <div class="flex flex-wrap h-[200px]">
            <!-- 店カード -->
            @foreach($shops as $shop )
            <div class="flex-column break-words w-[24%] mx-[0.5%] mb-4 bg-white rounded-[10px] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.3)]">
                <img class="object-cover w-full h-1/2 rounded-t-[10px]" src="{{ asset($shop->img)}}">
                <div class="m-4">{{$shop->shop_name}}</div>
                <div class="">{{$shop->shop_name}}</div>
            </div>
            @endforeach
        </div>

    </div>

    <!-- 未ログイン時メニュー -->
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


    <!-- ログイン時メニュー -->
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
    <!-- javascript読み込み -->
    <script src="{{ asset('js/loginmenu.js') }}"></script>
    <script src="{{ asset('js/gestmenu.js') }}"></script>
</body>
</html>