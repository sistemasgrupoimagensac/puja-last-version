---
sidebar_label: 'Registro de Usuarios'
sidebar_position: 2
title: 'Registro de Usuarios'
---

# Documento Funcional: Registro de Usuarios

## 1. Resumen
**Descripción:**  
Este flujo permite a nuevos usuarios registrarse en la plataforma con un perfil personalizado, otorgándoles acceso a funcionalidades como la publicación de inmuebles y la gestión de su información personal.

**Propósito:**  
Facilitar la incorporación de usuarios al sistema de manera eficiente, segura y cumpliendo con los requisitos necesarios para interactuar dentro de la plataforma.

---

## 2. Requerimiento Funcional
**ID:** `RF001`  
**Nombre del Requerimiento:** Registro de Usuarios.

**Descripción:**  
El sistema debe permitir a los usuarios registrarse mediante un formulario que recopile información básica, como nombres, correo electrónico, contraseña, tipo de documento, y aceptar términos y condiciones.

**Reglas de Negocio:**
1. El *correo electrónico* es obligatorio y debe ser único.
2. La *contraseña* es obligatoria y debe tener entre 6 y 20 caracteres.
3. El *nombre* es obligatorio.
4. El *apellido* es obligatorio.
5. El *número de teléfono* es obligatorio.
6. La *dirección* es obligatoria.
7. El *tipo de documento* es obligatorio.
8. El *número de documento* es obligatorio.
9. Es obligatorio aceptar los términos y condiciones.
10. Es obligatorio aceptar las políticas de privacidad.

---

## 3. Flujo
1. El usuario hace clic en el botón **Iniciar Sesión**.
2. Selecciona la opción **Registrar**.
3. Completa el formulario de registro con los datos requeridos:
   - *Nombres*
   - *Apellidos*
   - *Correo Electrónico*
   - *Contraseña*
   - *Tipo de Documento* y *Número de Documento*
   - *Teléfono*
   - *Dirección*
   - Confirmación de aceptación de términos y políticas.
4. Hace clic en el botón **Regístrate**.
5. El usuario queda registrado en la plataforma *Puja Inmobiliaria* y recibe un correo de bienvenida.

---

## 4. Artefactos Técnicos Relacionados

| **Artefacto Técnico**                  | **Descripción**                                                               |
|----------------------------------------|-------------------------------------------------------------------------------|
| **Formulario de Registro:**            | Renderizado desde `resources/views/auth/register.blade.php`.                  |
| **Controlador:** `LoginController@store`| Valida y gestiona el registro de nuevos usuarios.                            |
| **API de Registro:** `POST /store`     | Endpoint para procesar la información de registro enviada desde el frontend.  |
| **Tabla de Usuarios:** `users`         | Almacena los datos de los usuarios registrados.                              |
| **Tipos de Usuario:** `tipos_usuario`  | Define los roles asignables a los usuarios (e.g., propietario, broker).       |
| **Tipos de Documento:** `tipos_documento` | Lista los documentos válidos para el registro.                              |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**     | **Cambios Realizados**                 | **Autor**         |
|-------------|---------------|----------------------------------------|-------------------|
| v1.0        | 05/12/2024    | Documento funcional inicial creado.    | Walker Alfaro     |
