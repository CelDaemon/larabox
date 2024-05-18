@use(Illuminate\Support\Facades\App)
<!DOCTYPE html>
<html>
<head lang="{{ str_replace('_', '-', App::getLocale()) }}">
    <meta id="boo" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@isset($title){{$title}} - @endisset{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/layout.css">
    <link media="(prefers-color-scheme: light)" rel="icon" href="/favicon-light.svg">
    <link media="(prefers-color-scheme: dark)" rel="icon" href="/favicon-dark.svg">
    <meta property="og:title" content="@isset($title){{$title}} - @endisset{{config('app.name')}}">
    <meta property="og:image" content="{{asset("/social-icon.png")}}">
</head>
<body>
<template shadowrootmode="open">
    {{$slot}}
</template>
</body>
</html>
