import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/layout.css', 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
});
