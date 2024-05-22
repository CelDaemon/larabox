@use("App\Models\Song")
@use("Illuminate\Support\Collection")
@php
    /** @var Collection<Song> $songs */
@endphp
<x-layout title="List Songs">
    <style @nonce>
        form {
            display: inline;
        }
    </style>
    <ul>
        @foreach($songs as $song)
            <li>{{$song->title}} - <form><input type="hidden" name="song" value="{{$song->id}}"><input type="submit" value="Add to playlist"></input></form></li>
        @endforeach
    </ul>
</x-layout>
