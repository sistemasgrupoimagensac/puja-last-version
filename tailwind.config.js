/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
  presets: [preset],
  content: [
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],
  // corePlugins: {
  //     preflight: false, // Evita que Tailwind sobreescriba estilos globales
  // },
  theme: {
    extend: {},
  },
  plugins: [],
}

