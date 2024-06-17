@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
@php(/** @var User $user */ $user = Auth::user())
<x-layout :title="__('settings')">
    <h1>{{__('settings')}}</h1>
    <form method="POST" action="{{route('users.update', ['user' => $user])}}" novalidate>
        @method("PATCH")
        <div>
            <label for="name">{{__('name')}}:</label>
            <input id="name" type="text" name="name" maxlength="255" value="{{old('name') ?? $user->name}}">
        </div>
        @error('name')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="email">{{__('email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255" value="{{old('email') ?? $user->email}}">
        </div>
        @error('email')
        <div>{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('update')}}">
    </form>
    <form method="POST" action="{{route('auth.logout')}}">
        <input type="submit" value="{{__('logout')}}">
    </form>
    <hr>
    <h3>{{__('settings.delete_warning')}}</h3>
    <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
        @method("DELETE")
        <input type="submit" value="{{__('delete')}}">
    </form>
</x-layout>
