@use('App\Models\Playlist')
@php /** @var Playlist $playlist */ @endphp
<x-layout :title="$playlist->title">
    <h1>{{$playlist->title}}</h1>
    <a href="{{route('playlists.index')}}">{{__('Back')}}</a>
    <a href="{{route('playlists.edit', ['playlist' => $playlist])}}">{{__('Edit')}}</a>
</x-layout>
