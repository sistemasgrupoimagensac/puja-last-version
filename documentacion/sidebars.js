// @ts-check

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.

 @type {import('@docusaurus/plugin-content-docs').SidebarsConfig}
 */
 const sidebars = {
  documentationSidebar: [
    'intro', // Página de introducción
    {
      type: 'category',
      label: 'Documentos Funcionales',
      items: [
        {
          type: 'category',
          label: 'Casos de Uso',
          items: [
            'funcional/casos_de_uso/CU_iniciar_sesion_google', // Caso de uso específico
          ],
        },
        'funcional/DF_001_registrar_usuario',
        'funcional/DF_002_publicar_inmueble_propietario',
        'funcional/DF_003_publicar_inmueble_acreedor',
        'funcional/DF_004_publicar_inmueble_corredor',
        'funcional/DF_005_01_crear_usuario_proyecto',
        'funcional/DF_005_publicar_proyecto',
        'funcional/DF_iniciar_sesion',
        'funcional/DF_iniciar_sesion_google',
        'funcional/DF_panel_administrador',
      ],
    },
    {
      type: 'category',
      label: 'Documentos Técnicos',
      items: [
        'tecnica/DT_001_registrar_usuario',
        'tecnica/DT_002_publicar_inmueble_propietario',
        'tecnica/DT_003_publicar_inmueble_acreedor',
        'tecnica/DT_004_publicar_inmueble_corredor',
        'tecnica/DT_005_01_crear_usuario_proyecto',
        'tecnica/DT_005_publicar_proyecto',
      ],
    },
    {
      type: 'category',
      label: 'Manual de Usuario',
      items: [
        'usuario/MU_registrar_usuario', 
        'usuario/MU_publicar_proyecto_inmobiliario',
        'usuario/MU_publicar_inmueble_propietario',
      ],
    },
  ],
};

export default sidebars;
