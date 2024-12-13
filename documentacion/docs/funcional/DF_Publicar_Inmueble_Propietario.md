---
sidebar_label: 'Publicar Inmueble Propietario'
sidebar_position: 5
title: 'Publicar Inmueble Propietario'
---

# Documento Funcional: Publicar Inmueble como Propietario

## 1. Resumen
**Descripción:**  
Los usuarios con el perfil de **propietario** pueden publicar inmuebles para venta o alquiler, gestionando las características del inmueble, ubicación, imágenes, y precios.

**Propósito:**  
Facilitar a los propietarios la publicación de sus inmuebles en la plataforma *Puja Inmobiliaria*, otorgándoles visibilidad ante posibles compradores o arrendadores.

---

## 2. Requerimiento Funcional
**ID:** `RF005`  
**Nombre del Requisito:** Publicar inmueble como Propietario.

**Descripción:**  
El sistema debe permitir a los usuarios registrados como propietarios publicar inmuebles para venta o alquiler mediante un formulario dividido en pasos, facilitando la gestión de características, imágenes y ubicación.

**Reglas de Negocio:**  
1. El usuario debe estar registrado como **propietario**.  
2. El tipo de inmueble es obligatorio.  
3. Los campos *dormitorios*, *baños*, *medios baños* y *estacionamientos* son opcionales.  
4. Se debe elegir al menos un precio en soles o dólares.  
5. La superficie es obligatoria.  
6. La antigüedad del inmueble es obligatoria.  
7. La imagen principal es obligatoria.  
8. Las imágenes adicionales son opcionales.  
9. Las *comodidades* y *adicionales* son opcionales.  
10. El formulario está dividido en 6 pasos.  
11. Cada paso se guarda parcialmente en la base de datos.  

---

## 3. Flujo
1. El usuario inicia sesión como *propietario*.  
2. Hace clic en el botón **Publica Aquí**.  
3. Selecciona *venta* o *alquiler*.  
4. Establece la ubicación del inmueble.  
5. Ingresa las características generales.  
6. Sube la imagen principal del inmueble.  
7. Sube imágenes adicionales opcionales.  
8. Selecciona las *comodidades* del inmueble.  
9. Selecciona los *adicionales*.  
10. Hace clic en **Guardar y Publicar**.  
11. El sistema redirige al usuario a la página del inmueble publicado.  
12. El usuario puede editar la descripción del inmueble.  
13. Se habilita el botón **+ Plan** para comprar un plan de visibilidad.  
14. El usuario selecciona entre 1 y 5 avisos.  
15. Escoge entre los planes **Premium**, **Top**, o **Estándar**.  
16. Realiza el pago del plan seleccionado.  
17. El inmueble se publica con mayor visibilidad según el plan.  

---

## 4. Artefactos Técnicos Relacionados
| **Artefacto Técnico**                  | **Descripción**                                                               |
|----------------------------------------|-------------------------------------------------------------------------------|
| **Formulario de Publicación:**         | Renderizado desde `resources/views/crear-aviso.blade.php`.           |
| **Controlador:** `MyPostsController`   | Gestiona el flujo de creación, edición y publicación de inmuebles.            |
| **API de Publicación:** `POST /my-post/store` | Procesa y almacena los datos del inmueble en la base de datos.              |
| **Gestión de Imágenes:** `ImageUploadController` | Controla la subida y almacenamiento de imágenes principales y adicionales.  |
| **Tablas Relacionadas:**               | `inmuebles`, `tipos_operaciones`, `subtipos_inmuebles`, `departamentos`, `provincias`, `distritos`. |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**             | **Autor**         |
|-------------|-----------------|-------------------------------------|-------------------|
| v1.0        | 05/12/2024      | Documento funcional inicial creado. | Walker Alfaro     |
