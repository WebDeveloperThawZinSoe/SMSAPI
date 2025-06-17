<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-indigo-600">Poh Mal SMS Provider</h2>
                <p class="text-sm text-gray-500 mt-1">Secure login to your provider dashboard</p>
                <a href="/faq">FAQs</a>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- AlpineJS scope starts here -->
        <div x-data="{ showContactModal: false }">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mb-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    <!-- Trigger Modal -->
                    <button type="button"
                        @click="showContactModal = true"
                        class="text-sm text-indigo-500 hover:underline focus:outline-none">
                        {{ __('Forgot your password?') }}
                    </button>
                </div>

                <div>
                    <x-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>

            <!-- Modal -->
           <!-- Modal -->
<div
    x-show="showContactModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50 p-4"
    style="display: none;"
    @keydown.escape.window="showContactModal = false"
>
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-auto p-6 relative">
        <!-- Close button top-right -->
        <button
            @click="showContactModal = false"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 focus:outline-none"
            aria-label="Close modal"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-indigo-700 mb-4 text-center">Reset Password Support</h2>

        <p class="text-gray-700 mb-6 text-center">
            Please contact us through one of the following methods:
        </p>

        <ul class="space-y-4 text-gray-600 text-base">
            <li>
                <strong>Email:</strong>
                <a href="mailto:thawzinsoe.dev@gmail.com" class="text-indigo-600 hover:underline break-words">
                    thawzinsoe.dev@gmail.com
                </a>
            </li>
            <li>
                <strong>Telegram:</strong>
                <a href="https://t.me/thawmax2023" target="_blank" class="text-indigo-600 hover:underline break-words">
                    @thawmax2023
                </a>
            </li>
            <li>
                <strong>Phone:</strong>
                <a href="tel:09403077739" class="text-indigo-600 hover:underline">
                    09 403 077 739
                </a>
            </li>
        </ul>

        <div class="mt-8 flex justify-center">
            <button
                @click="showContactModal = false"
                class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                Close
            </button>
        </div>
    </div>
</div>

        </div>
    </x-authentication-card>
</x-guest-layout>
