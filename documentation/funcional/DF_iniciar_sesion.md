# Documento Funcional: Iniciar Sesión

## 1. Resumen
**Descripción:** Inicio de sesión.
**Propósito:** Permitir a los usuarios iniciar sesión por medio de un usuario y contraseña, con uno de los tres perfiles: propietario, corredor, acreedor.

---

## 2. Requerimiento Funcional
**ID:** RF001
**Nombre del Requisito:** Iniciar sesión.
**Descripción:** Iniciar sesión por medio de un usuario y contraseña.

---

## 3. Flujo:
1. El usuario accede a la pantalla de inicio de sesión.
2. introduce su usuario y su contraseña.  
3. Se cargan sus datos registrados, como inmuebles publicados, planes contratados, etc.   

---

## 4. Artefactos Técnicos Relacionados
| **Requisito Funcional** | **Artefacto Técnico**                   | **Descripción**                                        |
|-------------------------|-----------------------------------------|--------------------------------------------------------|
| RFxxx                   | Tabla `users`                           | Contiene los datos de un usuario para iniciar sesión   |
|                         | Modelo `User`                           | Representa la lógica del cliente.                      |
|                         | Controlador `LoginController.login()`   | Método que selecciona la cuenta de Google              |
|                         | Vista `auth.signin`                     | Pantalla de inicio de sesión.                          |

---

## 5. Historial de Cambios
|**Versión**   |**Fecha**    |**Cambios Realizados**     |**Autor**       |
|--------------|-------------|---------------------------|----------------|
|v1.0          |03/12/2024   |Documento inicial creado   |Walker Alfaro   |