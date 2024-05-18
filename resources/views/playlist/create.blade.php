<x-layout title="Create Playlist">
    <h1>Create Playlist</h1>
    <form method="POST" action="{{route("playlist.store", absolute: false)}}">
        <label for="title">Title: </label><input id="title" name="title" type="text" value="{{old("title")}}">
        @error("title")
        <span>{{$message}}</span>
        @enderror
        <input type="submit">
    </form>
</x-layout>
