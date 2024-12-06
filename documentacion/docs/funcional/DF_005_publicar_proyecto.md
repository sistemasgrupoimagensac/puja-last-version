---
sidebar_label: 'Publicar Proyecto Inmobiliario'
sidebar_position: 7
title: 'Publicar Proyecto Inmobiliario'
---

# Documento Funcional: Publicar Proyecto Inmobiliario

## 1. Resumen
**Descripción:** Este documento describe el proceso que permite a los usuarios con perfil de tipo *proyecto* publicar y gestionar proyectos inmobiliarios en **Puja Inmobiliaria**.

**Propósito:** Proveer a los proyectos inmobiliarios visibilidad en la plataforma, facilitando su gestión mediante una interfaz minimalista, intuitiva y flexible que permita modificaciones frecuentes.

---

## 2. Requerimiento Funcional
**ID:** `RF005`
**Nombre del Requisito:** Publicar Proyecto Inmobiliario  
**Descripción:** Los usuarios que contraten la publicación de un proyecto inmobiliario podrán gestionar los detalles del proyecto, incluyendo unidades, imágenes y datos relevantes, utilizando una interfaz sencilla y accesible.

**Reglas de Negocio:**  
1. El nombre del proyecto es obligatorio.  
2. La cantidad de unidades es obligatoria.  
3. El banco financiador es obligatorio.  
4. El progreso del proyecto es obligatorio.  
5. Todos los campos de una unidad son obligatorios, excepto el precio en dólares.  

---

## 3. Flujo
#### Proceso General
1. El usuario inicia sesión con un perfil de tipo *proyecto*.  
2. Da clic en el botón **Publica Aquí**.  
3. Ingresa el **nombre del proyecto**.  
4. Completa el campo **descripción**.  
5. Ingresa la **cantidad de unidades**.  
6. Selecciona el **banco financiador**.  
7. Selecciona el **progreso del proyecto**.  
8. Indica la **fecha de entrega**.  
9. Completa los campos de **ubicación**.  
10. Da clic en el botón **Guardar Parcialmente**.  

#### Gestión de Imágenes del Proyecto
11. Solo después de guardar parcialmente el proyecto, puede gestionar imágenes.  
12. Presiona el botón **Subir Imágenes del Proyecto**.  
13. Arrastra o selecciona las imágenes deseadas.  
14. Da clic en el botón **Subir / Actualizar Imágenes**.

#### Gestión de Unidades
15. Presiona el botón **+ Agregar Unidad**.  
16. Completa el formulario de la unidad.  
17. Guarda la unidad presionando el botón **Guardar Unidad**.

#### Gestión de Imágenes de las Unidades
18. Guarda el proyecto nuevamente presionando **Guardar Parcialmente**.  
19. Una vez guardadas las unidades, se habilitará el botón **Subir Plano** para cada unidad.  
20. Presiona el botón **Subir Plano**.  
21. Arrastra o selecciona el plano de la unidad.  
22. Guarda la imagen presionando **Guardar Plano**.

#### Selección de Imagen Principal
23. Presiona el botón **Subir Imágenes del Proyecto**.  
24. Selecciona la imagen principal utilizando el checkbox correspondiente.  
25. Confirma la selección en el cuadro de diálogo.  
26. Presiona **Guardar y Salir** para finalizar y publicar el proyecto.

---

## 4. Artefactos Técnicos Relacionados
| **Artefacto Técnico**                   | **Descripción**                                                                 |
|-----------------------------------------|---------------------------------------------------------------------------------|
| Blade: `proyectos.create`               | Vista principal para la creación y edición de proyectos inmobiliarios.         |
| Controlador: `ProyectoController`       | Lógica para gestionar proyectos, incluyendo creación, actualización y borrado. |
| Controlador: `ProyectoImagenController` | Gestión de imágenes relacionadas al proyecto.                                  |
| Controlador: `ProyectoImagenUnidadController` | Gestión de imágenes específicas de las unidades del proyecto.               |
| Modelo: `Proyecto`                      | Modelo que representa los proyectos inmobiliarios en la base de datos.         |
| Modelo: `ProyectoUnidades`              | Modelo que representa las unidades de un proyecto.                             |
| Modelo: `ProyectoImagenesAdicionales`   | Modelo para gestionar las imágenes adicionales de un proyecto.                 |
| Modelo: `ProyectoImagenesUnidades`      | Modelo para gestionar las imágenes relacionadas a las unidades.                |
| JS: `create_project.js`                 | Script para la lógica interactiva en la gestión de proyectos.                  |
| JS: `project_upload_image.js`           | Script para la gestión de imágenes del proyecto.                               |
| JS: `upload_unit_image.js`              | Script para la gestión de imágenes de las unidades.                            |
| Migración: `create_proyectos_table`     | Migración para la creación de la tabla `proyectos`.                            |
| Migración: `create_proyecto_unidades_table` | Migración para la tabla de unidades del proyecto.                           |
| Migración: `create_proyecto_imagenes_adicionales_table` | Migración para la tabla de imágenes del proyecto.                 |
| Migración: `create_proyecto_imagenes_unidades_table` | Migración para la tabla de imágenes de las unidades.                      |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**  | **Cambios Realizados**        | **Autor**       |
|-------------|------------|-------------------------------|-----------------|
| v1.0        | 05/12/2024 | Documento inicial creado      | Walker Alfaro   |
