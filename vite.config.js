import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/modules/reviews.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/modules/reviews.js'
            ],
            refresh: true,
        }),
    ],
});
