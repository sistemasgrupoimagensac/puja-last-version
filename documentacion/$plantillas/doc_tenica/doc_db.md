# Documentación de la Base de Datos

## 1. Tablas y Relaciones
### Tabla: `proyectos`
**Descripción:** Contiene información sobre los proyectos del sistema.  
**Campos:**
| **Nombre**       | **Tipo**       | **Descripción**                    | **Restricciones**       |
|------------------|----------------|------------------------------------|-------------------------|
| id               | BIGINT         | Identificador único               | Primary Key, Auto Increment |
| nombre           | VARCHAR(255)   | Nombre del proyecto               | NOT NULL               |
| cliente_id       | BIGINT         | Relación con la tabla `clientes`  | Foreign Key, NOT NULL  |

**Relaciones:**
- **One to Many:** Un cliente puede tener muchos proyectos.
- **Foreign Key:** `cliente_id` → `clientes.id`.

### Tabla: `clientes`
**Descripción:** Contiene información de los clientes registrados en el sistema.  

**Campos:**
| **Nombre**       | **Tipo**       | **Descripción**                    | **Restricciones**       |
|------------------|----------------|------------------------------------|-------------------------|
| id               | BIGINT         | Identificador único               | Primary Key, Auto Increment |
| razon_social     | VARCHAR(255)   | Razón social del cliente          | NOT NULL               |
| ruc              | CHAR(11)       | Registro único del cliente        | UNIQUE, NOT NULL       |

---

## 2. Modelos Relacionados
### Modelo: `Proyecto`
**Clase:** `App\Models\Proyecto`  
**Relaciones:**
- `cliente`: Relación `belongsTo` con el modelo `Cliente`.
- `unidades`: Relación `hasMany` con el modelo `Unidad`.

### Modelo: `Cliente`
**Clase:** `App\Models\Cliente`  
**Relaciones:**
- `proyectos`: Relación `hasMany` con el modelo `Proyecto`.

---

## 3. Reglas de Negocio Asociadas
1. El `ruc` debe ser único en la tabla `clientes`.
2. Un `proyecto` debe estar asociado a un cliente existente.
