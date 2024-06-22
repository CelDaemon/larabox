@use('App\Models\Playlist')
@php /** @var Playlist $playlist */ @endphp
<x-layout :title="$playlist->title">
    <h1>{{$playlist->title}}</h1>
    @can('update', $playlist)
        <a href="{{route('playlists.edit', ['playlist' => $playlist])}}">{{__('Edit')}}</a>
    @endcan
</x-layout>
