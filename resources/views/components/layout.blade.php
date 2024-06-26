@use('Illuminate\Support\Facades\Vite')
@use('Illuminate\View\ComponentSlot')
@php
    /** @var ?string $title */
    /** @var ComponentSlot $slot */
@endphp
    <!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@isset($title)
            {{$title}} -
        @endisset{{config('app.name')}}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" @nonce/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" @nonce>
    <link rel="icon" href="{{Vite::asset('resources/img/responsive-icon.svg')}}">
    @vite(['resources/ts/app.ts', 'resources/css/layout.css'])
</head>
<body>
<nav>
    <div class="nav-section">
        <a href="{{route('home')}}" class="nav-item">
            <div class="nav-icon"></div>
        </a>
        <a href="{{route('home')}}" class="nav-item">{{__('Home')}}</a>
        <a href="{{route('discovery')}}" class="nav-item">{{__('Discovery')}}</a>
        <a href="{{route('queue.show')}}" class="nav-item">{{__('Queue')}}</a>
        @auth
            <a href="{{route('library')}}" class="nav-item">{{__('Library')}}</a>
        @endauth
    </div>
    <div class="nav-section">
        @guest
            <a href="{{route('login')}}" class="nav-item">{{__('Login')}}</a>
            <a href="{{route('register')}}" class="nav-item">{{__('Register')}}</a>
        @else
            <a href="{{route('settings')}}" class="nav-item">{{__('Settings')}}</a>
        @endguest
    </div>
</nav>
<main>
    {{$slot}}
</main>
</body>
</html>
