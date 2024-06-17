@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
<x-layout :title="__('home')">
    <h1>{{__('home')}}</h1>
    @guest
        <a href="{{route('auth.register')}}">{{__('register')}}</a>
        <a href="{{route('auth.login')}}">{{__('login')}}</a>
    @else
        @php(/** @var User $user */ $user = Auth::user())
        @if(!$user->hasVerifiedEmail())
            <p><strong>{{__('home.not_verified.0')}} <a href="#">{{__('home.not_verified.1')}}</a></strong></p>
        @endif
        <a href="{{route('settings')}}">{{__('settings')}}</a>
    @endguest
</x-layout>
