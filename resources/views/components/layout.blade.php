@use(Illuminate\Support\Facades\App)
<!DOCTYPE html>
<html>
<head lang="{{ str_replace('_', '-', App::getLocale()) }}">
    <meta id="boo" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-size=1">
    <title>@isset($title){{$title}} - @endisset{{ config('app.name') }}</title>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<template shadowrootmode="open">
    {{$slot}}
</template>
</body>
</html>
