<x-layout>
    <h1>{{config("app.name")}}</h1>
    @guest
        <a href="{{route("login", absolute: false)}}">Login</a>
        <a href="{{route("register", absolute: false)}}">Register</a>
    @else
        <a href="{{route("playlist.index", absolute: false)}}">Playlists</a>
        <form method="POST" action="{{route("logout", absolute: false)}}">
            <input type="submit" value="Logout">
        </form>
    @endguest
</x-layout>
