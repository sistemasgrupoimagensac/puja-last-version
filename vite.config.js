import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        //sass
        "resources/sass/app.scss",
        // sass - pages
        'resources/sass/pages/inmueble.scss',
        'resources/sass/pages/publica-inmueble.scss',
        'resources/sass/pages/recover-password.scss',
        'resources/sass/pages/register.scss',
        'resources/sass/pages/signin.scss',
        'resources/sass/pages/crear-aviso.scss',
        'resources/sass/pages/perfil.scss',
        'resources/sass/pages/planes.scss',
        'resources/sass/pages/terminos.scss',
        'resources/sass/pages/landing-projects.scss',
        // sass - components
        "resources/sass/components/whatsapp_modal_contact.scss",
        "resources/sass/components/whatsapp_modal_inmueble_contact.scss",
        "resources/sass/components/menu_panel.scss",
        "resources/sass/components/footer.scss",
        "resources/sass/components/card_plan.scss",
        "resources/sass/components/card-plan-propietario.scss",
        // CSS
        "resources/css/app.css",

        // js
        "resources/js/app.js",
        "resources/js/profile-user.js",
        // js - scripts
        'resources/js/scripts/home.js',
        'resources/js/scripts/inmueble.js',
        'resources/js/scripts/inmuebles.js',
        'resources/js/scripts/register.js',
        'resources/js/scripts/updatePlaceholdersRegister.js',
        'resources/js/scripts/perfil.js',
        'resources/js/scripts/planes.js',
        // js - scripts - components
        "resources/js/scripts/components/back_button.js",
        "resources/js/scripts/components/card_simple.js",
        "resources/js/scripts/components/whatsapp_modal_contact.js",
        "resources/js/scripts/components/whatsapp_modal_inmueble_contact.js",
        "resources/js/scripts/components/footer.js",
        "resources/js/scripts/components/puja_modal_contact.js",

      ],
      refresh: true,
    }),
  ],
});