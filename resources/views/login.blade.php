<x-layout title='Login'>
    <h1>Login</h1>
    <form method="POST" novalidate>
        <div>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" maxlength="255" value="{{old('email')}}">
        </div>
        @error("email")
        {{$message}}
        @enderror
        <div>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password">
        </div>
        <input type="submit">
    </form>
</x-layout>
