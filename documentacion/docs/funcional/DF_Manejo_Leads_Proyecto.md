---
sidebar_label: 'Manejo de Leads Proyecto'
sidebar_position: 12
title: 'Manejo de Leads Proyecto'
---

# Documento Funcional: Gestión de Leads de Proyectos

## 1. Resumen
**Descripción:**  
Este flujo permite capturar información de personas interesadas en publicar sus proyectos inmobiliarios, registrarla en la base de datos y sincronizarla con un documento en Google Sheets para su posterior seguimiento y análisis. Los leads generados pueden ser contactados y evaluados para identificar posibles clientes interesados.

**Propósito:**  
Optimizar la gestión de leads mediante la automatización de su captura y organización. Este flujo centraliza los datos de contacto inicial de los interesados y facilita su manejo por parte del equipo de ventas o atención al cliente.

---

## 2. Requerimiento Funcional
**ID:** `RF012`  
**Nombre del Requerimiento:** Captura y Gestión de Leads para Proyectos.

**Descripción:**  
El sistema debe permitir a usuarios externos, sin necesidad de registro, llenar un formulario con datos básicos (nombre, correo, teléfono, y mensaje opcional). Estos datos serán almacenados en la base de datos y enviados a Google Sheets para su posterior análisis y gestión.

**Reglas de Negocio:**
1. El número de teléfono debe comenzar con "9" (para teléfonos móviles de Perú).
2. El correo debe ser válido y único.
3. El mensaje es opcional y debe tener un límite máximo de 2000 caracteres.
4. El estado inicial del lead es **sin_contactar**.
5. Los datos ingresados deben cumplir con las políticas de privacidad.

---

## 3. Flujo
### 3.1. Generación del Lead
1. **Ingreso a la plataforma:**  
   Un usuario externo accede a la página principal y selecciona la opción "Publica Aquí".

2. **Selección de la categoría "Proyecto":**  
   El usuario es redirigido a la página `publica-tu-inmueble` y selecciona la opción "Proyecto".

3. **Redirección al formulario de contacto:**  
   El usuario es redirigido a la ruta `/contacto/proyecto`, donde se muestra el formulario de contacto.

4. **Llenado del formulario:**  
   El usuario completa los siguientes campos:  
   - Nombre completo.  
   - Correo electrónico.  
   - Teléfono móvil.  
   - Mensaje (opcional).  

5. **Envío de datos:**  
   Al hacer clic en el botón "Enviar":  
   - Los datos son validados según las reglas de negocio.  
   - Si los datos son válidos:  
     - Se registra el lead en la base de datos (`proyecto_leads`).  
     - Se envía la información a un Google Sheet para análisis y seguimiento.  
   - Si los datos son inválidos, se muestra un mensaje de error indicando los campos incorrectos.  

6. **Confirmación al usuario:**  
   - Si el proceso es exitoso, se muestra un mensaje de agradecimiento.  
   - Si ocurre un error, se notifica al usuario con un mensaje de fallo técnico.

---

## 4. Administración de Leads desde Filament

### Descripción
La administración de los leads capturados se realiza mediante un panel de gestión basado en Filament, que interactúa directamente con la tabla `proyecto_leads`. Este recurso facilita la manipulación y supervisión de los datos de los leads generados desde el formulario de contacto, proporcionando una interfaz intuitiva y segura.

### Campos Administrados
En el panel de administración, los siguientes campos pueden ser visualizados y editados:

- **Nombre:** El nombre completo del lead. Puede ser corregido si se detectan errores.
- **Correo:** Dirección de correo electrónico del lead, necesaria para comunicaciones posteriores.
- **Teléfono:** Número de contacto del lead, limitado a 9 dígitos (formato para Perú).
- **Mensaje:** Texto proporcionado opcionalmente por el lead, que detalla sus necesidades o consultas.
- **Estado:** Indica si el lead está `contactado` o `sin_contactar`, permitiendo hacer un seguimiento del progreso.
- **¿Respondió?:** Un campo booleano que señala si el lead ha respondido al contacto inicial.
- **¿Interesado?:** Otro campo booleano que indica si el lead ha expresado interés en el proyecto inmobiliario.
- **Fecha de Contacto:** Permite registrar cuándo se realizó el contacto con el lead para un seguimiento más preciso.

### Acciones Disponibles
El sistema de Filament permite realizar las siguientes acciones sobre los registros de leads:

1. **Edición:** Modificar los datos directamente en el panel para corregir errores o actualizar información.
2. **Eliminación en Masa:** Borrar múltiples registros seleccionados, útil para depurar información obsoleta o redundante.

### Beneficios de la Administración desde Filament
1. **Centralización:** Toda la información relevante de los leads está disponible en un solo lugar, eliminando la necesidad de acceder a la base de datos directamente.
2. **Facilidad de Uso:** La interfaz gráfica de Filament es intuitiva, lo que permite que usuarios no técnicos gestionen los datos sin problemas.
3. **Eficiencia:** Actualizar estados y registrar interacciones se realiza de forma rápida y segura.
4. **Seguridad:** Los accesos están restringidos a usuarios autorizados, reduciendo riesgos de manipulación indebida de datos.
5. **Seguimiento Detallado:** Campos como `estado`, `respondió`, y `fecha de contacto` permiten llevar un control claro del avance en el contacto con cada lead.

### Flujo de Trabajo
El equipo administrativo puede utilizar este panel para:

1. Revisar los leads entrantes.
2. Actualizar el estado a `contactado` tras establecer comunicación.
3. Indicar si el lead mostró interés, añadiendo una fecha de contacto para registro.
4. Gestionar las respuestas de los leads y priorizar aquellos interesados. 

La integración de esta herramienta asegura que los leads se gestionen de forma efectiva y organizada, maximizando las oportunidades de conversión.

---

## 5. Artefactos Técnicos Relacionados

| **Artefacto Técnico**                         | **Descripción**                                                                 |
|-----------------------------------------------|---------------------------------------------------------------------------------|
| `Route::get('/contacto/proyecto')`            | Renderiza el formulario de contacto para leads de proyectos.                   |
| `Route::post('/contacto/proyecto')`           | Procesa el envío del formulario y guarda los datos en la base de datos.        |
| `ContactoController@contacto_proyecto`        | Controlador para renderizar la vista del formulario.                           |
| `ContactoController@contacto_lead_proyecto_store`| Controlador para validar, almacenar y enviar los datos del lead.              |
| Tabla `proyecto_leads`                        | Tabla de la base de datos que almacena la información de los leads generados.  |
| Google Sheets Integration                     | Sincroniza los datos del lead con un documento en Google Sheets.               |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**     | **Cambios Realizados**                 | **Autor**         |
|-------------|---------------|----------------------------------------|-------------------|
| v1.0        | 11/12/2024    | Documento funcional inicial creado.    | Walker Alfaro     |
