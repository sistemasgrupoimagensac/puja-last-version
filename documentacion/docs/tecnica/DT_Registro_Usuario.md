---
sidebar_label: 'Registro de Usuario'
sidebar_position: 1
title: 'Registro de Usuario'
---

# Documento Técnico: Registro de Usuarios

## 1. Resumen del Flujo
**Descripción del Flujo:**  
Proceso para registrar nuevos usuarios en la plataforma, asignándoles un perfil que les permita publicar inmuebles y acceder a funcionalidades específicas.

**Objetivo del Flujo:**  
Proveer un mecanismo seguro y eficiente para registrar usuarios, asegurando que cada perfil cumpla con los requisitos necesarios para interactuar dentro del sistema.

---

## 2. Requisitos Funcionales Relacionados
| **ID**  | **Nombre del Requisito**        | **Descripción**                                  |
|---------|---------------------------------|-------------------------------------------------|
| `RF001`   | Registro de Usuarios           | Permitir a los usuarios registrarse con datos básicos.|

---

## 3. Base de Datos Relacionada
### Tablas Implicadas

#### Tabla: `users`
- **Descripción:** Almacena los datos de los usuarios registrados.
- **Estructura:**
  | **Columna**                 | **Tipo**        | **Restricciones**                   | **Descripción**                        |
  |-----------------------------|-----------------|-------------------------------------|----------------------------------------|
  | id                          | BIGINT (PK)     | AUTO_INCREMENT                      | Identificador único del usuario.       |
  | tipo_usuario_id             | BIGINT (FK)     | Constrained a `tipos_usuario`       | Rol asignado al usuario.               |
  | codigo_unico                | VARCHAR(200)    | UNIQUE, Nullable                    | Código único asociado al usuario.      |
  | nombres                     | VARCHAR(200)    | NOT NULL                            | Nombres del usuario.                   |
  | apellidos                   | VARCHAR(200)    | Nullable                            | Apellidos del usuario.                 |
  | email                       | VARCHAR(150)    | NOT NULL                            | Correo electrónico único del usuario.  |
  | password                    | VARCHAR(255)    | Nullable                            | Contraseña cifrada del usuario.        |
  | google_id                   | VARCHAR(255)    | Nullable                            | ID para autenticación con Google.      |
  | tipo_documento_id           | BIGINT (FK)     | Constrained a `tipos_documento`     | Tipo de documento del usuario.         |
  | numero_documento            | VARCHAR(50)     | Nullable                            | Número de documento del usuario.       |
  | celular                     | VARCHAR(15)     | Nullable                            | Número de celular.                     |
  | imagen                      | VARCHAR(255)    | Nullable                            | URL de la imagen del usuario.          |
  | estado                      | SMALLINT        | DEFAULT 1                           | Estado del usuario (activo/inactivo).  |
  | email_verified_at           | TIMESTAMP       | Nullable                            | Fecha de verificación del correo.      |
  | acepta_termino_condiciones  | BOOLEAN         | DEFAULT 1                           | Indica aceptación de términos.         |
  | acepta_confidencialidad     | BOOLEAN         | DEFAULT 1                           | Indica aceptación de la confidencialidad.|
  | remember_token              | VARCHAR(100)    | Nullable                            | Token para recordar sesión.            |
  | created_at                  | TIMESTAMP       | Nullable                            | Fecha de creación del registro.        |
  | updated_at                  | TIMESTAMP       | Nullable                            | Fecha de última modificación.          |

#### Tabla: `tipos_usuario`
- **Descripción:** Define los diferentes roles asignables a los usuarios.
- **Estructura:**
  | **Columna**       | **Tipo**      | **Restricciones**   | **Descripción**                |
  |-------------------|---------------|---------------------|--------------------------------|
  | id                | BIGINT (PK)  | AUTO_INCREMENT      | Identificador único del rol.   |
  | tipo              | VARCHAR(150) | NOT NULL            | Nombre del tipo de usuario.    |
  | estado            | BOOLEAN      | DEFAULT 1           | Estado del tipo de usuario.    |
  | created_at        | TIMESTAMP    | Nullable            | Fecha de creación del registro.|
  | updated_at        | TIMESTAMP    | Nullable            | Fecha de última modificación.  |

#### Tabla: `tipos_documento`
- **Descripción:** Almacena los tipos de documento que los usuarios pueden asociar.
- **Estructura:**
  | **Columna**       | **Tipo**      | **Restricciones**   | **Descripción**                |
  |-------------------|---------------|---------------------|--------------------------------|
  | id                | BIGINT (PK)  | AUTO_INCREMENT      | Identificador único del tipo.  |
  | documento         | VARCHAR(150) | NOT NULL            | Nombre del tipo de documento.  |
  | estado            | BOOLEAN      | DEFAULT 1           | Estado del tipo de documento.  |
  | created_at        | TIMESTAMP    | Nullable            | Fecha de creación del registro.|
  | updated_at        | TIMESTAMP    | Nullable            | Fecha de última modificación.  |

---

## 4. APIs y Rutas Relacionadas

### API: `POST /store`
- **Descripción:** Endpoint para registrar nuevos usuarios en el sistema.
- **Parámetros de Entrada:**
  | **Parámetro**          | **Tipo**    | **Obligatorio** | **Descripción**                   |
  |------------------------|-------------|-----------------|-----------------------------------|
  | tipo_de_usuario        | String      | Sí              | Rol del usuario (owner, broker). |
  | nombre                 | String      | Sí              | Nombres del usuario.             |
  | apellido               | String      | Sí              | Apellidos del usuario.           |
  | email                  | String      | Sí              | Correo electrónico único.        |
  | contraseña             | String      | Sí              | Contraseña para la cuenta.       |
  | tipo_documento         | Integer     | Sí              | Tipo de documento (1, 2, 3).     |
  | numero_de_documento    | String      | Sí              | Número de documento.             |
  | telefono               | Integer     | Sí              | Número de celular (9 dígitos).   |
  | direccion              | String      | Sí              | Dirección del usuario.           |
  | imagen                 | Archivo     | No              | Imagen de perfil.                |
  | terminos               | Boolean     | Sí              | Aceptación de términos.          |

- **Respuestas:**
  | **Código** | **Mensaje**                                           |
  |------------|-------------------------------------------------------|
  | 201        | Usuario registrado exitosamente.                      |
  | 400        | "El campo nombres es requerido."                      |
  | 409        | "El correo ya está registrado en el sistema."         |
  | 422        | "Errores de validación en los campos proporcionados." |

---

## 5. Lógica del Controlador

### Controlador: `LoginController@store`
- **Descripción:** Gestiona el registro de nuevos usuarios y asegura su correcto almacenamiento en la base de datos.
- **Pasos Principales:**
  1. **Validación de datos:** Verificar que los datos ingresados cumplan con las reglas establecidas.
  2. **Errores de validación:** Enviar mensajes de error en caso de inconsistencias.
  3. **Conversión de datos:** Asignar el rol y procesar datos adicionales según el tipo de usuario.
  4. **Registro:** Crear el usuario y asociar información como la imagen de perfil.
  5. **Autenticación:** Iniciar sesión automáticamente después del registro.

- **Código Ejemplo:**
  ```php
  public function store(Request $request)
  {
      // Validación de datos
      $validator = Validator::make($request->all(), [
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
          'tipo_usuario' => 'required|exists:tipos_usuario,id',
          'nombre' => 'required|string|max:255',
          'telefono' => 'nullable|string|max:15',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'message' => 'Errores de validación',
              'errors' => $validator->errors()
          ], 422);
      }

      // Registro de usuario
      $user = User::create([
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'tipo_usuario_id' => $request->tipo_usuario,
          'nombres' => $request->nombre,
          'apellidos' => $request->apellido,
          'celular' => $request->telefono,
      ]);

      // Manejo de imagen (opcional)
      if ($request->hasFile('imagen')) {
          $imagePath = $request->file('imagen')->store('images', 'public');
          $user->update(['imagen' => $imagePath]);
      }

      // Autenticación y redirección
      Auth::login($user);
      event(new Registered($user));
      return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
  }


## 6. Historial de Cambios
| **Versión** | **Fecha**     | **Cambios Realizados**                | **Autor**         |
|-------------|---------------|----------------------------------------|-------------------|
| v1.0        | 05/12/2024    | Documento funcional inicial creado.    | Walker Alfaro     |