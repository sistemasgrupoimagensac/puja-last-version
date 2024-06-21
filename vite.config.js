import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //sass
                'resources/sass/app.scss',
                // sass - pages
                'resources/sass/pages/inmueble.scss',
                'resources/sass/pages/publica-inmueble.scss',
                'resources/sass/pages/recover-password.scss',
                'resources/sass/pages/register.scss',
                'resources/sass/pages/signin.scss',
                // sass - components
                'resources/sass/components/whatsapp_modal_contact.scss',
                'resources/sass/components/whatsapp_modal_inmueble_contact.scss',
                'resources/sass/components/menu_panel.scss',

                // js
                'resources/js/app.js',
                // js - scripts
                'resources/js/scripts/home.js',
                'resources/js/scripts/inmueble.js',
                'resources/js/scripts/inmuebles.js',
                'resources/js/scripts/register.js',
                // js - scripts - components
                'resources/js/scripts/components/back_button.js',
                'resources/js/scripts/components/card_simple.js',
                'resources/js/scripts/components/whatsapp_modal_contact.js',
                'resources/js/scripts/components/whatsapp_modal_inmueble_contact.js',

            ],
            refresh: true,
        }),
    ],
});
