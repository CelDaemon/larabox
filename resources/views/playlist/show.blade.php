@php use App\Models\Playlist; @endphp
@php
    /** @var Playlist $playlist */
@endphp
<x-layout name="Edit Playlist">
    <h1>Edit Playlist - {{$playlist->title}}</h1>
    <h2>Songs</h2>
    <ol>
        @foreach($songs as $song)
            <li>{{$song->title}}</li>
        @endforeach
    </ol>
    @can("update", $playlist)
        <form method="POST" action="{{route("playlist.update", [$playlist])}}">
            @method("PATCH")
            <label for="title">Title: </label><input id="title" name="title" type="text"
                                                     value="{{old("title") ?? $playlist->title}}">
            <label for="public">Public: </label><input id="public" name="public"
                                                       type="checkbox" @checked($playlist->is_public)>
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
