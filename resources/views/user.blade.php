@use('App\Models\User')
@php
    /** @var User $user */
@endphp
<x-layout title="Settings">
    <h1>Settings</h1>
    <form method="POST" action="{{route('user.update')}}" novalidate>
        @method("PATCH")
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" maxlength="255" value="{{old('name') ?? $user->name}}">
        </div>
        @error('name')
        <div>{{$message}}</div>
        @enderror
        <input type="submit" value="Update">
    </form>
    <form method="POST" action="{{route('user.update.email')}}" novalidate>
        @method("PATCH")
        <label for="email">Email: </label><input type="email" id="email" name="email" maxlength="255" value="{{old('email') ?? $user->email}}">
        <input type="submit" value="Update">
        @error('email')
        <div>{{$message}}</div>
        @enderror
    </form>
    <form method="POST" action="{{route('user.destroy')}}">
        @method("DELETE")
        <input type="submit" value="Delete account">
    </form>
</x-layout>
