<x-layout title="Create Playlist">
    <h1>Create Playlist</h1>
    <form method="POST" action="{{route("playlist.store", absolute: false)}}">
        <label for="title">Title: </label><input id="title" name="title" type="text" required value="{{old("title")}}">
        <input type="submit">
    </form>
</x-layout>
