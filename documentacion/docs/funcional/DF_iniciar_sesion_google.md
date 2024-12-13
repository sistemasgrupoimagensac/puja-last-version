---
sidebar_label: 'Inicio de Sesión con Google'
sidebar_position: 4
title: 'Inicio de Sesión con Google'
---

# Documento Funcional: Iniciar Sesión con Google

## 1. Resumen
**Descripción:** El sistema debe permitir iniciar sesión con una cuenta de Google en sólo clic.
**Propósito:** Flexibilizar el proceso de registro iniciando sesión directamente con una cuenta de Google.

---

## 2. Requerimiento Funcional
**ID:** `RF004`
**Nombre del Requisito:** Iniciar sesión con Google.
**Descripción:** Permitir a los usuarios iniciar sesión con su cuenta de Google, por lo que no será necesario pasar por el proceso de registro ni crear una contraseña, debe ser suficiente con un correo Gmail registrado en el navegador.
**Reglas de Negocio:**  
- Regla 1: El usuario requiere un correo de Gmail activo.
- Regla 2: Sólo se permite un tipo de usuario por correo electrónico.
- Regla 3: Existen tres tipos de perfil que pueden iniciar sesión con una cuenta de Google: propietario, corredor, acreedor.

---

## 3. Flujo:
1. El usuario accede a la pantalla de inicio de sesión.
2. Le da clic en el botón de Google.  
3. Selecciona un correo Gmail para iniciar sesión.  
4. El usuario es registrado en el Sistema con su correo de Gmail.  

---

## 4. Artefactos Técnicos Relacionados
| **Artefacto Técnico**                 | **Descripción**                                        |
|---------------------------------------|--------------------------------------------------------|
| Tabla `users`                         | Contiene los datos de un usuario para iniciar sesión   |
| Modelo `User`                         | Representa la lógica del cliente.                      |
| Controlador `selectAccountGoogle()`   | Método que selecciona la cuenta de Google              |
| Vista `auth.signin`                   | Pantalla de inicio de sesión.                          |

---

## 5. Historial de Cambios
|**Versión**   |**Fecha**    |**Cambios Realizados**     |**Autor**       |
|--------------|-------------|---------------------------|----------------|
|v1.0          |03/12/2024   |Documento inicial creado   |Walker Alfaro   |