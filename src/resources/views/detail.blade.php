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
                        @php
                            $authority = Auth::user()->authority;
                            $userId = Auth::user()->id;
                            $ownerFlg = false;
                        @endphp
                        <div id="loginMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                            <div class="w-[70%] mx-auto">
                                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                            </div>
                        </div>
                        @php
                            $userId=Auth::user()->id;
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
                            $userId='';
                        @endphp
                    @endauth
                </div>
                <div class="px-16 text-4xl text-blue-600 font-bold">Rese</div>
            </div>
        </div>
    </header>

    <main class="flex h-screen overflow-auto">
        <!-- 店の詳細表示エリア -->
        <div class="flex pt-24 w-1/2">
            <div class="w-[100%]">
                @foreach($owners as $owner)
                    @php
                        if($owner->user_id == $userId){
                            $ownerFlg = True;
                        }
                    @endphp
                @endforeach
                <div class="flex">
                    <a href="javascript:history.back();" class="border mt-2 w-[30px] h-[30px] bg-white rounded-[5px] content-center text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,0.3)]">＜</a>
                    @if($authority == 1 or $ownerFlg == True)
                        <input type="text" name="shopName" class="mx-4 text-4xl" value="{{$shop->shop_name}}" form="editDetail">
                    @else
                        <h1 class="mx-4 text-4xl">{{$shop->shop_name}}</h1>
                    @endif
                </div>
                
                @if($authority == 1 or $ownerFlg == True)
                    <form class="flex justify-end mt-4" action="editOwner" method="post">
                        @csrf
                        @method("PUT")
                        <div class="flex">
                            <select name="userId" class="rounded-[5px]">
                                <option value="0" @if($userId == 0) selected @endif>オーナーを選択してください</option>
                                @foreach($owners as $owner)
                                <option value="{{$owner->id}}" @if($userId == $owner->id) selected @endif>{{$owner->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-[5px]" value="オーナー登録">
                        </div>
                    </form>
                    @if($errStatus==1)
                    <p class="text-end text-red-500 font-bold">オーナーを選択してください</p>
                    @elseif($errStatus==2)
                        <p class="text-end text-red-500 font-bold">すでにこの店舗のオーナーとして登録されています</p>
                    @endif
                    <form action="editDetail" method="post" id="editDetail" enctype="multipart/form-data">
                        @method("patch")
                        @csrf
                        <img class="object-cover w-[80%] rounded-t-[10px] py-4" src="{{ asset('storage/'.$shop->img)}}">
                        <input type="file" class="mb-4 mt-auto py-2 rounded-[5px]" name="path" value="画像編集">
                        <div class="mb-2">
                            <select class="border-none focus:ring-0 " name="area">
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}" @if($selectedArea->area_id == $area->id) selected @endif>{{$area->area_name}}</option>
                                @endforeach
                            </select>
                            <select class="border-none focus:ring-0 " name="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($selectedCategory->category_name == $category->category_name) selected @endif>{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="break-words">
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="hidden" name="userId" value="{{$userId}}">
                            <textarea class="w-full rounded-[5px]" name="detail" rows="3" maxlength="255">{{$shop->detail}}</textarea>
                        </div>
                        <div class="flex my-2 justify-end">
                            <input type="submit" class="ml-4 px-8 py-2 bg-blue-500 text-white rounded-[5px]" value="編集">
                        </div>
                    </form>
                @else
                    <img class="object-cover w-full rounded-t-[10px] py-4" src="{{ asset('storage/'.$shop->img)}}">
                    <div class="py-4">
                        <p class="inline-block">#{{$selectedArea->area_name}}</p>
                        <p class="inline-block pl-2">#{{$selectedCategory->category_name}}</p>
                    </div>
                    <div class="break-words">
                        <p>{{$shop->detail}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex pt-24 w-1/2">
        @if($authority == 1 or $ownerFlg == True)
        <div class="w-[90%] ml-[10%]">
                <p class="my-4 font-bold text-xl">予約状況</p>
                @php
                $count = 1;
                @endphp
                @foreach($reservationList as $reservation)
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
                                <td class="w-[80%] pb-4 px-4">{{$reservation->shop_name}}</td>
                            </tr>
                            <tr>
                                <td class="w-[20%] pb-4">Date</td>
                                <td class="w-[80%] pb-4 px-4">{{$reservation->reservation_date}}</td>
                            </tr>
                            <tr>
                            <td class="w-[20%] pb-4">Time</td>
                                <td class="w-[80%] pb-4 px-4">{{$reservation->reservation_time}}</td>
                            </tr>
                            <tr>
                            <td class="w-[20%] pb-4">Number</td>
                                <td class="w-[80%] pb-4 px-4">{{$reservation->reservation_number}}人</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @php
                $count += 1
                @endphp
                @endforeach
            </div>
        @else
            <!-- 予約情報入力エリア -->
            <div class="absolute top-[24px] left-[50%] w-1/2 h-[90%]">
                <div class="flex flex-col  w-[80%] h-full mx-auto bg-blue-600 rounded-[5px]">
                    <p class="mx-[5%] pt-8 text-white text-xl font-bold">予約</p>
                        <form class="flex flex-col w-full mx-auto h-full" action="/done" method="post">
                        @csrf
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="hidden" name="userId" value="{{$userId}}">
                            <input type="date" class="mx-[5%] w-[40%] my-2 rounded-[5px] w-[90%] md:w-[50%]" name="date" id="date" value="{{date('Y-m-d')}}">
                            <select class="mx-[5%] my-2 rounded-[5px]" name="time" id="time">
                                <option>11:00</option>
                                <option>12:00</option>
                                <option>13:00</option>
                                <option>14:00</option>
                                <option>15:00</option>
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                            <select class="mx-[5%] my-2 rounded-[5px]" name="num" id="number">
                                <option>1人</option>
                                <option>2人</option>
                                <option>3人</option>
                                <option>4人</option>
                                <option>5人</option>
                                <option>6人</option>
                                <option>7人</option>
                                <option>8人</option>
                                <option>9人</option>
                                <option>10人</option>
                            </select>
                        <div class="flex content-center w-[90%] mx-[5%] mx-auto my-2 bg-blue-500 rounded-[5px]">
                            <table class="w-[90%] mx-auto">
                                <tr>
                                    <td class="w-[30%] py-2 text-left text-white">Shop</td>
                                    <td class="w-[70%] py-2 px-4 text-left text-white" id="shopName">{{$shop->shop_name}}</td>
                                </tr>
                                <tr>
                                    <td class="w-[30%] py-2 text-left text-white">Date</td>
                                    <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedDate">{{date('Y-m-d')}}</td>
                                </tr>
                                <tr>
                                    <td class="w-[30%] py-2 text-left text-white">Time</td>
                                    <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedTime">11:00</td>
                                </tr>
                                <tr>
                                    <td class="w-[30%] py-2 text-left text-white">Number</td>
                                    <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedNumber">1人</td>
                                </tr>
                            </table>
                        </div>

                        <div class="my-4">
                            @foreach($errors->all() as $error)
                            <li class="w-[90%] mx-[5%] mx-auto font-bold text-red-500">{{$error}}</li>
                            @endforeach
                        </div>

                        <div class="w-full mb-0 mt-auto">
                            <input type="submit" class="w-full py-4 text-center text-white bg-blue-700" name="" value="予約する">
                        </div>
                    </form>
                </div>
            </div>
        @endif
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
                <li class="mb-2 text-2xl text-blue-500"><a href="/ownersetting">OwnerSetting</a></li>
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