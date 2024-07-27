<x-guest-layout>
<div class="min-h-screen flex flex-col pt-[200px] items-center pt-0 bg-gray-100">
    <p class="w-[90%] sm:max-w-md shadow-md px-4 py-4 overflow-hidden bg-blue-500 rounded-t-lg text-white md:w-[30%]">Login</p>
    <!-- 入力フォーム -->
    <div class="w-[90%] sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-b-lg md:w-[30%]">
        <form method="POST" action="/">
            @csrf
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="onetime_token" value="認証コード" />
                <x-text-input id="onetime_token" class="block mt-1 w-full" type="number" name="onetime_token" :value="old('onetime_token')" required/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    ログイン
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>
