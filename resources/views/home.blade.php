<x-layout title='Home'>
    @guest
        <a href='{{route('login')}}'>{{__('login')}}</a> <a href='{{route('register')}}'>{{__('register')}}</a>
    @else
        <h1>Home</h1>
        <form action="{{route('logout')}}" method="POST">
            <input type="submit" value="Logout">
        </form>
    @endif
</x-layout>
