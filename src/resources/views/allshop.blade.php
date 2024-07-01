<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
</head>
<body id="body" class="bg-zinc-100 overflow-hidden w-[90%] mx-auto">
    <!-- アイコン&タイトル -->
    <header class="fixed w-[90%] mx-auto bg-zinc-100 ">
        <div class="flex mx-auto my-6 justify-between">
            <div class="flex">
                <div class="">
                    @auth
                        <div id="loginMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                            <div class="w-[70%] mx-auto">
                                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                            </div>
                        </div>
                        @php
                            $userId = Auth::user()->id;
                        @endphp
                    @else
                        <div id="gestMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                            <div class="w-[70%] mx-auto">
                                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                            </div>
                        </div>
                        @php
                            $userId = '';
                        @endphp
                    @endauth
                </div>
                <div class="px-16 text-4xl text-blue-600 font-bold">Rese</div>
            </div>
            <div class="flex">
                <form action="/" method="post">
                    @csrf
                    @auth
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    @endauth
                    @method('PATCH')
                    <select class="border-none focus:ring-0" name="area" onchange="this.form.submit()">
                    <option value="All area" @if($selectedArea == 'All area') selected @endif>All area</option>
                    @foreach($areas as $area)
                        <option value="{{$area->area_name}}" @if($selectedArea == $area->area_name) selected @endif>{{$area->area_name}}</option>
                    @endforeach
                    </select>
                </form>
                <form action="/" method="post">
                    @csrf
                    @auth
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    @endauth
                    @method('PATCH')
                    <select class="border-none focus:ring-0" name="category" onchange="this.form.submit()">
                    <option value="All genre" @if($selectedCategory == 'All genre') selected @endif>All genre</option>
                    @foreach($categories as $category)
                        <option value="{{$category->category_name}}" @if($selectedCategory == $category->category_name) selected @endif>{{$category->category_name}}</option>
                    @endforeach
                    </select>
                </form>
                <form action='/' method="post">
                    @csrf
                    @auth
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    @endauth
                    @method('PATCH')
                    <input type="search" class="border-none focus:ring-0" name="shopName" size="40" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
    <main class="py-24 mx-auto overflow-auto h-svh">
        <div class="flex flex-wrap ">
            <!-- 店カード -->
            @foreach($shops as $shop )
            <div class="flex-column break-words w-[24%] h-[250px] mx-[0.5%] mb-4 bg-white rounded-[10px] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.3)]">
                <img class="object-cover w-full h-1/2 rounded-t-[10px]" src="{{ asset($shop->img)}}">
                <div class="mx-4">
                    <div class="mt-4">{{$shop->shop_name}}</div>
                    <div class="flex">
                        <div class="text-xs">#{{$shop->area->area_name}}</div>
                        <div class="text-xs mx-[5px]">#{{$shop->category->category_name}}</div>
                    </div>
                    <div class="flex">
                        <form class="flex mt-4 content-center justify-between" action="/detail" method="get">
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="submit" class="px-4 bg-blue-500 text-white rounded-[5px]" value="詳しくみる"/>
                        </form>
                        <form class="flex mt-4" action="/" method="post">
                            @csrf
                            @method('PUT')
                            @auth
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="shopId" value="{{$shop->id}}">
                                @isset($userFavorites)
                                    @php
                                        $favoriteFlg=False;
                                        foreach($userFavorites as $userFavorite){
                                            if($userFavorite->shop_id == $shop->id){
                                                $favoriteFlg=True;
                                            }
                                        }
                                    @endphp
                                    @if($favoriteFlg)
                                        <input id="id{{$shop->id}}" type="image" class="w-[20%] mr-2 ml-auto active" src="{{ asset('img/593_me_h.png')}}" formaction="/" value="{{$shop->id}}">
                                    @else
                                        <input id="id{{$shop->id}}" type="image" class="w-[20%] mr-2 ml-auto" src="{{ asset('img/593_me_h.png')}}" formaction="/" value="{{$shop->id}}">
                                    @endif
                                @else
                                    <input id="id{{$shop->id}}" type="image" class="w-[20%] mr-2 ml-auto" src="{{ asset('img/593_me_h.png')}}" formaction="/" value="{{$shop->id}}">
                                @endisset
                            @else
                                <input id="id{{$shop->id}}" type="image" class="w-[20%] mr-2 ml-auto" src="{{ asset('img/593_me_h.png')}}" formaction="/" value="{{$shop->id}}">
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
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
                                <input type="hidden" name="userId" value="{{$userId}}">
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
                                <input type="hidden" value="{{Auth::user()->id}}">
                                @endauth
                                <input type="submit" value="My page">
                            </form></li>
            </ul>
        </div>
    </div>

    <!-- javascript読み込み -->
    <script src="{{ asset('js/loginmenu.js') }}"></script>
    <script src="{{ asset('js/gestmenu.js') }}"></script>
</body>
</html>