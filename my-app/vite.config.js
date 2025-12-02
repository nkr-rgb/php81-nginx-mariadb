import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        port: 5173,
        strictPort: true, //ポート使用中ならエラー吐き出す
        host: true,
        hmr: {
            host: 'localhost',
        },
    },
    css: {
        postcss: {
            plugins: [tailwindcss],
        },
    },
});
