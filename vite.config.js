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
        'resources/sass/pages/contacto.scss',
        'resources/sass/pages/blog.scss',
        'resources/sass/pages/post.scss',
        'resources/sass/pages/404.scss',
        // sass - components
        "resources/sass/components/menu_panel.scss",
        "resources/sass/components/footer.scss",
        "resources/sass/components/card_plan.scss",
        "resources/sass/components/card-plan-propietario.scss",

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
        'resources/js/scripts/toastyContact.js',
        'resources/js/scripts/toastyPaySuccess.js',
        'resources/js/scripts/toastyPayError.js',
        'resources/js/scripts/toastyImagenPrincipalError.js',
        'resources/js/scripts/contacto.js',
        // js - scripts - components
        "resources/js/scripts/components/back_button.js",
        "resources/js/scripts/components/card_simple.js",
        "resources/js/scripts/components/footer.js",
        "resources/js/scripts/components/mis_avisos.js",

      ],
      refresh: true,
    }),
  ],
});