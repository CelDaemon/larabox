@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
<x-layout title="Home">
    @guest
        <a href='{{route('login')}}'>Login</a> <a href='{{route('register')}}'>Register</a>
    @else
        <style @nonce>
            .not-verified {
                color: red;
            }
        </style>
        @php
            /** @var User $user */
            $user = Auth::user();
        @endphp
        <h1>Home</h1>
        @if(!$user->hasVerifiedEmail())
            <h4 class="not-verified">Your email is not verified, if the email didn't arrive, <a href="{{route('verification.notice')}}">resend it here.</a></h4>
        @endif
        <form action="{{route('logout')}}" method="POST">
            @method("DELETE")
            <input type="submit" value="Logout">
        </form>
    @endguest
</x-layout>
