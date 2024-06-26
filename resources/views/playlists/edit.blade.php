@use('App\Models\Playlist')
@php /** @var Playlist $playlist */ @endphp
<x-layout :title="__('Edit :title', ['title' => $playlist->title])">
    <h1>{{__('Edit :title', ['title' => $playlist->title])}}</h1>
    <form method="POST" action="{{route('playlists.update', ['playlist' => $playlist])}}">
        @method("PUT")
        <x-input :label="__('Title')" name="title" maxlength="255" :value="$playlist->title"/>
        <x-select :label="__('Visibility')" name="is_public" :options="[false => 'Private', true => 'Public']" :value="$playlist->is_public"/>
        <input type="submit" value="{{__('Save')}}">
        <div>{{session('status')}}</div>
    </form>
    <h2>{{__('Delete Playlist')}}</h2>
    <button is="dialog-button" data-for="delete">{{__('Delete')}}</button>
    <dialog id="delete">
        <h2>{{__('Are you sure?')}}</h2>
        <h4>{{__('Be warned, this playlist cannot be recovered!')}}</h4>
        <form method="POST" action="{{route('playlists.destroy', ['playlist' => $playlist])}}">
            @method("DELETE")
            <input type="submit" value="{{__('Delete')}}">
            <input autofocus type="submit" formmethod="dialog" value="{{__('Cancel')}}">
        </form>
    </dialog>
</x-layout>
