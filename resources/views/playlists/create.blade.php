<x-layout :title="__('Create Playlist')">
    <h1>{{__('Create Playlist')}}</h1>
    <form method="POST" action="{{route('playlists.store')}}" novalidate>
        <x-input :label="__('Title')" name="title" maxlength="255"/>
        <x-select :label="__('Visibility')" name="is_public" :options="[false => 'Private', true => 'Public']"/>
        <input type="submit" value="{{__('Create')}}">
    </form>
</x-layout>
