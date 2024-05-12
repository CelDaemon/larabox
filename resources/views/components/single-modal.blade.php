<main-card>
    <template shadowrootmode="open">
        <link rel="stylesheet" href="/css/components/single-modal.css">
        <main>
            <header>
                <h1 id="title">{{$title}}</h1>
                <h2 id="subtitle">{{$subtitle}}</h2>
            </header>
            <hr>
            <slot></slot>
        </main>
    </template>
    {{$slot}}
</main-card>
