@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full sm:max-w-lg">
            <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="text-xl text-center mb-5">{{ __('Login') }}</div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email Address
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3
                    text-gray-700 leading-tight focus:outline-none
                    focus:shadow-outline" id="email" name="email"
                           value="{{ old('email') }}" type="text"
                           placeholder="john@example.com" autofocus required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs italic">{!! $message !!}</p>
                    @enderror

                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border border-red-500 rounded w-full
                        py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        required autocomplete="current-password"
                        name="password" id="password"
                        type="password" placeholder="******************">
                    @error('password')
                        <p class="text-red-500 text-xs italic">{!! $message !!}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button class="button" type="submit">
                        Sign In
                    </button>
                    @if (Route::has('password.request'))
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-500"
                           href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif

                </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
                &copy;2019 All rights reserved.
            </p>
        </div>
    </div>
@endsection
