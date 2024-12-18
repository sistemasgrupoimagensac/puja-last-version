// @ts-check

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

const sidebars = {
  documentationSidebar: [
    'intro', // Página de introducción
    {
      type: 'category',
      label: 'Documentos Funcionales',
      items: [
        'funcional/DF_Registro_Usuario',
        'funcional/DF_Registro_Usuario_Google',
        'funcional/DF_Iniciar_Sesion',
        'funcional/DF_Iniciar_Sesion_Google',
        'funcional/DF_Publicar_Inmueble_Propietario',
        'funcional/DF_Publicar_Inmueble_Corredor',
        'funcional/DF_Publicar_Inmueble_Acreedor',
        'funcional/DF_Publicar_Proyecto_Inmobiliario',
        'funcional/DF_Crear_Usuario_Proyecto_Inmobiliario',
        'funcional/DF_Pago_Propietario_Corredor_Acreedor',
        'funcional/DF_Pago_Proyecto_Inmobiliario',
        'funcional/DF_Manejo_Leads_Proyecto',
        'funcional/DF_Agregar_GoogleSheet_Proyecto',
      ],
    },
    {
      type: 'category',
      label: 'Documentos Técnicos',
      items: [
        'tecnica/DT_Registro_Usuario',
        'tecnica/DT_Registro_Usuario_Google',
        'tecnica/DT_Iniciar_Sesion',
        'tecnica/DT_Iniciar_Sesion_Google',
        'tecnica/DT_Publicar_Inmueble_Propietario',
        'tecnica/DT_Publicar_Inmueble_Corredor',
        'tecnica/DT_Publicar_Inmueble_Acreedor',
        'tecnica/DT_Publicar_Proyecto_Inmobiliario',
        'tecnica/DT_Crear_Usuario_Proyecto_Inmobiliario',
        'tecnica/DT_Pago_Propietario_Corredor_Acreedor',
        'tecnica/DT_Pago_Proyecto_Inmobiliario',
        'tecnica/DT_Manejo_Leads_Proyecto',
        'tecnica/DT_Agregar_GoogleSheet_Proyecto',
      ],
    },
    {
      type: 'category',
      label: 'Manual de Usuario',
      items: [
        'usuario/MU_Registro_Usuario',
        'usuario/MU_Publicar_Inmueble_Propietario',
        'usuario/MU_Publicar_Proyecto_Inmobiliario',
        'usuario/MU_Publicar_Inmueble_Acreedor',
        'usuario/MU_Publicar_Post_Blog',
      ],
    },
  ],
};

export default sidebars;
