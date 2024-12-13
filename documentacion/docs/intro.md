---
sidebar_label: 'Introducción'
sidebar_position: 1
title: 'Introducción'
---

# Documentación del Sistema **Puja Inmobiliaria**

Bienvenido a la documentación oficial del sistema **Puja Inmobiliaria**, una herramienta diseñada para simplificar la publicación, gestión y adquisición de inmuebles en diversas modalidades: remates públicos, venta, alquiler, y proyectos inmobiliarios.

---

## 1. Propósito
La documentación tiene como objetivo proporcionar una guía integral para:
- Desarrolladores interesados en mantener o extender el sistema.
- Usuarios que deseen entender los flujos y funcionalidades principales.
- Stakeholders que busquen evaluar el alcance y capacidades del sistema.

---

## 2. Estructura de la Documentación

### Funcional
Este apartado detalla los flujos y requerimientos de cada funcionalidad clave del sistema. Está dirigido a analistas, diseñadores y desarrolladores interesados en comprender los procesos desde una perspectiva funcional.

### Técnica
Aquí se documentan los aspectos técnicos de implementación, incluyendo modelos, controladores, rutas y vistas. Este apartado está orientado a desarrolladores que buscan trabajar con el código fuente o integrar nuevas funcionalidades.

### Guía del Usuario
Una sección dedicada a los usuarios finales, con instrucciones claras para navegar y utilizar el sistema de manera efectiva.

---

## 3. Módulos Principales
1. **Registro y Autenticación:**  
   Manejo del registro de usuarios y la autenticación mediante correo/contraseña o Google.
2. **Publicación de Inmuebles:**  
   Proceso de registro de inmuebles para propietarios, corredores y acreedores, así como proyectos completos.
3. **Gestión de Pagos:**  
   Integración con OpenPay para pagos de planes y proyectos.
4. **Gestión de Proyectos:**  
   Herramientas avanzadas como integración con Google Sheets y manejo de leads.

---

## 4. Flujos Principales
1. Registro y autenticación de usuarios.
2. Publicación y gestión de inmuebles.
3. Pagos mediante OpenPay.
4. Gestión de proyectos inmobiliarios y leads.

---

## 5. Alcance del Sistema
- **Incluye:**
  - Gestión de remates, ventas, alquileres y proyectos inmobiliarios.
  - Contacto directo entre interesados y propietarios.
  - Procesamiento de pagos y generación de comprobantes electrónicos.
- **Excluye:**
  - Venta directa de inmuebles.
  - Gestión completa de transacciones financieras fuera de OpenPay.

---

## 6. Índice de la Documentación

### Documentos Funcionales
- **Registro y Autenticación**
  - [Registro de Usuario](funcional/DF_Registro_Usuario.md)
  - [Registro con Google](funcional/DF_Registro_Usuario_Google.md)
  - [Inicio de Sesión](funcional/DF_Iniciar_Sesion.md)
  - [Inicio de Sesión con Google](funcional/DF_Iniciar_Sesion_Google.md)
- **Publicación de Inmuebles**
  - [Propietario](funcional/DF_Publicar_Inmueble_Propietario.md)
  - [Corredor](funcional/DF_Publicar_Inmueble_Corredor.md)
  - [Acreedor](funcional/DF_Publicar_Inmueble_Acreedor.md)
  - [Proyectos Inmobiliarios](funcional/DF_Publicar_Proyecto_Inmobiliario.md)
  - [Crear Usuario Proyecto Inmobiliario](funcional/DF_Crear_Usuario_Proyecto_Inmobiliario.md)
- **Pagos**
  - [Planes](funcional/DF_Pago_Propietario_Corredor_Acreedor.md)
  - [Proyectos](funcional/DF_Pago_Proyecto_Inmobiliario.md)
- **Gestión de Proyectos**
  - [Manejo de Leads](funcional/DF_Manejo_Leads_Proyecto.md)
  - [Google Sheets](funcional/DF_Agregar_GoogleSheet_Proyecto.md)

### Documentos Técnicos
- **Registro y Autenticación**
  - [Registro de Usuario](tecnica/DT_Registro_Usuario.md)
  - [Registro con Google](tecnica/DT_Registro_Usuario_Google.md)
  - [Inicio de Sesión](tecnica/DT_Iniciar_Sesion.md)
  - [Inicio de Sesión con Google](tecnica/DT_Iniciar_Sesion_Google.md)
- **Publicación de Inmuebles**
  - [Propietario](tecnica/DT_Publicar_Inmueble_Propietario.md)
  - [Corredor](tecnica/DT_Publicar_Inmueble_Corredor.md)
  - [Acreedor](tecnica/DT_Publicar_Inmueble_Acreedor.md)
  - [Proyectos Inmobiliarios](tecnica/DT_Publicar_Proyecto_Inmobiliario.md)
  - [Crear Usuario Proyecto Inmobiliario](tecnica/DT_Crear_Usuario_Proyecto_Inmobiliario.md)
- **Pagos**
  - [Planes](tecnica/DT_Pago_Propietario_Corredor_Acreedor.md)
  - [Proyectos](tecnica/DT_Pago_Proyecto_Inmobiliario.md)
- **Gestión de Proyectos**
  - [Manejo de Leads](tecnica/DT_Manejo_Leads_Proyecto.md)
  - [Google Sheets](tecnica/DT_Agregar_GoogleSheet_Proyecto.md)

### Manual de Usuario
- [Registro de Usuario](usuario/MU_Registro_Usuario.md)
- [Publicación de Inmuebles](usuario/MU_Publicar_Inmueble_Propietario.md)
- [Pagos de Proyectos](usuario/MU_Publicar_Proyecto_Inmobiliario.md)

---

Esperamos que esta documentación sea una herramienta útil para entender y utilizar **Puja Inmobiliaria** de manera eficiente.
