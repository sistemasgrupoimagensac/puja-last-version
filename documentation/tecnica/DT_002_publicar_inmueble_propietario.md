# Documento Técnico: Publicación de Inmuebles por Propietarios

## 1. Resumen del Flujo
**Descripción del Flujo:**  
El flujo permite a los usuarios con perfil de **propietario** publicar inmuebles para venta o alquiler, gestionando características, imágenes, ubicación y precios.

**Objetivo del Flujo:**  
Facilitar a los propietarios la publicación de inmuebles para venta o alquiler, ofreciendo un proceso estructurado y segmentado en pasos.

---

## 2. Requisitos Funcionales Relacionados
| **ID**   | **Nombre del Requisito**           | **Descripción**                                |
|----------|------------------------------------|------------------------------------------------|
| RFxxx    | Publicar Inmueble como Propietario | Permite a un propietario publicar inmuebles.  |
| RFyyy    | Gestión de Imágenes                | Manejo de imágenes principales y adicionales. |
| RFzzz    | Ubicación                          | Establece la ubicación del inmueble.          |

---

## 3. Base de Datos Relacionada
### Tablas Implicadas
#### Tabla: `tipos_operaciones`
| **Columna** | **Tipo**        | **Restricciones** | **Descripción**                          |
|-------------|-----------------|-------------------|------------------------------------------|
| id          | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del tipo de operación.|
| tipo        | VARCHAR(150)    | NOT NULL          | Nombre del tipo de operación.            |
| estado      | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del tipo.         |

#### Tabla: `subtipos_inmuebles`
| **Columna**     | **Tipo**        | **Restricciones** | **Descripción**                         |
|-----------------|-----------------|-------------------|-----------------------------------------|
| id              | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del subtipo.        |
| tipo_inmueble_id| BIGINT (FK)     | Constrained       | Relación con tipos de inmuebles.        |
| subtipo         | VARCHAR(200)    | NOT NULL          | Nombre del subtipo de inmueble.         |
| estado          | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del subtipo.     |

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
| **Columna**                | **Tipo**        | **Restricciones** | **Descripción**                        |
|----------------------------|-----------------|-------------------|----------------------------------------|
| id                         | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la categoría.   |
| categoria                  | VARCHAR(150)    | NOT NULL          | Nombre de la categoría.                |
| estado                     | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo de la categoría.|

#### Tabla: `caracteristicas_extra`
| **Columna**                | **Tipo**        | **Restricciones** | **Descripción**                        |
|----------------------------|-----------------|-------------------|----------------------------------------|
| id                         | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la característica.|
| categoria_caracteristica_id| BIGINT (FK)     | Constrained       | Relación con `categoria_caracteristicas_extra`.|
| caracteristica             | VARCHAR(200)    | NOT NULL          | Nombre de la característica extra.     |
| icono                      | VARCHAR(60)     | NULLABLE          | Icono asociado a la característica.    |
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
| `POST`     | `/my-post/store`                         | `MyPostsController@store`                | Almacena los datos de un inmueble.                          |
| `GET`      | `/my-posts/create`                       | `MyPostsController@create`               | Muestra el formulario de creación de inmuebles.             |
| `GET`      | `/my-post/ubicacion/departamentos`       | `MyPostsController@getDepartamentos`     | Obtiene los departamentos disponibles.                      |
| `GET`      | `/my-post/ubicacion/provincias/{id}`     | `MyPostsController@getProvincias`        | Obtiene las provincias asociadas a un departamento.         |
| `GET`      | `/my-post/ubicacion/distritos/{id}`      | `MyPostsController@getDistritos`         | Obtiene los distritos asociados a una provincia.            |
| `GET`      | `/my-post/extras/{id}`                   | `MyPostsController@getExtras`            | Obtiene las características adicionales.                    |

---

## 6. Análisis de Métodos del Controlador
### Método: `create`
**Descripción:**  
Carga la vista para el formulario de creación de inmuebles con base en el tipo de usuario autenticado.

**Flujo:**
1. Verifica si el usuario está autenticado.
2. Retorna la vista `crear-aviso` con variables específicas para acreedores (`es_propietario`, `tipo_operacion`).

---

### Método: `store`
**Descripción:**  
Almacena los datos del inmueble publicados por el usuario.

**Flujo:**
1. Valida los datos recibidos en el request.
2. Crea o actualiza los registros relacionados:
   - Tabla `inmuebles`.
   - Relación con `ubicacion`, `multimedia`, `caracteristicas`, y `extras`.
3. Maneja las imágenes principales y adicionales.
4. Retorna una respuesta JSON.

---

### Método: `getDepartamentos`
**Descripción:**  
Obtiene los departamentos disponibles desde la tabla `departamentos`.

**Flujo:**
1. Filtra los departamentos con `estado = 1`.
2. Retorna los datos en formato JSON.

---

### Método: `getProvincias`
**Descripción:**  
Obtiene las provincias asociadas a un departamento.

**Flujo:**
1. Recibe el ID del departamento como parámetro.
2. Filtra las provincias relacionadas y con `estado = 1`.
3. Retorna las provincias en formato JSON.

---

### Método: `getDistritos`
**Descripción:**  
Obtiene los distritos asociados a una provincia.

**Flujo:**
1. Recibe el ID de la provincia como parámetro.
2. Filtra los distritos relacionados y con `estado = 1`.
3. Retorna los distritos en formato JSON.

---

### Método: `getExtras`
**Descripción:**  
Obtiene las características adicionales relacionadas a una categoría.

**Flujo:**
1. Recibe el ID de la categoría como parámetro.
2. Filtra las características extra relacionadas y con `estado = 1`.
3. Retorna las características en formato JSON.

---

### Método: `edit_description`
**Descripción:**  
Actualiza la descripción de un inmueble ya publicado.

**Flujo:**
1. Valida los datos recibidos en el request.
2. Actualiza la descripción en la tabla `caracteristicas_inmuebles`.
3. Retorna una respuesta JSON indicando éxito.

---

## 7. APIs y Detalles Técnicos
### API: `POST /my-post/store`
- **Descripción:** Crea un nuevo inmueble en el sistema.
- **Parámetros de Entrada:**
  | **Parámetro**          | **Tipo**    | **Obligatorio** | **Descripción**                             |
  |------------------------|-------------|-----------------|---------------------------------------------|
  | tipo_operacion_id      | Integer     | Sí              | ID del tipo de operación.                   |
  | subtipo_inmueble_id    | Integer     | Sí              | ID del subtipo de inmueble.                 |
  | direccion              | String      | Sí              | Dirección del inmueble.                     |
  | departamento_id        | Integer     | Sí              | ID del departamento.                        |
  | provincia_id           | Integer     | Sí              | ID de la provincia.                         |
  | distrito_id            | Integer     | Sí              | ID del distrito.                            |
  | precio_soles           | Float       | No              | Precio en soles.                            |
  | precio_dolares         | Float       | No              | Precio en dólares.                          |

- **Respuestas:**
  | **Código** | **Mensaje**                                              |
  |------------|----------------------------------------------------------|
  | 201        | "Registro exitoso"                                       |
  | 422        | "Errores de validación"                                  |
  | 400        | "Faltan parámetros requeridos"                           |

---

## 8. Relación con la Documentación Funcional
- **Documento Funcional Relacionado:** Publicar inmueble como Propietario.
- **Relación:** Este documento técnico implementa las reglas y flujos definidos en el documento funcional.

---

## 9. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**           | **Autor**              |
|-------------|-----------------|-----------------------------------|------------------------|
| v1.0        | 05/12/2024      | Documento técnico inicial creado | Walker Alfaro          |
