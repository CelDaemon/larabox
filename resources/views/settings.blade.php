@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
@php(/** @var User $user */ $user = Auth::user())
<x-layout :title="__('Settings')">
    <h1>{{__('Settings')}}</h1>
    <form method="POST" action="{{route('users.update', ['user' => $user])}}" novalidate>
        @method("PATCH")
        <div>
            <label for="name">{{__('Name')}}:</label>
            <input id="name" type="text" name="name" maxlength="255" value="{{old('name') ?? $user->name}}">
        </div>
        @error('name')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255" value="{{old('email') ?? $user->email}}">
        </div>
        @error('email')
        <div>{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Update')}}">
        <div>{{session('status')}}</div>
    </form>
    <h2>{{__('Update Password')}}</h2>
    <form method="POST" action="{{route('users.update.password', ['user' => $user])}}">
        <div>
            <label for="current_password">{{__('Current password')}}:</label>
            <input id="current_password" type="password" name="current_password">
        </div>
        @error('current_password')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('Password')}}</label>
            <input id="password" type="password" name="password">
        </div>
        @error('password')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password_confirmation">{{__('Password confirmation')}}</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
        @error('password_confirmation')
        <div>{{$message}}</div>
        @enderror
        <input type="submit" value="Update password">
        <div>{{session('password.status')}}</div>
    </form>
    <h2>{{__('Logout')}}</h2>
    <form method="POST" action="{{route('auth.logout')}}">
        <input type="submit" value="{{__('Logout')}}">
    </form>
    <h2>{{__('Delete Account') }}</h2>
    <h3>{{__('Be warned, your account cannot be recovered!')}}</h3>
    <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
        @method("DELETE")
        <input type="submit" value="{{__('Delete')}}">
    </form>
</x-layout>
