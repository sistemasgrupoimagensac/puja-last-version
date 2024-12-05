# Documento Técnico: Publicación de Inmuebles por Corredores

## 1. Resumen del Flujo
**Descripción:**  
Permite a los usuarios con perfil de **corredor** publicar inmuebles mediante la compra previa de un plan de anuncios. Incluye gestión de imágenes, características del inmueble, ubicación y planes.

**Propósito:**  
Facilitar la publicación de inmuebles por corredores y asegurar el cumplimiento de las reglas funcionales establecidas.

---

## 2. Requisitos Funcionales Relacionados
| **ID**   | **Nombre del Requisito**             | **Descripción**                                  |
|----------|--------------------------------------|--------------------------------------------------|
| RF001    | Comprar Plan de Anuncios            | Permite a un corredor adquirir un plan de anuncios para publicar inmuebles. |
| RF002    | Publicar Inmueble como Corredor     | Proceso de registro de inmuebles para corredores. |
| RF003    | Gestión de Imágenes                  | Manejo de imágenes principales y adicionales.   |
| RF004    | Ubicación                            | Establece la ubicación del inmueble.            |

---

## 3. Base de Datos Relacionada
### Tablas Implicadas

#### Tabla: `subtipos_inmuebles`
| **Columna**            | **Tipo**        | **Restricciones** | **Descripción**                                   |
|------------------------|-----------------|-------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del subtipo.                |
| tipo_inmueble_id       | BIGINT (FK)     | Constrained       | Relación con la tabla `tipos_inmuebles`.        |
| subtipo                | VARCHAR(200)    | NOT NULL          | Nombre del subtipo del inmueble.                |
| estado                 | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del subtipo.             |

#### Tabla: `departamentos`
| **Columna**            | **Tipo**        | **Restricciones** | **Descripción**                                   |
|------------------------|-----------------|-------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del departamento.           |
| nombre                 | VARCHAR(150)    | NOT NULL          | Nombre del departamento.                        |
| estado                 | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del departamento.        |

#### Tabla: `provincias`
| **Columna**            | **Tipo**        | **Restricciones** | **Descripción**                                   |
|------------------------|-----------------|-------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único de la provincia.            |
| departamento_id        | BIGINT (FK)     | Constrained       | Relación con la tabla `departamentos`.          |
| nombre                 | VARCHAR(150)    | NOT NULL          | Nombre de la provincia.                         |
| estado                 | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo de la provincia.         |

#### Tabla: `distritos`
| **Columna**            | **Tipo**        | **Restricciones** | **Descripción**                                   |
|------------------------|-----------------|-------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT    | Identificador único del distrito.               |
| provincia_id           | BIGINT (FK)     | Constrained       | Relación con la tabla `provincias`.             |
| nombre                 | VARCHAR(200)    | NOT NULL          | Nombre del distrito.                            |
| estado                 | BOOLEAN         | DEFAULT 1         | Estado activo/inactivo del distrito.            |

---

## 4. Relación de Tablas
| **Tabla**         | **Relacionada Con**     | **Relación**                        |
|-------------------|-------------------------|-------------------------------------|
| `plan_user`       | `users`                | Un usuario puede tener varios planes. |
| `plan_user`       | `planes`               | Un plan puede estar asociado a múltiples usuarios. |
| `subtipos_inmuebles` | `tipos_inmuebles`  | Relación entre tipos y subtipos de inmuebles. |
| `distritos`       | `provincias`           | Relación jerárquica para ubicación. |

---

## 5. Rutas Relacionadas
| **Método** | **Ruta**                                 | **Controlador y Método**                   | **Descripción**                                             |
|------------|------------------------------------------|--------------------------------------------|-------------------------------------------------------------|
| `POST`     | `/my-post/store`                         | `MyPostsController@store`                 | Almacena los datos de un inmueble en venta o alquiler.      |
| `GET`      | `/my-posts/create`                       | `MyPostsController@create`                | Muestra el formulario de creación de inmuebles para corredores. |
| `GET`      | `/my-post/ubicacion/departamentos`       | `MyPostsController@getDepartamentos`      | Obtiene los departamentos disponibles.                     |
| `GET`      | `/my-post/ubicacion/provincias/{id}`     | `MyPostsController@getProvincias`         | Obtiene las provincias asociadas a un departamento.         |
| `GET`      | `/my-post/ubicacion/distritos/{id}`      | `MyPostsController@getDistritos`          | Obtiene los distritos asociados a una provincia.            |
| `GET`      | `/my-post/extras/{id}`                   | `MyPostsController@getExtras`             | Obtiene las características adicionales.                    |

---

## 6. Métodos del Controlador

### Controlador: `MyPostsController`
#### Método: `create`
**Descripción:**  
Carga la vista para el formulario de creación de inmuebles para corredores.

**Frontend Asociado:**  
Formulario dinámico con **Alpine.js** que muestra opciones específicas para corredores.

**Flujo:**
1. Verifica el perfil del usuario autenticado.
2. Verifica que el usuario tenga anuncios disponibles en su plan activo.
3. Retorna la vista `crear-aviso`.

---

#### Método: `store`
**Descripción:**  
Almacena los datos del inmueble en venta o alquiler publicados por el corredor.

**Flujo:**
1. Valida los datos recibidos.
2. Verifica que el usuario tenga anuncios restantes.
3. Descuenta un anuncio del plan activo del usuario.
4. Crea o actualiza registros relacionados (ubicación, características, multimedia, etc.).
5. Maneja imágenes principales y adicionales.
6. Retorna una respuesta JSON.

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
- **Documento Funcional Relacionado:** Publicar inmueble como Corredor.
- **Relación:** Este documento técnico implementa las reglas y flujos definidos en el documento funcional, incluyendo la compra previa de un plan y la publicación de inmuebles.

---

## 9. Historial de Cambios
| **Versión** | **Fecha**       | **Cambios Realizados**           | **Autor**              |
|-------------|-----------------|-----------------------------------|------------------------|
| v1.0        | 04/12/2024      | Documento técnico inicial creado | Walker Alfaro          |
