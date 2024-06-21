@use('App\Models\Playlist')
@use('Illuminate\Support\Collection')
@php
    /** @var Collection<Playlist> $playlists */
@endphp
<x-layout :title="__('Playlists')">
    <h1>{{__('Playlists')}}</h1>
    <a href="{{route('playlists.create')}}">{{__('Create playlist')}}</a>
    <ul>
        @foreach($playlists as $playlist)
            <li><a href="{{route('playlists.show', ['playlist' => $playlist])}}">{{$playlist->title}}</a></li>
        @endforeach
    </ul>
    <a href="{{route('home')}}">{{__('Back')}}</a>
</x-layout>
