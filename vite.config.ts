import glob from "fast-glob";
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// noinspection JSUnusedGlobalSymbols
export default defineConfig({
    plugins: [
        laravel({
            input: [...glob.sync([ "!resources/css/include/**/*.css","resources/**/*.{css,svg}"]), 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
    build: {
        target: "ESNext"
    },
});
