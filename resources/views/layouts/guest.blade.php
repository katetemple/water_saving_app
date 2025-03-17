<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-bl from-[#3F72AF] to-[#2E527D] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

        <!-- LOGIN/SIGN IN CONTAINER -->
        <div class="flex items-center justify-center w-full opacity-100 lg:grow">
            <div class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row bg-white shadow-lg rounded-2xl">
                <!-- Log in/ Sign in form -->
                <div class="flex-1 p-6 pb-12 lg:p-20">
                    <img src="images/LogoWhiteBg.png" class="w-20 pb-5">
                    {{ $slot }}
                </div>
                <!-- Image -->
                <div class="bg-[#fff2f2] relative lg:-ml-px -mb-px lg:mb-0 rounded-2xl lg:aspect-auto w-full lg:w-[438px] overflow-hidden">
                    <img src="images/welcomeIllustration.png" class="w-full h-full object-cover" />
                </div>
            </div>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
