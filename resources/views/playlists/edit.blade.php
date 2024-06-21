@use('App\Models\Playlist')
@php /** @var Playlist $playlist */ @endphp
<x-layout :title="__('Edit :title', ['title' => $playlist->title])">
    <h1>{{__('Edit :title', ['title' => $playlist->title])}}</h1>
    <form method="POST" action="{{route('playlists.update', ['playlist' => $playlist])}}">
        @method("PUT")
        <x-input :label="__('Title')" name="title" type="text" maxlength="255" :value="$playlist->title"/>
        <x-select :label="__('Visibility')" name="is_public" :options="[false => 'Private', true => 'Public']" :value="$playlist->is_public"/>
        <input type="submit" value="{{__('Save')}}">
        <div>{{session('status')}}</div>
    </form>
    <h2>{{__('Delete Playlist')}}</h2>
    <form method="POST" action="{{route('playlists.destroy', ['playlist' => $playlist])}}">
        @method("DELETE")
        <input type="submit" value="{{__('Delete')}}">
    </form>
    <a href="{{route('playlists.show', ['playlist' => $playlist])}}">{{__('Back')}}</a>
</x-layout>
