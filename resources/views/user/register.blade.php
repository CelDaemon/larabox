<x-layout title="Register">
    <link rel="stylesheet" href="{{asset("/css/user/register.css")}}">
    <x-single-modal title="Register" subtitle="Welcome to Larabox!">
        <form method="POST" class="single-modal-form">
            <input name="name" placeholder="Username" class="@error('name') invalid @enderror" value="{{old("name")}}">
            @error("name")
              <span class="error">{{$message}}</span>
            @enderror
            <input type="text" autocomplete="email" name="email" placeholder="Email" class="@error('email') invalid @enderror" value="{{old("email")}}">
            @error("email")
              <span class="error">{{$message}}</span>
            @enderror
            <input type="password" name="password" placeholder="Password" class="@error('password') invalid @enderror">
            @error("password")
            <span class="error">{{$message}}</span>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="@error('password_confirmation') invalid @enderror">
            @error("password_confirmation")
            <span class="error">{{$message}}</span>
            @enderror
            <input type="submit" value="Register">
        </form>
    </x-single-modal>
</x-layout>
