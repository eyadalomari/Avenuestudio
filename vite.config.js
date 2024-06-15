import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                'resources/assets/css/styles.min.css',
                'resources/assets/libs/jquery/dist/jquery.min.js',
                'resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
                'resources/assets/js/sidebarmenu.js',
                'resources/assets/js/app.min.js',
                'resources/assets/libs/simplebar/dist/simplebar.js',
                'resources/assets/js/dashboard.js',
            ],
            refresh: true,
        }),
    ],
});
