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
    </form>
    <form method="POST" action="{{route('auth.logout')}}">
        <input type="submit" value="{{__('Logout')}}">
    </form>
    <hr>
    <h3>{{__('Be warned, your account cannot be recovered!')}}</h3>
    <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
        @method("DELETE")
        <input type="submit" value="{{__('Delete')}}">
    </form>
</x-layout>
