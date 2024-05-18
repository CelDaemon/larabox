@use("Illuminate\Support\Collection")
@use("App\Models\Playlist")
@use("App\Models\Song")

@php
    /** @var Playlist $playlist */
    /** @var Collection<Song> $songs */
@endphp
<x-layout title="{{$playlist->title}}">
    <h1>Edit Playlist - {{$playlist->title}}</h1>
    <h2>Songs</h2>
    <ol>
        @foreach($songs as $song)
            <li>{{$song->title}} - {{$song->duration_string}}
                @if($song->artists->isNotEmpty())
                     -
                    @foreach($song->artists as $artist){{$loop->first ? '' : ', '}}<span>{{$artist->name}}</span>@endforeach
                @endisset
            </li>
        @endforeach
    </ol>
    @can("update", $playlist)
        <form method="POST" action="{{route("playlist.update", [$playlist])}}">
            @method("PATCH")
            <div>
                <label for="title">Title: </label><input id="title" name="title" type="text"
                                                         value="{{old("title") ?? $playlist->title}}">
            </div>
            <div>
                <label for="public">Public: </label><input id="public" name="public"
                                                           type="checkbox" @checked($playlist->is_public)>
            </div>
            <input type="submit" value="Update">
        </form>
    @endcan
    @can('delete', $playlist)
        <form method="POST" action="{{route("playlist.destroy", [$playlist])}}">
            @method("DELETE")
            <input type="submit" value="Delete">
        </form>
    @endcan
</x-layout>
