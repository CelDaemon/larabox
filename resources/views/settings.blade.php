@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
@php(/** @var User $user */ $user = Auth::user())
<x-layout :title="__('Settings')">
    <h1>{{__('Settings')}}</h1>
    <form method="POST" action="{{route('users.update', ['user' => $user])}}" novalidate>
        @method("PATCH")
        <div>
            <label for="name">{{__('Name')}}:</label>
            <input id="name" type="text" name="name" maxlength="255" value="{{old('name') ?? $user->name}}" class="@error('name') error-input @enderror">
        </div>
        @error('name')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255" value="{{old('email') ?? $user->email}}" class="@error('email') error-input @enderror">
        </div>
        @error('email')
        <div class="error-message">{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Save')}}">
        <div>{{session('status')}}</div>
    </form>
    <h2>{{__('Update Password')}}</h2>
    <form method="POST" action="{{route('users.update-password', ['user' => $user])}}">
        <div>
            <label for="current_password">{{__('Current password')}}:</label>
            <input id="current_password" type="password" name="current_password" class="@error('current_password') error-input @enderror">
        </div>
        @error('current_password')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('Password')}}:</label>
            <input id="password" type="password" name="password" class="@error('password') error-input @enderror">
        </div>
        @error('password')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="password_confirmation">{{__('Password confirmation')}}:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="@error('password_confirmation') error-input @enderror">
        </div>
        @error('password_confirmation')
        <div class="error-message">{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Change password')}}">
        <div>{{session('password.status')}}</div>
    </form>
    <h2>{{__('Logout')}}</h2>
    <form method="POST" action="{{route('session.destroy')}}">
        @method("DELETE")
        <input type="submit" value="{{__('Logout')}}">
    </form>
    <h2>{{__('Delete Account') }}</h2>
    <h3>{{__('Be warned, your account cannot be recovered!')}}</h3>
    <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
        @method("DELETE")
        <input type="submit" value="{{__('Delete')}}">
    </form>
    <a href="{{route('home')}}">{{__('Back')}}</a>
</x-layout>
