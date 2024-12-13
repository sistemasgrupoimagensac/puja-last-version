---
sidebar_label: 'Registro con Google'
sidebar_position: 2
title: 'Registro con Google'
---

# Documento Funcional: Registro de Usuario con Google

## 1. Resumen
**Descripción:**  
Este flujo permite a los usuarios registrarse en la plataforma utilizando su cuenta de Google. El registro con Google simplifica el proceso, evitando que los usuarios tengan que crear contraseñas adicionales y proporcionando acceso rápido a las funcionalidades de la plataforma.

**Propósito:**  
Facilitar la incorporación de usuarios al sistema de manera eficiente y segura, cumpliendo con los requisitos necesarios para interactuar dentro de la plataforma.

---

## 2. Requerimiento Funcional
**ID:** `RF002`  
**Nombre del Requerimiento:** Registro de Usuario con Google.

**Descripción:**  
El sistema debe permitir a los usuarios registrarse utilizando una cuenta de Gmail. Este método de autenticación reduce la fricción en el registro y garantiza la validación del correo electrónico. 

**Reglas de Negocio:**
1. Se requiere obligatoriamente una cuenta de Gmail válida.
2. El usuario debe otorgar permisos para que la plataforma acceda a los datos básicos de su perfil de Google (nombre, correo electrónico e imagen de perfil).

---

## 3. Flujos de Registro
El flujo varía según el tipo de usuario que desea registrarse. A continuación, se describen los pasos específicos para cada rol.

### 3.1. Registro como Propietario
1. El usuario hace clic en el botón **Iniciar Sesión**.
2. Selecciona el botón **Google**.
3. Se le pregunta si desea registrarse como **Propietario**.
4. Confirma su elección seleccionando *Sí*.
5. Se le presenta la pantalla de selección de cuentas de Gmail.

**Si no está autenticado con Google:**
5.1. El usuario debe ingresar las credenciales de su cuenta de Gmail.

6. Se inicia sesión con la cuenta de Google.
7. El sistema registra automáticamente los datos del usuario, asignándole el rol de propietario.
8. Se redirige al usuario a la página de inicio de la plataforma con la sesión iniciada.

---

### 3.2. Registro como Corredor
1. El usuario hace clic en el botón **Publicar Aquí**.
2. Selecciona la opción **Corredor**.
3. Escoge un *plan* o *paquete de anuncios* de los disponibles.
4. Es redirigido a la pantalla de inicio de sesión.
5. Selecciona el botón **Google**.
6. Se le pregunta si desea registrarse como **Corredor**.
7. Confirma su elección seleccionando *Sí*.
8. Se le presenta la pantalla de selección de cuentas de Gmail.

**Si no está autenticado con Google:**
8.1. El usuario debe ingresar las credenciales de su cuenta de Gmail.

9. Se inicia sesión con la cuenta de Google.
10. El sistema registra automáticamente los datos del usuario, asignándole el rol de corredor.
11. Se redirige al usuario a la página de inicio de la plataforma con la sesión iniciada.

---

### 3.3. Registro como Acreedor
1. El usuario hace clic en el botón **Publicar Aquí**.
2. Selecciona la opción **Acreedor**.
3. Es redirigido a la pantalla de inicio de sesión.
4. Selecciona el botón **Google**.
5. Se le pregunta si desea registrarse como **Acreedor**.
6. Confirma su elección seleccionando *Sí*.
7. Se le presenta la pantalla de selección de cuentas de Gmail.

**Si no está autenticado con Google:**
7.1. El usuario debe ingresar las credenciales de su cuenta de Gmail.

8. Se inicia sesión con la cuenta de Google.
9. El sistema registra automáticamente los datos del usuario, asignándole el rol de acreedor.
10. Se redirige al usuario a la página de inicio de la plataforma con la sesión iniciada.

---

## 4. Artefactos Técnicos Relacionados

| **Artefacto Técnico**                  | **Descripción**                                                               |
|----------------------------------------|-------------------------------------------------------------------------------|
| **Controlador de Google:** `SocialiteController@handleGoogleCallback` | Gestiona el inicio de sesión y registro mediante Google. |
| **API de Google:** Google OAuth 2.0    | Autentica al usuario y obtiene su información básica.                        |
| **Tabla de Usuarios:** `users`         | Almacena los datos básicos de los usuarios registrados.                      |
| **Tipos de Usuario:** `tipos_usuario`  | Define los roles asignables a los usuarios (propietario, corredor, acreedor).|

---

## 5. Detalles Técnicos

### **Gestión del Registro**
- **Controlador:**  
  `SocialiteController` es responsable de manejar el flujo de autenticación con Google. Cuando el usuario selecciona su cuenta de Gmail, el controlador procesa la respuesta y registra los datos en la tabla `users`.

- **API de Google OAuth:**  
  El sistema utiliza Google OAuth 2.0 para obtener el nombre, correo electrónico e imagen de perfil del usuario. Esta información se utiliza para completar automáticamente el perfil del usuario en la plataforma.

### **Asignación de Roles**
Los roles disponibles son:
1. **Propietario:** Puede publicar y gestionar propiedades.
2. **Corredor:** Puede adquirir planes y publicar propiedades en nombre de terceros.
3. **Acreedor:** Puede gestionar proyectos inmobiliarios relacionados con financiamiento.

El rol se asigna durante el registro, dependiendo de la elección realizada por el usuario.

---

## 6. Validaciones Implementadas

- **Validación del Correo Electrónico:**  
  Se garantiza que el correo electrónico proporcionado es único en la plataforma. Si un usuario intenta registrarse con una cuenta de Gmail ya registrada, se inicia sesión automáticamente en lugar de crear un nuevo usuario.

- **Validación de Permisos:**  
  El sistema verifica que el usuario otorgue los permisos necesarios para acceder a su información básica de Google.

- **Gestión de Sesión:**  
  Si el usuario ya está autenticado en Google, el sistema omite el paso de inicio de sesión y utiliza directamente los datos de la cuenta.

---

## 7. Historial de Cambios

| **Versión** | **Fecha**       | **Cambios Realizados**                 | **Autor**         |
|-------------|-----------------|----------------------------------------|-------------------|
| v1.0        | 11/12/2024      | Documento funcional inicial creado.    | Walker Alfaro     |
