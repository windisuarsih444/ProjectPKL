<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-900 shadow-lg rounded-lg p-8 animate-fade-in">
        <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-white">Create an Account</h2>
        
        <form method="POST" action="{{ route('register') }}" class="mt-6">
            @csrf

            <!-- Name -->
            <div class="relative">
                <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4 relative">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 relative">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 transition-all duration-300" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-transform duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
