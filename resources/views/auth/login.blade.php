<x-layout :title="__('Login')">
    <h1>{{__('Login')}}</h1>
    <form method="POST" action="{{route('session.store')}}" novalidate>
        <x-input :label="__('Email')" name="email" type="email" maxlength="255"/>
        <x-input :label="__('Password')" name="password" type="password"/>
        <input type="submit" value="{{__('Login')}}">
    </form>
    <a href="{{route('register')}}">{{__('Register')}}</a>
    <a href="{{route('password.request')}}">{{__('Reset password')}}</a>
</x-layout>
