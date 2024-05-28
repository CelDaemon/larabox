import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from "fs/promises";
import path from "path";

const css: string[] = [];
for await(const file of await fs.opendir("resources/css", {recursive: true})) {
    if(!file.isFile()) continue;
    css.push(`@@/${path.relative("resources/css", `${file.parentPath}/${file.name}`)}`);
}

export default defineConfig(({mode}) => {console.log(mode); return {
    plugins: [
        laravel({
            input: ["@/app.ts", ...css],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': 'resources/ts',
            '@@': 'resources/css'
        }
    },
    build: {
        cssCodeSplit: true,
        minify: mode === "production",
        target: "ESNext",
        sourcemap: mode !== "production"
    }
}});
