@use(Illuminate\Support\Facades\App)
<!DOCTYPE html>
<html>
<head lang="{{ str_replace('_', '-', App::getLocale()) }}">
    <meta id="boo" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@isset($title){{$title}} - @endisset{{ config('app.name') }}</title>
    @vite(["resources/css/components/layout.css", "resources/ts/app.ts"])
    <link media="(prefers-color-scheme: light)" rel="icon" href="{{asset("/favicon-light.svg")}}">
    <link media="(prefers-color-scheme: dark)" rel="icon" href="{{asset("/favicon-dark.svg")}}">
    <meta property="og:title" content="@isset($title){{$title}} - @endisset{{config('app.name')}}">
    <meta property="og:image" content="{{asset("/social-icon.png")}}">
</head>
<body>
<template shadowrootmode="open">
    <app-context-menu>
        <template shadowrootmode="open">
            @vite("resources/css/components/context-menu.css")
            <div></div>
        </template>
    </app-context-menu>
    {{$slot}}
</template>
</body>
</html>
