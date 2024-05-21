@use("App\Models\Song")
@use("Illuminate\Support\Collection")
@php
    /** @var Collection<Song> $songs */
@endphp
<x-layout title="List Songs">
    <ul>
        @foreach($songs as $song)
            <li>{{$song->title}}</li>
        @endforeach
    </ul>
</x-layout>
