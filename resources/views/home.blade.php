@use('Illuminate\Support\Facades\Auth')
@use('App\Models\User')
<x-layout :title="__('Home')">
    <h1>{{__('Home')}}</h1>
    @guest
        <a href="{{route('register')}}">{{__('Register')}}</a>
        <a href="{{route('login')}}">{{__('Login')}}</a>
    @else
        @php /** @var User $user */ $user = Auth::user() @endphp
        @if(!$user->hasVerifiedEmail())
            <p><strong>{{__('Your email address is not verified, if no verification was received,')}} <a href="{{route('verification.notice')}}">{{__('try again here.')}}</a></strong></p>
        @endif
        <a href="{{route('settings')}}">{{__('Settings')}}</a> <a href="{{route('library')}}">{{__('Library')}}</a>
    @endguest
</x-layout>
