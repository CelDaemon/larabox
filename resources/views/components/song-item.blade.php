@use("App\Models\Song")
@php
    /** @var numeric $index */
    /** @var Song $song */
@endphp
<app-song-item>

    <template shadowrootmode="open">
        @vite("resources/css/components/song-item.css")
        <div>
            {{$index + 1}}.
        </div>
        <div>
            <span>{{$song->title}}</span>
        </div>
        <div>
            <span>@foreach($song->artists as $artist)<span>@if(!$loop->first), @endif{{$artist->name}}</span>@endforeach</span>
        </div>
        <div>
            {{$song->duration_string}}
        </div>
    </template>
</app-song-item>
