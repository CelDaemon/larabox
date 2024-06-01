@use("Illuminate\View\ComponentSlot")
@php
/** @var ?string $title */
/** @var ComponentSlot $slot */
/** @var array $resources */
@endphp
<!DOCTYPE html>
<html>
<head lang="en">
    <title>@if($title !== null){{$title}} - @endif{{config("app.name")}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(["resources/ts/app.ts", "resources/css/components/layout.css"])
</head>
<body>
{{$slot}}
</body>
</html>
