import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: false, // set this to false to prevent reloads every time app.js/app.css changes. you have to do it manually.
            // but i maybe wrong.
        }),
    ],
});
