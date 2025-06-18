@use('App\Models\Song')
@use('Carbon\Carbon')
@use('Illuminate\Support\Collection')
@php
    /** @var Collection<Song> $queue */
    /** @var int $total */
@endphp
<x-layout :title="__('Queue')">
    <h1>{{__('Queue')}}</h1>
    @if($queue->isEmpty())
        <p>{{__('Your queue is empty, go add some songs in')}} <a
                href="{{route('discovery')}}">{{__('Discovery')}}</a>{{__('!')}}</p>
    @else
        <p>{{__('Queue length:')}} {{Carbon::duration($total)}}</p>
        <form method="POST" action="{{route('queue.destroy')}}">
            @method('DELETE')
            <input type="submit" value="{{__('Remove from queue')}}">
            <ol>
                @foreach($queue as $song)
                    <li>
                        <input type="checkbox" name="songs[{{$loop->index}}]" value="{{$song->id}}">
                        <span>{{$song->title}}</span>
                        -
                        <span>{{Carbon::duration($song->duration)}}</span>
                    </li>
                @endforeach
            </ol>
        </form>
    @endempty
</x-layout>
