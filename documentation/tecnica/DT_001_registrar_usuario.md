# Documento Técnico: Registro de Usuarios

## 1. Resumen del Flujo
**Descripción del Flujo:**  
Registrar nuevos usuarios en el sistema.

**Objetivo del Flujo:**  
Que lo usuarios tengan un perfil para publicar sus inmuebles.

---

## 2. Requisitos Funcionales Relacionados
| **ID** | **Nombre del Requisito**         | **Descripción**                                |
|--------|----------------------------------|-----------------------------------------------|
| RF001  | Registro de Usuarios            | Permitir registrar usuarios con datos básicos.|

---

## 3. Base de Datos Relacionada
### Tablas Implicadas
#### Tabla: `users`
- **Descripción:** Tabla principal que almacena los datos de los usuarios.
- **Estructura:**
  | **Columna**                 | **Tipo**        | **Restricciones**                   | **Descripción**                        |
  |-----------------------------|-----------------|-------------------------------------|----------------------------------------|
  | id                          | BIGINT (PK)     | AUTO_INCREMENT                      | Identificador único del usuario.       |
  | tipo_usuario_id             | BIGINT (FK)     | Constrained a `tipos_usuario`       | Rol del usuario.                       |
  | codigo_unico                | VARCHAR(200)    | UNIQUE, Nullable                    | Código único asociado al usuario.      |
  | nombres                     | VARCHAR(200)    | NOT NULL                            | Nombres del usuario.                   |
  | apellidos                   | VARCHAR(200)    | Nullable                            | Apellidos del usuario.                 |
  | email                       | VARCHAR(150)    | NOT NULL                            | Correo electrónico del usuario.        |
  | password                    | VARCHAR(255)    | Nullable                            | Contraseña cifrada del usuario.        |
  | google_id                   | VARCHAR(255)    | Nullable                            | ID de autenticación con Google.        |
  | tipo_documento_id           | BIGINT (FK)     | Constrained a `tipos_documento`     | Tipo de documento del usuario.         |
  | numero_documento            | VARCHAR(50)     | Nullable                            | Número de documento del usuario.       |
  | celular                     | VARCHAR(15)     | Nullable                            | Número de celular.                     |
  | imagen                      | VARCHAR(255)    | Nullable                            | URL de la imagen del usuario.          |
  | estado                      | SMALLINT        | DEFAULT 1                           | Estado del usuario (activo/inactivo).  |
  | email_verified_at           | TIMESTAMP       | Nullable                            | Fecha de verificación de email.        |
  | acepta_termino_condiciones  | BOOLEAN         | DEFAULT 1                           | Indica si acepta los términos.         |
  | acepta_confidencialidad     | BOOLEAN         | DEFAULT 1                           | Indica si acepta la confidencialidad.  |
  | remember_token              | VARCHAR(100)    | Nullable                            | Token para recordar sesión.            |
  | created_at                  | TIMESTAMP       | Nullable                            | Fecha de creación del registro.        |
  | updated_at                  | TIMESTAMP       | Nullable                            | Fecha de última modificación.          |

#### Tabla: `tipos_usuario`
- **Descripción:** Tabla que almacena los diferentes roles o tipos de usuario.
- **Estructura:**
  | **Columna**       | **Tipo**      | **Restricciones**   | **Descripción**                |
  |-------------------|---------------|---------------------|--------------------------------|
  | id                | BIGINT (PK)  | AUTO_INCREMENT      | Identificador único del rol.   |
  | tipo              | VARCHAR(150) | NOT NULL            | Nombre del tipo de usuario.    |
  | estado            | BOOLEAN      | DEFAULT 1           | Estado del tipo de usuario.    |
  | created_at        | TIMESTAMP    | Nullable            | Fecha de creación del registro.|
  | updated_at        | TIMESTAMP    | Nullable            | Fecha de última modificación.  |

#### Tabla: `tipos_documento`
- **Descripción:** Tabla que almacena los diferentes tipos de documento asociados a los usuarios.
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
- **Descripción:** Endpoint para registrar nuevos usuarios.  
- **Parámetros de Entrada:**
  | **Parámetro**          | **Tipo**    | **Obligatorio** | **Descripción**                   |
  |------------------------|-------------|-----------------|-----------------------------------|
  | tipo_de_usuario        | String      | Sí              | Tipo de usuario (owner, broker). |
  | nombre                 | String      | Sí              | Nombres del usuario.             |
  | apellido               | String      | Sí              | Apellidos del usuario.           |
  | email                  | String      | Sí              | Correo electrónico único.        |
  | contraseña             | String      | Sí              | Contraseña del usuario.          |
  | tipo_documento         | Integer     | Sí              | Tipo de documento (1, 2, 3).     |
  | numero_de_documento    | String      | Sí              | Número de documento.             |
  | telefono               | Integer     | Sí              | Número de celular (9 dígitos).   |
  | direccion              | String      | Sí              | Dirección del usuario.           |
  | imagen                 | Archivo     | No              | Imagen del usuario.              |
  | terminos               | Boolean     | Sí              | Aceptación de términos y condiciones.|

- **Respuestas:**
  | **Código** | **Mensaje**                                           |
  |------------|-------------------------------------------------------|
  | 201        | Usuario registrado exitosamente.                      |
  | 400        | "El campo nombres es requerido."                      |
  | 409        | "El correo ya existe en el sistema."                  |
  | 422        | "Errores de validación en los campos proporcionados." |

---

## 5. Lógica del Controlador
### Controlador: `LoginController@store`
- **Descripción:** Controlador que gestiona la creación de nuevos usuarios.
- **Pasos Principales:**
  1. Validar los datos del formulario.
  2. Manejar errores de validación.
  3. Convertir el tipo de usuario a su valor correspondiente.
  4. Registrar al usuario en la base de datos.
  5. Manejar la carga y almacenamiento de la imagen del usuario.
  6. Autenticar al usuario después del registro.

- **Código Ejemplo:**
  ```php
  public function store(Request $request)
  {
      // Validación de los campos del formulario
      $validator = Validator::make($request->all(), [...]);

      if ($validator->fails()) {
          return response()->json([
              'message' => 'Errores de validación',
              'errors' => $validator->errors()
          ], 422);
      }

      // Creación del usuario
      $user = User::create([...]);

      if ($request->hasFile('imagen')) {
          $imageName = time() . '.' . $request->imagen->extension();
          $request->imagen->move(public_path('images'), $imageName);
          $user->update(['imagen' => $imageName]);
      }

      Auth::login($user);
      event(new Registered($user));
      return redirect('/');
  }