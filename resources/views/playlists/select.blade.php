@use('App\Models\Playlist')
@use('Illuminate\Support\Collection')
@php
    /** @var Collection<Playlist> $playlists */
@endphp
<x-layout :title="__('Select Playlist')">
    <h1>{{__('Select Playlist')}}</h1>
    <ul>
        @foreach($playlists as $playlist)
            <li>
                {{$playlist->title}}
                <form class="inline-form" method="POST" action="{{route('playlists.add', ['playlist' => $playlist])}}">
                    <input type="submit" value="{{__('Select')}}">
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
