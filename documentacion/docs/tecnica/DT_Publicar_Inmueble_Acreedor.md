---
sidebar_label: 'Publicar Inmueble Acreedor'
sidebar_position: 7
title: 'Publicar Inmueble Acreedor'
---

# Documento Técnico: Publicar Inmueble como Acreedor

## 1. Resumen del Flujo
**Descripción del Flujo:**  
Permite a los usuarios con perfil de **acreedor** publicar inmuebles en remate. El flujo incluye formularios dinámicos utilizando **Alpine.js** y Blade para el frontend, y valida información específica para remates.

**Objetivo del Flujo:**  
Facilitar a los acreedores la publicación de propiedades en remate, asegurando una experiencia de usuario optimizada y validación estructurada.

---

## 2. Requisitos Funcionales Relacionados
| **ID**   | **Nombre del Requisito**             | **Descripción**                                  |
|----------|--------------------------------------|--------------------------------------------------|
| `RF007`    | Publicar Inmueble como Acreedor      | Permite a un acreedor publicar inmuebles en remate.|

---

## 3. Base de Datos Relacionada
### Tablas Implicadas
#### Tabla: `tipos_operaciones`
| **Columna** | **Tipo**        | **Restricciones** | **Descripción**                              |
|-------------|-----------------|-------------------|----------------------------------------------|
| id          | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del tipo de operación.   |
| tipo        | VARCHAR(150)    | NOT NULL          | Nombre del tipo de operación.               |
| estado      | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del tipo.            |

#### Tabla: `subtipos_inmuebles`
| **Columna**     | **Tipo**        | **Restricciones** | **Descripción**                             |
|-----------------|-----------------|-------------------|---------------------------------------------|
| id              | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del subtipo.            |
| tipo_inmueble_id| BIGINT (FK)     | Constrained       | Relación con tipos de inmuebles.            |
| subtipo         | VARCHAR(200)    | NOT NULL          | Nombre del subtipo de inmueble.             |
| estado          | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del subtipo.         |

#### Tabla: `departamentos`
| **Columna** | **Tipo**        | **Restricciones** | **Descripción**                          |
|-------------|-----------------|-------------------|------------------------------------------|
| id          | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del departamento.    |
| nombre      | VARCHAR(150)    | NOT NULL          | Nombre del departamento.                 |
| estado      | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del departamento. |

#### Tabla: `provincias`
| **Columna**        | **Tipo**        | **Restricciones** | **Descripción**                         |
|--------------------|-----------------|-------------------|-----------------------------------------|
| id                 | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la provincia.    |
| departamento_id    | BIGINT (FK)     | Constrained       | Relación con la tabla `departamentos`.  |
| nombre             | VARCHAR(150)    | NOT NULL          | Nombre de la provincia.                 |
| estado             | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo de la provincia. |

#### Tabla: `distritos`
| **Columna**     | **Tipo**        | **Restricciones** | **Descripción**                         |
|-----------------|-----------------|-------------------|-----------------------------------------|
| id              | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del distrito.       |
| provincia_id    | BIGINT (FK)     | Constrained       | Relación con la tabla `provincias`.     |
| nombre          | VARCHAR(200)    | NOT NULL          | Nombre del distrito.                    |
| estado          | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del distrito.    |

#### Tabla: `categoria_caracteristicas_extra`
| **Columna**                | **Tipo**        | **Restricciones** | **Descripción**                            |
|----------------------------|-----------------|-------------------|--------------------------------------------|
| id                         | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la categoría.       |
| categoria                  | VARCHAR(150)    | NOT NULL          | Nombre de la categoría.                    |
| estado                     | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo de la categoría.    |

#### Tabla: `caracteristicas_extra`
| **Columna**                | **Tipo**        | **Restricciones** | **Descripción**                            |
|----------------------------|-----------------|-------------------|--------------------------------------------|
| id                         | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la característica.  |
| categoria_caracteristica_id| BIGINT (FK)     | Constrained       | Relación con `categoria_caracteristicas_extra`.|
| caracteristica             | VARCHAR(200)    | NOT NULL          | Nombre de la característica extra.         |
| icono                      | VARCHAR(60)     | NULLABLE          | Icono asociado a la característica.        |
| estado                     | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo de la característica.|

---

## 4. Relación de Tablas
| **Tabla**                 | **Relacionada Con**                 | **Relación**                      |
|---------------------------|-------------------------------------|-----------------------------------|
| `tipos_operaciones`       | `subtipos_inmuebles`               | Un tipo puede tener múltiples subtipos. |
| `departamentos`           | `provincias`                       | Un departamento tiene varias provincias.|
| `provincias`              | `distritos`                        | Una provincia tiene varios distritos.   |
| `categoria_caracteristicas_extra` | `caracteristicas_extra`    | Una categoría puede tener múltiples características.|

---

## 5. Rutas Relacionadas
| **Método** | **Ruta**                                 | **Controlador y Método**                  | **Descripción**                                              |
|------------|------------------------------------------|-------------------------------------------|--------------------------------------------------------------|
| `POST`     | `/my-post/store`                         | `MyPostsController@store`                | Almacena los datos de un inmueble en remate.                |
| `GET`      | `/my-posts/create`                       | `MyPostsController@create`               | Muestra el formulario de creación de inmuebles para acreedores.|
| `GET`      | `/my-post/ubicacion/departamentos`       | `MyPostsController@getDepartamentos`     | Obtiene los departamentos disponibles.                      |
| `GET`      | `/my-post/ubicacion/provincias/{id}`     | `MyPostsController@getProvincias`        | Obtiene las provincias asociadas a un departamento.         |
| `GET`      | `/my-post/ubicacion/distritos/{id}`      | `MyPostsController@getDistritos`         | Obtiene los distritos asociados a una provincia.            |
| `GET`      | `/my-post/extras/{id}`                   | `MyPostsController@getExtras`            | Obtiene las características adicionales para remates.       |

---

## 6. Métodos del Controlador MyPostsController
### Método: `create`
**Descripción:**  
Carga la vista para el formulario de creación de inmuebles para acreedores.

**Frontend Asociado:**  
Formulario dinámico con **Alpine.js** que muestra opciones específicas para remates.

**Flujo:**
1. Verifica el perfil del usuario autenticado.
2. Retorna la vista `crear-aviso` con variables específicas para acreedores (`es_acreedor`, `tipo_operacion`).

---

### Método: `store`
**Descripción:**  
Almacena los datos del inmueble en remate publicados por el usuario.

**Frontend Asociado:**  
Formulario dividido en pasos (uso de `x-show` para gestión de visibilidad de formularios en **Alpine.js**).

**Flujo:**
1. Valida los datos recibidos en el request.
2. Crea o actualiza registros relacionados:
   - Tabla `inmuebles`.
   - Relación con `ubicacion`, `multimedia`, `caracteristicas`, y `extras`.
3. Maneja imágenes principales y adicionales.
4. Maneja campos específicos para remates:
   - Base de remate.
   - Valor de tasación.
   - Detalles de contacto.
5. Retorna una respuesta JSON.

---

### Método: `getDepartamentos`
**Descripción:**  
Obtiene los departamentos disponibles desde la tabla `departamentos`.

**Frontend Asociado:**  
Dropdown dinámico con **Alpine.js** para la selección de departamentos.

**Flujo:**
1. Filtra los departamentos con `estado = 1`.
2. Retorna los datos en formato JSON.

---

### Método: `getProvincias`
**Descripción:**  
Obtiene las provincias asociadas a un departamento.

**Frontend Asociado:**  
Dropdown dinámico con **Alpine.js**, cargado tras seleccionar un departamento.

**Flujo:**
1. Recibe el ID del departamento como parámetro.
2. Filtra las provincias relacionadas y con `estado = 1`.
3. Retorna las provincias en formato JSON.

---

### Método: `getDistritos`
**Descripción:**  
Obtiene los distritos asociados a una provincia.

**Frontend Asociado:**  
Dropdown dinámico con **Alpine.js**, cargado tras seleccionar una provincia.

**Flujo:**
1. Recibe el ID de la provincia como parámetro.
2. Filtra los distritos relacionados y con `estado = 1`.
3. Retorna los distritos en formato JSON.

---

### Método: `getExtras`
**Descripción:**  
Obtiene las características adicionales relacionadas a una categoría para remates.

**Frontend Asociado:**  
Checkbox dinámico con **Alpine.js** para selección de características.

**Flujo:**
1. Recibe el ID de la categoría como parámetro.
2. Filtra las características extra relacionadas y con `estado = 1`.
3. Retorna las características en formato JSON.

---

## 7. APIs y Detalles Técnicos
### API: `POST /my-post/store`
- **Descripción:** Crea un nuevo inmueble en remate.
- **Parámetros de Entrada:**
  | **Parámetro**          | **Tipo**    | **Obligatorio** | **Descripción**                             |
  |------------------------|-------------|-----------------|---------------------------------------------|
  | tipo_operacion_id      | Integer     | Sí              | ID del tipo de operación.                   |
  | subtipo_inmueble_id    | Integer     | Sí              | ID del subtipo de inmueble.                 |
  | direccion              | String      | Sí              | Dirección del inmueble.                     |
  | departamento_id        | Integer     | Sí              | ID del departamento.                        |
  | provincia_id           | Integer     | Sí              | ID de la provincia.                         |
  | distrito_id            | Integer     | Sí              | ID del distrito.                            |
  | base_remate            | Float       | Sí              | Base de remate en dólares.                  |
  | valor_tasacion         | Float       | Sí              | Valor de tasación en dólares.               |

- **Respuestas:**
  | **Código** | **Mensaje**                                              |
  |------------|----------------------------------------------------------|
  | 201        | "Registro exitoso"                                       |
  | 422        | "Errores de validación"                                  |
  | 400        | "Faltan parámetros requeridos"                           |

---

## 8. Relación con la Documentación Funcional
- **Documento Funcional Relacionado:** Publicar inmueble como Acreedor.
- **Relación:** Este documento técnico implementa las reglas y flujos definidos en el documento funcional.

---

## 9. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**           | **Autor**              |
|-------------|-----------------|-----------------------------------|------------------------|
| v1.0        | 04/12/2024      | Documento técnico inicial creado | Walker Alfaro          |
