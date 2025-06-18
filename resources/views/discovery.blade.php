@use('Illuminate\Support\Collection')
@use('App\Models\Song')
@use('Carbon\Carbon')
@php
    /** @var Collection<Song> $songs */
    /** @var array<string, true> $queue */
@endphp
<x-layout :title="__('Discovery')">
    <h1>{{__('Discovery')}}</h1>
    <form method="POST">
        <input type="submit" formaction="{{route('queue.store')}}" value="{{__('Add to queue')}}">
        <ul>
            @foreach($songs as $song)
                <li>
                    <input type="checkbox" name="songs[{{$loop->index}}]" value="{{$song->id}}">
                    <span>{{$song->title}}</span>
                    -
                    <span>{{Carbon::duration($song->duration)}}</span>
                </li>
            @endforeach
        </ul>
    </form>
</x-layout>
