<x-guest-layout>
    <div class="min-h-screen flex flex-col pt-[200px] items-center pt-0 bg-gray-100">
        <!-- login -->
        <p class="w-[90%] sm:max-w-md shadow-md px-4 py-4 overflow-hidden bg-blue-500 rounded-t-lg text-white md:w-[30%]">Registration</p>
        <!-- 入力フォーム -->
        <div class="w-[90%] sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-b-lg md:w-[30%]">
            <form method="POST" action="{{ route('registerAdmin') }}">
                @csrf
                <input type="hidden" name="userId" value="{{$userId}}">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- authority -->
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">authority</label>
                    <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="authority">
                        <option value="1">admin</option>
                        <option value="2">owner</option>
                        <option value="3">user</option>
                    </select>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
