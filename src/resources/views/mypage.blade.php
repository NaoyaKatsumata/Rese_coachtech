<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">
</head>
<body id="body" class="bg-zinc-100 overflow-hidden w-[90%] mx-auto">

    <!-- アイコン&タイトル -->
    <header class="fixed w-[90%] mx-auto bg-zinc-100 ">
        <div class="flex mx-auto my-6 justify-between">
            <div class="flex">
                <div class="">
                    <div id="loginMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
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
        <p class="ml-[50%] my-4 text-3xl font-bold">{{Auth::user()->name}}さん</p>
        <div class="flex my-8">
            <div class="w-1/2">
                <p class="my-4 font-bold text-xl">予約状況</p>
                @php
                $count = 1;
                $nowDate = new DateTime();
                $nowDate->format('Y-m-d');
                @endphp
                @foreach($reservations as $reservation)
                <div class="w-[90%] mr-[10%] bg-blue-500 rounded-[10px]">
                    <div class="flex">
                        <i class="content-center mx-4 fa-regular fa-clock fa-lg clock-color"></i>
                        <p class="my-4 text-white">予約{{$count}}</p>
                        <form class="mt-4 ml-auto mr-4" action="/delete" method="post">
                            @method("PUT")
                            @csrf
                            <input type="hidden" name="shopId" value="{{$reservation->id}}">
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <button type="submit">
                                <i class="fa-solid fa-trash fa-lg clock-color"></i>
                            </button>
                        </form>
                    </div>
                    <div class="mx-4 mb-4">
                        <table class="w-[90%] mx-auto text-white">
                            <tr>
                                <td class="w-[20%] pb-4">Shop</td>
                                <td class="w-[80%]">{{$reservation->shop_name}}</td>
                            </tr>
                            <tr>
                                <td class="w-[20%] pb-4">Date</td>
                                <td class="w-[80%]">{{$reservation->reservation_date}}</td>
                            </tr>
                            <tr>
                            <td class="w-[20%] pb-4">Time</td>
                                <td class="w-[80%]">{{$reservation->reservation_time}}</td>
                            </tr>
                            <tr>
                            <td class="w-[20%] pb-4">Number</td>
                                <td class="w-[80%]">{{$reservation->reservation_number}}人</td>
                            </tr>
                        </table>
                        @php
                        $reservationDate = new DateTime($reservation->reservation_date);
                        $reservationDate->format('Y-m-d');
                        @endphp
                        @if($reservationDate>$nowDate)
                        <form class="flex justify-end w-full" action="/edit" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <input type="hidden" name="shopId" value="{{$reservation->id}}">
                            <input type="hidden" name="date" value="{{$reservation->reservation_date}}">
                            <input type="hidden" name="time" value="{{$reservation->reservation_time}}">
                            <input type="hidden" name="number" value="{{$reservation->reservation_number}}">
                            <input type="submit" class="w-[100px] content-center mb-2 px-4 text-white bg-blue-400 rounded-[5px]" value="編集">
                        </form>
                        @elseif($reservationDate<$nowDate)
                        <form class="flex justify-end w-full" action="/review" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <input type="hidden" name="shopId" value="{{$reservation->id}}">
                            <input type="submit" class="w-[100px] content-center mb-2 px-4 text-white bg-blue-400 rounded-[5px]" value="評価">
                        </form>
                        @endif
                    </div>
                </div>
                @php
                $count += 1
                @endphp
                @endforeach
            </div>
            <div class="w-1/2">
                <p class="font-bold text-xl my-4">お気に入り店舗</p>
                <div class="flex flex-wrap">
                    <!-- 店カード -->
                    @foreach($favorites as $favorite )
                    <div class="flex-column break-words w-[40%] h-[300px] mr-[10%] my-4 bg-white rounded-[10px] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.3)]">
                        <img class="object-cover w-full h-1/2 rounded-t-[10px]" src="{{ asset($favorite->img)}}">
                        <div class="mx-4">
                            <div class="mt-4">{{$favorite->shop_name}}</div>
                            <div class="flex">
                                <div class="text-xs">#{{$favorite->area_name}}</div>
                                <div class="text-xs mx-[5px]">#{{$favorite->category_name}}</div>
                            </div>
                            <div class="flex w-full mx-auto h-[50px] my-4">
                                <form class="flex content-center " action="/detail" method="get">
                                    <input type="hidden" name="shopId" value="{{$favorite->shop_id}}">
                                    <input type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-[5px]" value="詳しくみる"/>
                                </form>
                                <form class="flex w-full" action="/" method="post">
                                    @csrf
                                    @method('PUT')
                                    @auth
                                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="shopId" value="{{$favorite->shop_id}}">
                                        <input id="id{{$favorite->id}}" type="image" class="w-[20%] mr-2 ml-auto active" src="{{ asset('img/593_me_h.png')}}">
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- ログイン時メニュー -->
    <div class="absolute w-[90%] mx-auto my-6 top-[0px]">
        <div id="menuBg" class="w-full h-full fixed top-[0px] left-[0px] bottom-[0px] bg-white"></div>
        <div id="close" class="w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="w-[70%] mx-auto">
                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
            </div>
        </div>
        <div id="loginContainer" class="absolute w-full my-32 text-center">
        <ul>
                <li class="mb-2 text-2xl text-blue-500"><form class="text-2xl text-blue-500" method="POST" action="/">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
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
</body>
</html>