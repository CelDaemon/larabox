@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
<x-layout title="Home">
    @guest
        <a href='{{route('login')}}'>Login</a> <a href='{{route('register')}}'>Register</a>
    @else
        @php
            /** @var User $user */
            $user = Auth::user();
        @endphp
        <h1>Home</h1>
        @if(!$user->hasVerifiedEmail())
            <h4 style="color: red;">Your email is not verified, if the email didn't arrive, <a href="{{route('verification.notice')}}">resend it here.</a></h4>
        @endif
        <form action="{{route('logout')}}" method="POST">
            <input type="submit" value="Logout">
        </form>
    @endguest
</x-layout>
