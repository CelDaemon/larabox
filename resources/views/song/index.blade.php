@use("App\Models\Song")
@use("Illuminate\Support\Collection")
@php
    /** @var Collection<Song> $songs */
@endphp
<x-layout title="List Songs">
    <style @nonce>
        selectable-item {
            user-select: none;
            cursor: pointer;
            &:state(selected) {
                color: dodgerblue;
            }
        }
    </style>

    <form action="/">
        <x-selectable-list keep="input[type=submit]">
            @foreach($songs as $song)
                <div><x-selectable-item name="{{$loop->index}}" value="{{$song->id}}">{{$song->title}}</x-selectable-item></div>
            @endforeach
        </x-selectable-list>
        <input type="submit">
    </form>
</x-layout>
