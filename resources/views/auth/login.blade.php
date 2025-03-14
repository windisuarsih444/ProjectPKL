<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white dark:bg-gray-900 shadow-lg rounded-lg p-8 animate-fade-in">
        <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-white">Log In</h2>
        
        <form method="POST" action="{{ route('login') }}" class="mt-6">
            @csrf

            <!-- Email Address -->
            <div class="relative">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 relative">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 transition-transform duration-300 focus:scale-105" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 transition-transform duration-300 hover:scale-110" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 transition-all duration-300" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <x-primary-button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-transform duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>