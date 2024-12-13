---
sidebar_label: 'Publicar Proyecto Inmobiliario'
sidebar_position: 8
title: 'Publicar Proyecto Inmobiliario'
---

# Documento Técnico: Publicar Proyecto Inmobiliario

## 1. Resumen

**Descripción:** Este documento técnico describe la implementación del flujo para la publicación y gestión de proyectos inmobiliarios en la plataforma **Puja Inmobiliaria**. Este flujo permite a los usuarios con perfil de tipo *proyecto inmobiliario* gestionar sus proyectos, incluir detalles de las unidades, subir imágenes y administrar planos relacionados.

**Propósito:** Implementar la funcionalidad de publicación y edición de proyectos inmobiliarios, asegurando un flujo robusto y dinámico que permita a los usuarios manejar todos los aspectos de su proyecto desde una única interfaz.

---

## 2. Requisitos Funcionales Relacionados

| **ID**   | **Nombre del Requisito**                 | **Descripción**                                    |
|----------|------------------------------------------|--------------------------------------------------|
| `RF008` | Publicar Proyecto Inmobiliario      | Permite a un usuario publicar sus proyectos inmobiliarios. |

---


## 3. Base de Datos Relacionada

### 3.1. Proyecto
#### Tabla: `proyectos`
| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                     |
|------------------------|-----------------|---------------------|---------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único del proyecto.                 |
| nombre_proyecto        | VARCHAR(255)    | NOT NULL            | Nombre del proyecto.                              |
| unidades_cantidad      | INTEGER         | NOT NULL            | Cantidad total de unidades en el proyecto.        |
| banco_id               | BIGINT (FK)     | Constrained         | Relación con la tabla `bancos`.                  |
| proyecto_progreso_id   | BIGINT (FK)     | Constrained         | Relación con la tabla `proyecto_progreso`.        |
| descripcion            | TEXT            | NOT NULL            | Descripción detallada del proyecto.               |
| fecha_entrega          | DATE            | NULLABLE            | Fecha estimada de entrega del proyecto.           |
| area_desde             | DOUBLE          | NULLABLE            | Área mínima de las unidades.                      |
| area_hasta             | DOUBLE          | NULLABLE            | Área máxima de las unidades.                      |
| dormitorios_desde      | INTEGER         | NULLABLE            | Mínimo número de dormitorios en las unidades.     |
| dormitorios_hasta      | INTEGER         | NULLABLE            | Máximo número de dormitorios en las unidades.     |
| precio_desde           | DOUBLE          | NULLABLE            | Precio mínimo de las unidades.                    |
| direccion              | VARCHAR(255)    | NULLABLE            | Dirección del proyecto.                           |
| distrito               | VARCHAR(255)    | NULLABLE            | Distrito del proyecto.                            |
| provincia              | VARCHAR(255)    | NULLABLE            | Provincia del proyecto.                           |
| departamento           | VARCHAR(255)    | NULLABLE            | Departamento del proyecto.                        |
| latitude               | DOUBLE          | NULLABLE            | Coordenada de latitud.                            |
| longitude              | DOUBLE          | NULLABLE            | Coordenada de longitud.                           |
| slug                   | VARCHAR(255)    | UNIQUE              | Identificador único para URLs amigables.          |
| created_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP | Fecha de creación del registro.            |
| updated_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Última actualización del registro. |

**Propósito:** Gestionar los datos principales de los proyectos inmobiliarios.

**Relaciones:**
- **Unidades:** Relación uno a muchos con `ProyectoUnidades`.
- **Banco:** Relación uno a uno con `Banco`.
- **Progreso:** Relación uno a uno con `ProyectoProgreso`.
- **Imágenes Adicionales:** Relación uno a muchos con `ProyectoImagenesAdicionales`.
- **Imágenes Principales:** Relación uno a muchos con `ProyectoImagenesPrincipal`.

**Campos Principales:**
- `nombre_proyecto`: Nombre del proyecto.
- `unidades_cantidad`: Número total de unidades.
- `banco_id`: Identificador del banco que financia el proyecto.
- `proyecto_progreso_id`: Identificador del progreso del proyecto.
- `descripcion`: Descripción detallada del proyecto.
- `direccion`: Ubicación del proyecto.
- `fecha_entrega`: Fecha estimada de entrega.
- `slug`: Identificador único basado en el nombre.

**Migración:**
- Relaciones con las tablas `bancos` y `proyecto_progreso` mediante llaves foráneas.
- Campos como `area_desde`, `dormitorios_hasta`, `precio_desde` para definir rangos de valores de las unidades.





### 3.2. ProyectoUnidades
#### Tabla: `proyecto_unidades`
| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                     |
|------------------------|-----------------|---------------------|---------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único de la unidad.                 |
| proyecto_id            | BIGINT (FK)     | Constrained         | Relación con la tabla `proyectos`.                |
| dormitorios            | INTEGER         | NOT NULL            | Número de dormitorios de la unidad.               |
| precio_soles           | DOUBLE          | NULLABLE            | Precio de la unidad en soles.                     |
| precio_dolares         | DOUBLE          | NULLABLE            | Precio de la unidad en dólares.                   |
| area                   | DOUBLE          | NOT NULL            | Área total de la unidad.                          |
| area_techada           | DOUBLE          | NULLABLE            | Área techada de la unidad.                        |
| banios                 | INTEGER         | NOT NULL            | Número de baños de la unidad.                     |
| piso_numero            | INTEGER         | NOT NULL            | Número de piso de la unidad.                      |
| estado                 | BOOLEAN         | DEFAULT 1           | Estado de la unidad (1 = Activa, 0 = Inactiva).   |
| created_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP | Fecha de creación del registro.            |
| updated_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Última actualización del registro. |

**Propósito:** Representar las unidades individuales que componen un proyecto.

**Relaciones:**
- **Proyecto:** Relación muchos a uno con `Proyecto`.
- **Imágenes de Unidad:** Relación uno a muchos con `ProyectoImagenesUnidades`.

**Campos Principales:**
- `dormitorios`: Número de dormitorios.
- `precio_soles`: Precio en soles.
- `area`: Área total de la unidad.
- `piso_numero`: Número de piso.
- `estado`: Indica si la unidad está activa (1) o inactiva (0).

**Migración:**
- Relación con la tabla `proyectos` mediante llave foránea.
- Campos para definir características detalladas de la unidad.



### 3.3. ProyectoImagenesAdicionales
#### Tabla: `proyecto_imagenes_adicionales`
| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                     |
|------------------------|-----------------|---------------------|---------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único de la imagen.                 |
| proyecto_id            | BIGINT (FK)     | Constrained         | Relación con la tabla `proyectos`.                |
| image_url              | VARCHAR(255)    | NOT NULL            | URL de la imagen.                                 |
| descripcion            | VARCHAR(255)    | NULLABLE            | Descripción opcional de la imagen.                |
| tipo                   | VARCHAR(255)    | NULLABLE            | Categoría o tipo de la imagen.                    |
| estado                 | BOOLEAN         | DEFAULT 1           | Estado de la imagen (1 = Activa, 0 = Inactiva).   |
| created_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP | Fecha de creación del registro.            |
| updated_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Última actualización del registro. |

**Propósito:** Administrar las imágenes adicionales relacionadas a los proyectos.

**Relaciones:**
- **Proyecto:** Relación muchos a uno con `Proyecto`.

**Campos Principales:**
- `image_url`: URL de la imagen.
- `tipo`: Categoría o tipo de imagen.
- `estado`: Estado de la imagen (1 = activa, 0 = eliminada).

**Migración:**
- Relación con la tabla `proyectos` mediante llave foránea.
- Campos para almacenar URLs de imágenes y su estado.



### 3.4. ProyectoImagenesUnidades
#### Tabla: `proyecto_imagenes_unidades`
| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                     |
|------------------------|-----------------|---------------------|---------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único de la imagen.                 |
| proyecto_unidades_id   | BIGINT (FK)     | Constrained         | Relación con la tabla `proyecto_unidades`.        |
| proyecto_id            | BIGINT (FK)     | Constrained         | Relación con la tabla `proyectos`.                |
| image_url              | VARCHAR(255)    | NOT NULL            | URL de la imagen.                                 |
| estado                 | BOOLEAN         | DEFAULT 1           | Estado de la imagen (1 = Activa, 0 = Inactiva).   |
| descripcion            | VARCHAR(255)    | NULLABLE            | Descripción opcional de la imagen.                |
| created_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP | Fecha de creación del registro.            |
| updated_at             | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Última actualización del registro. |

**Propósito:** Administrar las imágenes relacionadas a las unidades.

**Relaciones:**
- **Unidad:** Relación muchos a uno con `ProyectoUnidades`.
- **Proyecto:** Relación muchos a uno con `Proyecto`.

**Campos Principales:**
- `image_url`: URL de la imagen.
- `estado`: Estado de la imagen (1 = activa, 0 = eliminada).

**Migración:**
- Relación con las tablas `proyecto_unidades` y `proyectos` mediante llaves foráneas.


---


## 4. Flujo de Proceso

### 4.1. Crear/Editar Proyecto

1. El usuario accede al formulario mediante la ruta: `/proyecto/editor/{id?}`.
2. Completa los campos del proyecto (nombre, descripción, progreso, ubicación, etc.).
3. Guarda los cambios parcial o completamente utilizando los botones correspondientes.

### 4.2. Gestión de Unidades

1. El usuario agrega unidades mediante el botón *+ Agregar Unidad*.
2. Completa el formulario de la unidad con los detalles requeridos.
3. Guarda la unidad en la tabla dinámica.

### 4.3. Subir Imágenes del Proyecto

1. El usuario abre el modal de imágenes del proyecto y selecciona archivos.
2. Las imágenes son subidas mediante un `POST` al endpoint `/proyectos/{proyectoId}/imagenes`.

### 4.4. Gestión de Planos de Unidades

1. Se habilita la opción de subir planos para cada unidad después de guardar parcialmente el proyecto.
2. Los planos son enviados mediante un `POST` a `/unidades/{unidadId}/imagenes`.

### 4.5. Selección de Imagen Principal

1. El usuario selecciona una imagen como principal desde el modal de imágenes del proyecto.
2. El sistema actualiza la imagen principal mediante un `POST` al endpoint `/proyectos/{proyectoId}/imagenes-principal`.

---

## 5. Estructura del Código

### 5.1. Controladores Principales

#### **`ProyectoController`**
- **Método:** `create`
  - **Propósito:** Mostrar el formulario de creación o edición de proyectos.
  - **Responsabilidades:** 
    - Cargar datos de bancos y estados de progreso.
    - Cargar detalles del proyecto existente (en caso de edición).
- **Método:** `store`
  - **Propósito:** Guardar o actualizar los datos del proyecto y sus unidades.
  - **Responsabilidades:** 
    - Validar los datos ingresados.
    - Crear o actualizar el registro del proyecto.
    - Gestionar las unidades asociadas al proyecto.
- **Método:** `show`
  - **Propósito:** Mostrar los detalles de un proyecto publicado.

#### **`ProyectoImagenController`**
- **Método:** `store`
  - **Propósito:** Subir imágenes del proyecto a almacenamiento externo (Wasabi) y registrar en la base de datos.
- **Método:** `destroy`
  - **Propósito:** Marcar imágenes como inactivas y eliminarlas del almacenamiento.
- **Método:** `updatePrincipal`
  - **Propósito:** Actualizar la imagen principal del proyecto.

#### **`ProyectoImagenUnidadController`**
- **Método:** `index`
  - **Propósito:** Listar imágenes asociadas a una unidad.
- **Método:** `store`
  - **Propósito:** Subir imágenes para una unidad específica.
- **Método:** `destroy`
  - **Propósito:** Marcar imágenes de unidad como inactivas y eliminarlas del almacenamiento.

---

## 6. Rutas

### 6.1. Proyectos

| **Método** | **Ruta**                                    | **Descripción**                                       |
|------------|---------------------------------------------|-------------------------------------------------------|
| GET        | `/proyecto/editor/{id?}`                    | Mostrar el formulario para crear/editar un proyecto. |
| POST       | `/proyecto`                                 | Guardar o actualizar un proyecto.                   |
| POST       | `/proyectos/{proyectoId}/imagenes`          | Subir imágenes de un proyecto.                      |
| POST       | `/proyectos/{proyectoId}/imagenes-principal`| Seleccionar la imagen principal del proyecto.       |
| DELETE     | `/proyectos/{proyectoId}/imagenes/{imagen}` | Eliminar una imagen del proyecto.                   |
| GET        | `/proyecto/{slug}`                          | Ver los detalles de un proyecto publicado.          |

### 6.2. Unidades

| **Método** | **Ruta**                                    | **Descripción**                                       |
|------------|---------------------------------------------|-------------------------------------------------------|
| GET        | `/unidades/{unidadId}/imagenes`             | Listar imágenes de una unidad.                      |
| POST       | `/unidades/{unidadId}/imagenes`             | Subir imágenes de una unidad.                       |
| DELETE     | `/unidades/imagenes/{imagenId}`             | Eliminar una imagen de una unidad.                  |

---

## 7. Detalles Técnicos

### 7.1. Frontend

### Blade Template
- **Ruta:** `resources/views/proyectos/create.blade.php`
- **Propósito:** Renderizar el formulario de creación/edición de proyectos y gestionar:
  - Formulario dinámico para proyectos y unidades.
  - Integración con Google Maps.
  - Subida y gestión de imágenes.

### JavaScript

#### Archivos
1. **`create_project.js`**
   - Lógica para crear/editar proyectos y unidades.
   - Actualización dinámica de tablas de unidades.
   - Comunicación con el backend para almacenar proyectos y unidades.

2. **`project_upload_image.js`**
   - Subida de imágenes del proyecto con vista previa.
   - Validaciones y eliminación de imágenes.

3. **`upload_unit_image.js`**
   - Subida de imágenes para unidades.
   - Vista previa y validación de planos.

4. **`location_map.js`**
   - Uso de Google Maps API para:
     - Geolocalización y autocompletado de direcciones.
     - Manejo de marcadores arrastrables y actualización de campos.

#### Carga de Scripts
```php
@push('scripts')
    @vite([
        'resources/js/scripts/create_project.js',
        'resources/js/scripts/location_map.js',
        'resources/js/scripts/project_upload_image.js',
        'resources/js/scripts/upload_unit_image.js',
    ])
@endpush
```


## Backend

### Controladores
1. **`ProyectoController`**
   - **`create`**: Renderiza la vista de creación/edición y carga datos como bancos, progresos y unidades.
   - **`store`**: Valida y almacena proyectos, gestiona límites de publicaciones y unidades asociadas.
   - **`show`**: Muestra proyectos publicados con sus unidades e imágenes.

2. **`ProyectoImagenController`**
   - **`store`**: Subida de imágenes a Wasabi con validación y registro en la base de datos.
   - **`destroy`**: Elimina imágenes del proyecto, cambiando su estado y eliminándolas del almacenamiento.
   - **`updatePrincipal`**: Designa una imagen como principal.

3. **`ProyectoImagenUnidadController`**
   - **`index`**: Lista imágenes activas de una unidad.
   - **`store`**: Subida de imágenes de unidades a Wasabi.
   - **`destroy`**: Elimina imágenes de unidades y las desactiva.

### Resumen de Funcionalidades
- **Formulario de Proyectos:** `ProyectoController`.
- **Gestión de Imágenes del Proyecto:** `ProyectoImagenController`.
- **Gestión de Imágenes de Unidades:** `ProyectoImagenUnidadController`.

---

## 8. Historial de Cambios

| **Versión** | **Fecha**     | **Cambios Realizados**            | **Autor**       |
|-------------|---------------|------------------------------------|-----------------|
| v1.0        | 05/12/2024    | Documento técnico inicial creado  | Walker Alfaro   |
