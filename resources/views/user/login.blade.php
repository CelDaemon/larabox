<x-layout title="Login">
    <link rel="stylesheet" href="{{asset("/css/user/login.css")}}">
    <x-single-modal title="Login" subtitle="Welcome to Larabox!">
        <form method="POST" class="single-modal-form">
            <input type="text" autocomplete="email" name="email" placeholder="Email" value="{{old("email")}}" class="@error("email") invalid @enderror">
            @error("email")
            <span class="error">{{$message}}</span>
            @enderror
            <input type="password" name="password" placeholder="Password" class="@error("password") invalid @enderror">
            @error("password")
            <span class="error">{{$message}}</span>
            @enderror
            <input type="submit" value="Login">
        </form>
    </x-single-modal>
</x-layout>
