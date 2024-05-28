@use("App\Models\Song")
@use("Illuminate\Support\Collection")
@php
    /** @var Collection<Song> $songs */
@endphp
<x-layout title="List Songs">
    @vite("resources/css/components/song-list.css")
    <form action="/">
        <app-song-list tabindex="0">
            @foreach($songs as $song)
                <x-song-item data-value="{{$song->id}}"></x-song-item>
            @endforeach
        </app-song-list>
        <input type="submit">
    </form>
</x-layout>
