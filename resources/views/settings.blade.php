@use('App\Models\User')
@php
    /** @var User $user */
@endphp
<x-layout title="Settings">
    <h1>Settings</h1>
    <form method="POST" action="{{route('users.update', ['user' => $user])}}" novalidate>
        @method("PATCH")
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" maxlength="255" value="{{old('name') ?? $user->name}}">
        </div>
        @error('name')
        <div>{{$message}}</div>
        @enderror
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" maxlength="255" value="{{old('email') ?? $user->email}}">
        </div>
        @error('email')
        <div>{{$message}}</div>
        @enderror
        <input type="submit" value="Update">
    </form>
    <form method="POST" action="{{route('users.destroy', ['user' => $user])}}">
        @method("DELETE")
        <input type="submit" value="Delete account">
    </form>
</x-layout>
