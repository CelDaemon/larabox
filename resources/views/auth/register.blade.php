<x-layout :title="__('Register')">
    <h1>{{__('Register')}}</h1>
    <form method="POST" action="{{route('users.store')}}" novalidate>
        <x-input :label="__('Name')" name="name" maxlength="255"/>
        <x-input :label="__('Email')" name="email" type="email" maxlength="255"/>
        <x-input :label="__('Password')" name="password" type="password"/>
        <x-input :label="__('Password confirmation')" name="password_confirmation" type="password"/>
        <input type="submit" value="{{__('Update')}}">
    </form>
</x-layout>
