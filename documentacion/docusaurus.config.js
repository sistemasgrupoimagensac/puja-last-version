// @ts-check
// `@type` JSDoc annotations allow editor autocompletion and type checking
// (when paired with `@ts-check`).
// There are various equivalent ways to declare your Docusaurus config.
// See: https://docusaurus.io/docs/api/docusaurus-config

import { themes as prismThemes } from 'prism-react-renderer';

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'Puja Inmobiliaria',
  favicon: 'img/favicon.png',

  // Set the production url of your site here
  url: 'http://test.com', // Usar variable de entorno o valor predeterminado

  // Set the /<baseUrl>/ pathname under which your site is served
  baseUrl: '/documentacion/',

  // GitHub pages deployment config.
  organizationName: 'Grupo Imagen S.A.C.', // Usually your GitHub org/user name.
  projectName: 'Puja Inmobiliaria', // Usually your repo name.

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  i18n: {
    defaultLocale: 'es',
    locales: ['es'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      {
        docs: {
          sidebarPath: './sidebars.js',
        },
        blog: false, // Desactiva el blog completamente
        theme: {
          customCss: './src/css/custom.css',
        },
      },
    ],
  ],

  themeConfig:
  /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
  {
    colorMode: {
      defaultMode: 'light', // Establece el tema luminoso como predeterminado
      disableSwitch: false, // Habilita el cambio de tema (si deseas permitirlo)
      respectPrefersColorScheme: false, // Ignora las preferencias del sistema del usuario
    },
    docs: {
      sidebar: {
        autoCollapseCategories: true, // Habilita el colapso automático
        hideable: true, // Permite ocultar el sidebar
      },
    },
    navbar: {
      title: 'Puja Inmobiliaria',
      logo: {
        alt: 'Logo de Puja Inmobiliaria',
        src: 'img/favicon.png',
        href: 'https://www.pujainmobiliaria.com.pe',
      },
      items: [],
    },
    footer: {
      style: 'dark',
      links: [
        {
          title: 'Blog',
          items: [
            {
              label: 'link',
              href: 'https://pujainmobiliaria.com.pe/blog',
            },
          ],
        },
        {
          title: 'Redes',
          items: [
            {
              label: 'Facebook',
              href: 'https://www.facebook.com/pujainmobiliaria',
            },
            {
              label: 'Instagram',
              href: 'https://www.instagram.com/pujainmobiliaria/',
            },
          ],
        },
      ],
      copyright: `Copyright © ${new Date().getFullYear()} Puja Inmobiliaria`,
    },
    prism: {
      theme: prismThemes.github,
      darkTheme: prismThemes.dracula,
    },
  },

};

export default config;