@use('App\Models\Song')
@use('Illuminate\Support\Collection')
@php
    /** @var Collection<Song> $songs */
@endphp
<x-layout :title="__('Songs')">
    <h1>{{__('Songs')}}</h1>
    <form method="POST" action="{{route('playlists.prepare')}}">
        <input type="submit" value="{{__('Add to playlist')}}">
        <ul>
            @foreach($songs as $song)
                <li>
                    <input type="checkbox" name="songs[{{$loop->index}}]" value="{{$song->id}}">
                    <span>{{$song->title}}</span>
                </li>
            @endforeach
        </ul>
    </form>
</x-layout>
