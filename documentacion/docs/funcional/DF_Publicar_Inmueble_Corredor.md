---
sidebar_label: 'Publicar Inmueble Corredor'
sidebar_position: 6
title: 'Publicar Inmueble Corredor'
---

# Documento Funcional: Publicar Inmueble como Corredor

## 1. Resumen
**Descripción:**  
El usuario con perfil de **corredor** puede adquirir un paquete de anuncios y publicar su cartera de inmuebles para venta o alquiler.

**Propósito:**  
Proveer una plataforma estructurada para que corredores puedan promover su cartera de inmuebles, ofreciendo visibilidad en **Puja Inmobiliaria**, lo que facilita la búsqueda de compradores o inquilinos potenciales.

---

## 2. Requerimiento Funcional
**ID:** `RF006`  
**Nombre del Requisito:** Publicar Inmueble como Corredor.

**Descripción:**  
El sistema permite a los usuarios registrados como **corredores** publicar inmuebles para venta o alquiler, asegurando el cumplimiento de las reglas establecidas y utilizando los planes adquiridos previamente.

**Reglas de Negocio:**  
1. El usuario debe estar registrado como **corredor**.  
2. Se debe adquirir previamente un plan o paquete de anuncios.  
3. El tipo de inmueble es obligatorio.  
4. Los campos *dormitorios*, *baños*, *medios baños* y *estacionamientos* son opcionales.  
5. Se debe elegir al menos un precio en soles o dólares.  
6. La superficie es obligatoria.  
7. La antigüedad es obligatoria.  
8. La imagen principal es obligatoria.  
9. Las imágenes adicionales son opcionales.  
10. Las *comodidades* y *adicionales* son opcionales.  
11. El formulario para subir los datos del inmueble está dividido en 6 pasos.  
12. Cada paso del formulario se guarda parcialmente en la base de datos.  

---

## 3. Flujo
1. El usuario inicia sesión como **corredor**.  
2. Hace clic en el botón **Publica Aquí**.  
3. Selecciona y adquiere un plan (paquete de anuncios).  
4. Selecciona si el inmueble es para *venta* o *alquiler*.  
5. Establece la ubicación del inmueble.  
6. Ingresa las características principales del inmueble (superficie, antigüedad, precios).  
7. Sube la imagen principal.  
8. Sube imágenes adicionales (opcional).  
9. Selecciona las comodidades disponibles (opcional).  
10. Selecciona los adicionales (opcional).  
11. Hace clic en **Guardar y Publicar**.  
12. El sistema redirige al usuario a la publicación del inmueble.  
13. El usuario puede editar la descripción del inmueble.  
14. Elige el plan (previamente adquirido) en el que desea publicar el anuncio.  
15. Publica el inmueble usando el plan seleccionado.  

---

## 4. Artefactos Técnicos Relacionados
| **Artefacto Técnico**                  | **Descripción**                                                               |
|----------------------------------------|-------------------------------------------------------------------------------|
| **Formulario de Publicación:**         | Renderizado desde `resources/views/crear-aviso.blade.php`.              |
| **Controlador:** `MyPostsController`   | Gestiona la creación, edición y publicación de inmuebles para corredores.     |
| **API de Publicación:** `POST /my-post/store` | Procesa y almacena los datos del inmueble en la base de datos.              |
| **Gestión de Imágenes:** `ImageUploadController` | Controla la subida y almacenamiento de imágenes principales y adicionales.  |
| **Tablas Relacionadas:**               | `inmuebles`, `plan_user`, `planes`, `subtipos_inmuebles`, `departamentos`, `provincias`, `distritos`. |
| **Validaciones de Planes:**            | Lógica para verificar disponibilidad de anuncios en planes adquiridos.        |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**             | **Autor**         |
|-------------|-----------------|-------------------------------------|-------------------|
| v1.0        | 05/12/2024      | Documento funcional inicial creado. | Walker Alfaro     |
