# Documentación General del Código

## 1. Clases Principales
### Clase: `ClienteController`
**Descripción:** Controla la lógica para manejar clientes en el sistema.  
**Ubicación:** `App\Http\Controllers`  
**Métodos Públicos:**
| **Método**      | **Descripción**                                   |
|------------------|--------------------------------------------------|
| `index`         | Listar todos los clientes.                       |
| `show($id)`     | Mostrar los detalles de un cliente específico.   |
| `store(Request)`| Crear un nuevo cliente.                          |
| `update(Request, $id)` | Actualizar un cliente existente.          |
| `destroy($id)`  | Eliminar un cliente.                             |

---

### Clase: `Cliente`
**Descripción:** Modelo que representa la entidad Cliente.  
**Ubicación:** `App\Models`  
**Relaciones:**
- `proyectos`: Relación `hasMany` con el modelo `Proyecto`.

---

## 2. Dependencias y Librerías
| **Paquete**             | **Versión** | **Propósito**                        |
|-------------------------|-------------|---------------------------------------|
| `laravel/framework`     | 11.x        | Base del proyecto.                   |
| `maatwebsite/excel`     | ^3.1        | Exportación e importación de datos.  |
| `spatie/laravel-permission` | ^5.4   | Gestión de roles y permisos.         |
