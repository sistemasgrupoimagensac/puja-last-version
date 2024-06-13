import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //sass
                'resources/sass/app.scss',
                'resources/sass/pages/inmueble.scss',
                'resources/sass/pages/publica-inmueble.scss',
                'resources/sass/pages/signin.scss',
                // js
                'resources/js/app.js',
                'resources/js/scripts/inmuebles.js',
                'resources/js/scripts/home.js',
                'resources/js/scripts/components/card_simple.js',
                'resources/js/scripts/inmueble.js',
            ],
            refresh: true,
        }),
    ],
});
