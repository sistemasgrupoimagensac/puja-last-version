---
sidebar_label: 'Publicar Inmueble Acreedor'
sidebar_position: 7
title: 'Publicar Inmueble Acreedor'
---

# Documento Funcional: Publicar Inmueble como Acreedor

## 1. Resumen
**Descripción:**
Los usuarios con perfil de **acreedor** pueden publicar inmuebles en remate, especificando características, ubicación, imágenes, y precios.

**Propósito:**
Facilitar la publicación de inmuebles en remate, ofreciendo visibilidad en la plataforma **Puja Inmobiliaria**, optimizando la búsqueda de compradores interesados.

---

## 2. Requerimiento Funcional
**ID:** `RF007`
**Nombre del Requisito:** Publicar Inmueble como Acreedor.

**Descripción:**
El sistema debe permitir a los usuarios registrados como **acreedores** publicar inmuebles en remate, incluyendo datos obligatorios como precio de remate, valor de tasación, y ubicación, con la posibilidad de agregar imágenes y características adicionales.

**Reglas de Negocio:**
1. El usuario debe estar registrado como **acreedor**.
2. El tipo de inmueble es obligatorio.
3. La ubicación es obligatoria.
4. La superficie es obligatoria.
5. La antigüedad es obligatoria.
6. El precio de remate es obligatorio.
7. El precio de tasación es obligatorio.
8. Se debe elegir al menos un precio en soles o dólares.
9. La imagen principal es obligatoria.
10. Los *adicionales* son opcionales.

---

## 3. Flujo
1. El usuario inicia sesión como **acreedor**.
2. Hace clic en el botón **Publica Aquí**.
3. Selecciona la opción **Rematar**.
4. Elige el tipo de inmueble.
5. Define la ubicación.
6. Ingresa las características principales (superficie, antigüedad, precios).
7. Sube la imagen principal del inmueble.
8. Sube imágenes adicionales opcionales.
9. Selecciona los adicionales, si aplica.
10. Hace clic en **Guardar y Publicar**.
11. El sistema redirige al usuario a la página del inmueble publicado.
12. El usuario puede editar la descripción del inmueble.
13. Se habilita el botón **+ Plan** para adquirir un plan de visibilidad.
14. El usuario selecciona la duración del remate (7 o 15 días).
15. Escoge entre los planes **Premium**, **Top**, o **Estándar**.
16. Realiza el pago del plan seleccionado.
17. El inmueble en remate se publica en la plataforma.

---

## 4. Artefactos Técnicos Relacionados
| **Artefacto Técnico**                  | **Descripción**                                                               |
|----------------------------------------|-------------------------------------------------------------------------------|
| **Formulario de Publicación:**         | Renderizado desde `resources/views/crear-aviso.blade.php`.              |
| **Controlador:** `MyPostsController`   | Gestiona el flujo de creación, edición y publicación de inmuebles en remate.  |
| **API de Publicación:** `POST /my-post/store` | Procesa y almacena los datos del inmueble en la base de datos.              |
| **Gestión de Imágenes:** `ImageUploadController` | Controla la subida y almacenamiento de imágenes principales y adicionales.  |
| **Tablas Relacionadas:**               | `inmuebles`, `tipos_operaciones`, `subtipos_inmuebles`, `departamentos`, `provincias`, `distritos`. |
| **Validaciones de Precios:**           | Lógica implementada para validar precios de remate y tasación.                |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**             | **Autor**         |
|-------------|-----------------|-------------------------------------|-------------------|
| v1.0        | 05/12/2024      | Documento funcional inicial creado. | Walker Alfaro     |
