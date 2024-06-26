@use('App\Models\Playlist')
@php /** @var Playlist $playlist */ @endphp
<x-layout :title="$playlist->title">
    <h1>{{$playlist->title}}</h1>
    @can('update', $playlist)
        <a href="{{route('playlists.edit', ['playlist' => $playlist])}}">{{__('Edit')}}</a>
    @endcan
    <ol>
        @foreach($playlist->songs as $song)
            <li>
                <span>{{$song->title}}</span>
                <form class="inline-form" method="POST" action="{{route('playlists.remove', ['playlist' => $playlist, 'song' => $song])}}">
                    @method("DELETE")
                    <input type="submit" value="{{__('Remove')}}">
                </form>
            </li>
        @endforeach
    </ol>
</x-layout>
