@php
    /** @var string $token */
    /** @var string $email */
@endphp
<x-layout :title="__('Reset Password')">
    <h1>{{__('Reset Password')}}</h1>
    <form method="POST" action="{{route('password.update', ['token' => $token])}}" novalidate>
        <input type="hidden" name="email" value="{{$email}}">
        <x-input :label="__('Password')" name="password" type="password"/>
        <x-input :label="__('Password confirmation')" name="password_confirmation" type="password"/>
        <input type="submit" value="{{__('Reset password')}}">
    </form>
</x-layout>
