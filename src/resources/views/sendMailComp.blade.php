<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
    <script src="{{ asset('js/pagereload.js') }}"></script>
</head>
<body id="body" class="bg-zinc-100 overflow-hidden w-[90%] mx-auto">
    @auth
        @php
            $userId = Auth::user()->id;
            $authority = Auth::user()->authority;
        @endphp
    @else
        @php
            $userId = '';
            $authority = '';
        @endphp
    @endauth
    <!-- アイコン&タイトル -->
    <header class="fixed w-[90%] mx-auto bg-zinc-100 ">
        <div class="flex mx-auto my-6 justify-between">
            <div class="flex">
                <div class="">
                    <div id="gestMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                        <div class="w-[70%] mx-auto">
                            <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                            <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                            <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                        </div>
                    </div>
                </div>
                <div class="px-16 text-4xl text-blue-600 font-bold">Rese</div>
            </div>
        </div>
    </header>
    <main class="py-24 mx-auto overflow-auto h-svh">
        <div class="w-[40%] mx-auto bg-white shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <form action="/" class="flex flex-col content-center" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="userId" value={{$userId}}>
                <p class="pt-16 text-center">メールの送信が完了しました</p>
                <input type="submit" class="w-[200px] mx-auto mt-4 mb-16 py-2 px-4 bg-blue-500 text-white rounded-[10px]" value="ホームに戻る">
            </form>
        </div>
    </main>

    <!-- 未ログイン時メニュー -->
    <div class="absolute w-[90%] mx-auto my-6 top-[0px]">
        <div id="menuBg" class="w-full h-full fixed top-[0px] left-[0px] bottom-[0px] bg-white"></div>
        <div id="close" class="w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="w-[70%] mx-auto">
                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
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
    <div class="absolute w-[90%] mx-auto my-6 top-[0px]">
        <div id="menuBg" class="w-full h-full fixed top-[0px] left-[0px] bottom-[0px] bg-white"></div>
        <div id="close" class="w-[40px] h-[40px] pl-16 py-6 bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="w-[70%] mx-auto fixed">
                <div class="absolute fixed top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                <div class="absolute fixed top-[20px] w-[70%] h-[1px] bg-white"></div>
                <div class="absolute fixed top-[30px] w-[20%] h-[1px] bg-white"></div>
            </div>
        </div>
        <div id="loginContainer" class="absolute w-full my-32 text-center">
            <ul>
                <li class="mb-2 text-2xl text-blue-500"><form class="text-2xl text-blue-500" method="POST" action="/">
                                @csrf
                                @method('PUT')
                                @auth
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                @else
                                <input type="hidden" name="userId" value="null">
                                @endauth
                                <input type="hidden" name="shopId" value="">
                                <input type="hidden" name="area" value="All shop">
                                <input type="hidden" name="category" value="">
                                <input type="submit" value="Home">
                            </form></li>
                <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form></li>
                <li class="mb-2 text-2xl text-blue-500"><form class="text-2xl text-blue-500" method="POST" action="/mypage">
                                @csrf
                                @auth
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                @endauth
                                <input type="submit" value="My page">
                            </form></li>
                
                @auth
                @if($authority == 1)
                <li class="mb-2 text-2xl text-blue-500"><form class="text-2xl text-blue-500" method="POST" action="/registerAdmin">
                                @csrf
                                @method('patch')
                                @auth
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                @endauth
                                <input type="submit" value="Registration">
                            </form></li>
                <li class="mb-2 text-2xl text-blue-500"><a href="/addShop">Add shop</a></li>
                @endauth
                @endif
            </ul>
        </div>
    </div>

    <!-- javascript読み込み -->
    <script src="{{ asset('js/gestmenu.js') }}"></script>
</body>
</html>