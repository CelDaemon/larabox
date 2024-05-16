<x-layout name="Edit Playlist">
    <h1>Edit Playlist - {{$playlist->title}}</h1>
    <h2>Songs</h2>
    <ol>
        @foreach($songs as $song)
            <li>{{$song->title}}</li>
        @endforeach
    </ol>

    <form method="POST" action="{{route("playlist.destroy", [$playlist])}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" value="Delete">
    </form>
</x-layout>
