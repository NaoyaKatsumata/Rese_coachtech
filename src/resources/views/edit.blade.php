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
                            $authority = Auth::user()->authority;
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
        </div>
    </header>

    <main>
        <!-- 店の詳細表示エリア -->
        <div class="flex pt-24 w-1/2">
            <div class="w-[100%]">
                <div class="flex">
                    <a href="javascript:history.back();" class="border mt-2 w-[30px] h-[30px] bg-white rounded-[5px] content-center text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,0.3)]">＜</a>
                    <p class="mx-4 text-4xl">{{$shop->shop_name}}</p>
                </div>
                <img class="object-cover w-full rounded-t-[10px] py-4" src="{{ asset('storage/'.$shop->img)}}" alt="No Image">
                <div class="py-4">
                    <p class="inline-block">#{{$shop->area_name}}</p>
                    <p class="inline-block pl-2">#{{$shop->category_name}}</p>
                </div>
                <div class="break-words">
                    <p>{{$shop->detail}}</p>
                </div>
            </div>
        </div>
        <!-- 予約情報入力エリア -->
        <div class="absolute top-[24px] left-[50%] w-1/2 h-[90%]">
            <div class="flex flex-col  w-[80%] h-full mx-auto bg-blue-600 rounded-[5px]">
                <p class="mx-[5%] pt-8 text-white text-xl font-bold">予約</p>
                <form class="flex flex-col w-full mx-auto h-full" action="/done" method="post">
                @method("PUT")
                @csrf
                @php
                    $timestamp = explode(" ", $shop->reservation_date);
                    $date = $timestamp[0];
                    $time = $timestamp[1];
                @endphp
                    <input type="hidden" name="shopId" value="{{$shop->id}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="hidden" name="prevDate" value="{{$shop->reservation_date}}">
                    <input type="hidden" name="prevTime" value="{{$shop->reservation_time}}">
                    <input type="hidden" name="prevNum" value="{{$shop->reservation_number}}">
                    <input type="date" class="mx-[5%] w-[40%] my-2 rounded-[5px]" name="date" id="date" value="{{$date}}">
                    <select class="mx-[5%] my-2 rounded-[5px]" name="time" id="time">
                        <option @if($shop->reservation_time == "11:00:00") selected @endif>11:00</option>
                        <option @if($shop->reservation_time == "12:00:00") selected @endif>12:00</option>
                        <option @if($shop->reservation_time == "13:00:00") selected @endif>13:00</option>
                        <option @if($shop->reservation_time == "14:00:00") selected @endif>14:00</option>
                        <option @if($shop->reservation_time == "15:00:00") selected @endif>15:00</option>
                        <option @if($shop->reservation_time == "16:00:00") selected @endif>16:00</option>
                        <option @if($shop->reservation_time == "17:00:00") selected @endif>17:00</option>
                        <option @if($shop->reservation_time == "18:00:00") selected @endif>18:00</option>
                        <option @if($shop->reservation_time == "19:00:00") selected @endif>19:00</option>
                        <option @if($shop->reservation_time == "20:00:00") selected @endif>20:00</option>
                        <option @if($shop->reservation_time == "21:00:00") selected @endif>21:00</option>
                        <option @if($shop->reservation_time == "22:00:00") selected @endif>22:00</option>
                    </select>
                    <select class="mx-[5%] my-2 rounded-[5px]" name="num" id="number">
                        <option @if($shop->reservation_number == "1") selected @endif>1人</option>
                        <option @if($shop->reservation_number == "2") selected @endif>2人</option>
                        <option @if($shop->reservation_number == "3") selected @endif>3人</option>
                        <option @if($shop->reservation_number == "4") selected @endif>4人</option>
                        <option @if($shop->reservation_number == "5") selected @endif>5人</option>
                        <option @if($shop->reservation_number == "6") selected @endif>6人</option>
                        <option @if($shop->reservation_number == "7") selected @endif>7人</option>
                        <option @if($shop->reservation_number == "8") selected @endif>8人</option>
                        <option @if($shop->reservation_number == "9") selected @endif>9人</option>
                        <option @if($shop->reservation_number == "10") selected @endif>10人</option>
                    </select>
                    <div class="flex content-center w-[90%] mx-[5%] mx-auto my-2 bg-blue-500 rounded-[5px]">
                        <table class="w-[90%] mx-auto">
                            <tr>
                                <td class="w-[30%] py-2 text-left text-white">Shop</td>
                                <td class="w-[70%] py-2 text-left text-white" id="shopName">{{$shop->shop_name}}</td>
                            </tr>
                            <tr>
                                <td class="w-[30%] py-2 text-left text-white">Date</td>
                                <td class="w-[70%] py-2 text-left text-white" id="date">{{$date}}</td>
                            </tr>
                            <tr>
                                <td class="w-[30%] py-2 text-left text-white">Time</td>
                                <td class="w-[70%] py-2 text-left text-white" id="time">{{$time}}</td>
                            </tr>
                            <tr>
                                <td class="w-[30%] py-2 text-left text-white">Number</td>
                                <td class="w-[70%] py-2 text-left text-white" id="selectedNumber">{{$shop->reservation_number}}人</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full mb-0 mt-auto">
                        <input type="submit" class="w-full py-4 text-center text-white bg-blue-700" name="" value="編集する">
                    </div>
                </form>
            </div>
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
    <script src="{{ asset('js/reservation.js') }}"></script>
    <script src="{{ asset('js/loginmenu.js') }}"></script>
    <script src="{{ asset('js/gestmenu.js') }}"></script>
</body>
</html>