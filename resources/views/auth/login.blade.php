<x-layout :title="__('Login')">
    <h1>{{__('Login')}}</h1>
    <form method="POST" action="{{route('auth.login')}}" novalidate>
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255">
        </div>
        @error('email')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('Password')}}:</label>
            <input id="password" type="password" name="password">
        </div>
        @error('password')
            <div>{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Login')}}">
    </form>
    <a href="{{route('register')}}">{{__('Register')}}</a>
    <a href="{{route('password.request')}}">{{__('Reset password')}}</a>
</x-layout>
