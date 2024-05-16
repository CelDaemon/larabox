<x-layout name="Playlists">
    <style @nonce>
        a {
            -moz-appearance: button;
        }
    </style>
    <h1>View Playlists</h1>
    <a href="{{route("playlist.create")}}">New Playlist</a>
    <ul>
        @foreach($playlists as $playlist)
            <li><a href="{{route("playlist.show", [$playlist])}}">{{$playlist->title}}</a></li>
        @endforeach
    </ul>
</x-layout>
