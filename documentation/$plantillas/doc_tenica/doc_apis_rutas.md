# Documentación de APIs y Rutas

## 1. Rutas Web
| **Ruta**              | **Método** | **Descripción**                        | **Controlador**         |
|-----------------------|------------|----------------------------------------|-------------------------|
| `/clientes`           | GET        | Listar todos los clientes              | ClienteController@index |
| `/clientes/{id}`      | GET        | Mostrar detalles de un cliente         | ClienteController@show  |
| `/clientes`           | POST       | Crear un nuevo cliente                 | ClienteController@store |
| `/clientes/{id}`      | PUT        | Actualizar información de un cliente   | ClienteController@update|
| `/clientes/{id}`      | DELETE     | Eliminar un cliente                    | ClienteController@destroy|

---

## 2. Endpoints de API
### Endpoint: `POST /api/clientes`
**Descripción:** Crear un cliente nuevo en el sistema.  
**Parámetros de Entrada:**
| **Campo**          | **Tipo**       | **Requerido** | **Descripción**              |
|--------------------|----------------|---------------|------------------------------|
| razon_social       | STRING         | Sí            | Razón social del cliente     |
| ruc                | STRING(11)     | Sí            | Número de RUC del cliente    |
| direccion_fiscal   | STRING         | No            | Dirección fiscal del cliente |

**Respuesta Exitosa:**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "razon_social": "Empresa SAC",
        "ruc": "12345678901"
    }
}
```

**Errores:**
|**Código**   |**Mensaje**                          |
|-------------|-------------------------------------|
|400          |"El campo `razón social` es requerido|