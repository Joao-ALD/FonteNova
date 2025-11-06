import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/quizz.css', 'resources/js/quizz.js'],
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
    },
});
