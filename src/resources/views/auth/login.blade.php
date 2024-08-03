<x-guest-layout>
    <div class="min-h-screen flex flex-col pt-[200px] items-center pt-0 bg-gray-100">
        <!-- login -->
        <p class="w-[90%] sm:max-w-md shadow-md px-4 py-4 overflow-hidden bg-blue-500 rounded-t-lg text-white md:w-[30%]">Login</p>
        <!-- 入力フォーム -->
        <div class="w-[90%] sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-b-lg md:w-[30%]">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            @if (session('customErrors.sessionOut'))
                <div class="text-red-500">{{ session('customErrors.sessionOut') }}</div>
            @endif

            <form method="POST" action="sendTokenEmail">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-text-input id="email" class="block w-full mt-1 p-0 border-none focus:ring-0" type="text" name="email" :value="old('email')" placeholder="Email" autofocus autocomplete="username" />
                    <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
                    <div class="w-full border-b border-gray-500"></div>
                </div>
                @if (session('customErrors.email'))
                    <div class="text-red-500">{{ session('customErrors.email') }}</div>
                @endif

                <!-- Password -->
                <div class="mt-4">
                    <x-text-input id="password" class="block mt-1 p-0 w-full border-none focus:ring-0"
                                    type="password"
                                    name="password"
                                    placeholder="Paassword"
                                    autocomplete="current-password" />
                    <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
                    <div class="w-full border-b border-gray-500"></div>
                </div>
                @if (session('customErrors.pass'))
                    <div class="text-red-500">{{ session('customErrors.pass') }}</div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        認証コード送信
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
