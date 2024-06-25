@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
@php(/** @var User $user */ $user = Auth::user())
<x-layout :title="__('Settings')">
    <h1>{{__('Settings')}}</h1>
    <form method="POST" action="{{route('users.update', ['user' => $user])}}" novalidate>
        @method("PATCH")
        <x-input :label="__('Name')" name="name" maxlength="255" :value="$user->name"/>
        <x-input :label="__('Email')" name="email" type="email" maxlength="255" :value="$user->email"/>
        <input type="submit" value="{{__('Save')}}">
        <div>{{session('status')}}</div>
    </form>
    <h2>{{__('Update Password')}}</h2>
    <form method="POST" action="{{route('users.update-password', ['user' => $user])}}">
        @method("PATCH")
        <x-input :label="__('Current password')" name="current_password" type="password"/>
        <x-input :label="__('Password')" name="password" type="password"/>
        <x-input :label="__('Password confirmation')" name="password_confirmation" type="password"/>
        <input type="submit" value="{{__('Change password')}}">
        <div>{{session('password.status')}}</div>
    </form>
    <h2>{{__('Logout')}}</h2>
    <form method="POST" action="{{route('session.destroy')}}">
        @method("DELETE")
        <input type="submit" value="{{__('Logout')}}">
    </form>
    <h2>{{__('Delete Account') }}</h2>
    <button is="dialog-button" data-for="delete">{{__('Delete')}}</button>
    <dialog id="delete">
        <h2>{{__('Are you sure?') }}</h2>
        <h4>{{__('Be warned, your account cannot be recovered!')}}</h4>
        <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
            @method("DELETE")
            <input type="submit" formmethod="dialog" value="{{__('Cancel')}}">
            <input type="submit" value="{{__('Delete')}}">
        </form>
    </dialog>
</x-layout>
