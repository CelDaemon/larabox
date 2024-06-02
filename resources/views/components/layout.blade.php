@use("Illuminate\View\ComponentSlot")
@props(["title"])
@php
/** @var ?string $title */
/** @var ComponentSlot $slot */
/** @var array $resources */
@endphp
<!DOCTYPE html>
<html>
<head lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{$title}}</title>
    @vite(["resources/ts/app.ts", "resources/css/components/layout.css"])
</head>
<body>
<lb-router>
    @fragment("content")
        {{$slot}}
    @endfragment
</lb-router>
</body>
</html>
