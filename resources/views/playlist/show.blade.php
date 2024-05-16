<x-layout name="Edit Playlist">
    <h1>Edit Playlist - {{$playlist->title}}</h1>
    <h2>Songs</h2>
    <ol>
        @foreach($songs as $song)
            <li>{{$song->title}}</li>
        @endforeach
    </ol>

    @can('delete', $playlist)
        <form method="POST" action="{{route("playlist.destroy", [$playlist])}}">
            @method("DELETE")
            <input type="submit" value="Delete">
        </form>
    @endcan
</x-layout>
