import glob from "fast-glob";
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [...glob.sync("resources/css/components/**/*.css"), 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
    build: {
        target: "ESNext"
    },
});
