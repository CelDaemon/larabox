<x-layout :title="__('Request Password Reset')">
    <h1>{{__('Request Password Reset')}}</h1>
    <form method="POST" action="{{route('password.email')}}" novalidate>
        <x-input :label="__('Email')" name="email" type="email" maxlength="255"/>
        <input type="submit">
        <div>{{session('status')}}</div>
    </form>
</x-layout>
