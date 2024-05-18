<x-layout title="Playlists">
    <h1>View Playlists</h1>
    <a href="{{route("playlist.create", absolute: false)}}">New Playlist</a>
    <ul>
        @foreach($playlists as $playlist)
            <li><a href="{{route("playlist.show", [$playlist], false)}}">{{$playlist->title}}</a></li>
        @endforeach
    </ul>
</x-layout>
