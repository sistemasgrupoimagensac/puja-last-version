---
sidebar_label: 'Manejo de Leads Proyecto'
sidebar_position: 12
title: 'Manejo de Leads Proyecto'
---

# Documento Técnico: Gestión de Leads de Proyectos

---

## 1. Resumen

**Descripción:**  
Este documento técnico detalla el flujo de captura y gestión de leads para proyectos inmobiliarios, incluyendo el almacenamiento en la base de datos y la sincronización con un Google Sheet para facilitar su análisis y gestión.

**Propósito:**  
Garantizar que los leads generados a través del formulario `/contacto/proyecto` sean validados, almacenados de manera eficiente en la base de datos, y enviados a una hoja de cálculo en Google Sheets para el análisis del equipo de ventas.

---

## 2. Requisitos Funcionales Relacionados

| **ID**   | **Nombre del Requisito**                 | **Descripción**                                    |
|----------|------------------------------------------|--------------------------------------------------|
| `RF012`    | Gestión de Leads de Proyectos           | Permite a los usuarios llenar un formulario para generar un lead. |


---

## 3. Base de Datos Relacionada

### Tablas Implicadas

#### Tabla: `proyecto_leads`

**Propósito:**  
Almacena la información básica de los leads generados desde el formulario de contacto.

| **Columna**        | **Tipo**          | **Descripción**                                                                 |
|--------------------|-------------------|---------------------------------------------------------------------------------|
| `id`              | BIGINT (PK)       | Identificador único del lead.                                                  |
| `nombre`          | VARCHAR(255)      | Nombre completo del lead.                                                      |
| `correo`          | VARCHAR(255)      | Dirección de correo del lead.                                                  |
| `telefono`        | VARCHAR(20)       | Número de teléfono del lead.                                                   |
| `mensaje`         | TEXT              | Mensaje opcional proporcionado por el lead.                                    |
| `estado`          | ENUM              | Estado del lead (`sin_contactar` o `contactado`).                              |
| `respondio`       | BOOLEAN           | Indica si el lead ha respondido.                                               |
| `interesado`      | BOOLEAN           | Indica si el lead está interesado.                                             |
| `fecha_contacto`  | DATE              | Fecha en la que se contactó al lead.                                           |
| `created_at`      | TIMESTAMP         | Fecha y hora de creación del registro.                                         |
| `updated_at`      | TIMESTAMP         | Fecha y hora de la última actualización del registro.                          |

---

## 4. APIs y Scripts

### Ruta GET: `/contacto/proyecto`

**Controlador:**  
`ContactoController@contacto_proyecto`  

**Descripción:**  
Renderiza la vista `contacto_proyecto`, donde se muestra el formulario de contacto para generar un lead de proyecto.

---

### Ruta POST: `/contacto/proyecto`

**Controlador:**  
`ContactoController@contacto_lead_proyecto_store`  

**Validaciones:**
- `nombre`: Obligatorio, máximo 50 caracteres.
- `correo`: Obligatorio, formato de email válido, máximo 60 caracteres.
- `telefono`: Obligatorio, debe comenzar con "9", 9 dígitos (formato peruano).
- `mensaje`: Opcional, máximo 2000 caracteres.

**Flujo de Datos:**
1. Se valida la información enviada desde el formulario.
2. Si los datos son válidos:
   - Se crea un registro en la tabla `proyecto_leads`.
   - Se envían los datos a un Google Sheet mediante el método `sendDataToGoogleSheet()`.
3. Si los datos son inválidos:
   - Se devuelve una respuesta HTTP 422 con los errores de validación.

**Ejemplo de Respuesta Exitosa:**
```json
{
    "http_code": 200,
    "status": "Success",
    "message": "Envío de consulta correcto"
}
```

**Ejemplo de Respuesta con Error:**
```json
{
    "http_code": 500,
    "status": "Error",
    "message": "Error al enviar datos a Google Sheets.",
    "error": "Descripción del error"
}
```

---

### Sincronización con Google Sheets

**Método:**  
`ContactoController@sendDataToGoogleSheet`

**Propósito:**  
Enviar la información capturada del lead al Google Sheet designado.

**Flujo:**
1. Se construye la URL del Google Apps Script.
2. Se prepara un arreglo con los datos del lead (`nombre`, `correo`, `telefono`, `mensaje`).
3. Se realiza una solicitud POST a la URL.
4. Si la solicitud falla, se lanza una excepción que notifica del error.

**Código Clave:**
```php
private function sendDataToGoogleSheet($lead)
{
    $scriptUrl = 'https://script.google.com/macros/s/.../exec?action=addRow';
    $data = [
        'action' => 'addRow',
        'nombres' => $lead->nombre,
        'correo' => $lead->correo,
        'telefono' => $lead->telefono,
        'mensaje' => $lead->mensaje,
    ];

    $response = Http::post($scriptUrl, $data);

    if ($response->failed()) {
        throw new \Exception('Error al enviar datos a Google Sheets.');
    }
}
```

---

## 5. Controladores

### `ContactoController`

**Método:** `contacto_proyecto`  
Renderiza la vista del formulario de contacto.

**Método:** `contacto_lead_proyecto_store`  
Valida y almacena los datos del formulario en la base de datos. Luego, sincroniza los datos con Google Sheets.

---

## 6. Historial de Cambios

| **Versión** | **Fecha**       | **Cambios Realizados**           | **Autor**              |
|-------------|-----------------|----------------------------------|------------------------|
| v1.0        | 11/12/2024      | Documento técnico inicial creado | Walker Alfaro          |
