<x-layout title='Register'>
    <h1>Register</h1>
    <form method="POST" novalidate>
        <div>
            <label for="name">Name:</label>
            <input id="name" name="name" maxlength="255" value="{{old('name')}}">
        </div>
        @error('name')
            {{$message}}
        @enderror
        <div>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" maxlength="255" value="{{old('email')}}">
        </div>
        @error('email')
            {{$message}}
        @enderror
        <div>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password">
        </div>
        @error('password')
            {{$message}}
        @enderror
        <div>
            <label for="password_confirmation">Password Confirmation:</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
        <input type="submit">
    </form>
</x-layout>
