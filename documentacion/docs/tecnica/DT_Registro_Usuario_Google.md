---
sidebar_label: 'Registro con Google'
sidebar_position: 2
title: 'Registro con Google'
---

# Documento Técnico: Registro de Usuario con Google

## 1. Resumen
**Descripción:**  
El flujo de registro e inicio de sesión mediante Google está implementado en el controlador `SuppliersController`. Este flujo permite a los usuarios autenticarse con Google OAuth 2.0, recuperar sus datos básicos (nombre, correo electrónico, y avatar) y registrar o iniciar sesión automáticamente en la plataforma. Este documento explica en detalle el backend y cómo gestiona el registro e inicio de sesión.

---


## 2. Requisitos Funcionales Relacionados
| **ID**   | **Nombre del Requisito**           | **Descripción**                                |
|----------|------------------------------------|------------------------------------------------|
| `RF002`  | Registro de Usuario con Google | Permite a los usuarios registrarse con una cuenta de Google.  |

---

## 3. Rutas

| **Ruta**                         | **Método** | **Controlador**                  | **Descripción**                                     |
|-----------------------------------|------------|-----------------------------------|-----------------------------------------------------|
| `/google-auth/redirect`           | GET        | `SuppliersController@selectAccountGoogle` | Redirige al usuario para seleccionar su cuenta de Google. |
| `/google-auth/callback`           | GET        | `SuppliersController@createLoginGoogle`   | Procesa el callback tras la autenticación con Google. |


---


## 4. Modelo Relacionado: `User`

En este flujo, los datos del usuario autenticado o registrado mediante Google se almacenan en la tabla `users`. A continuación, se detalla cómo se gestionan y qué representan los campos en la tabla:

#### Campos de la Tabla `users`

| **Campo**             | **Descripción**                                                                                      | **Origen de los Datos**                         |
|-----------------------|------------------------------------------------------------------------------------------------------|------------------------------------------------|
| **id**                | Identificador único del usuario. Se genera automáticamente al crear un nuevo registro.              | Generado por la base de datos.                 |
| **nombres**           | Nombre completo del usuario autenticado mediante Google.                                            | Recuperado desde Google (`$user_google->name`). |
| **email**             | Correo electrónico del usuario. Este es único en la tabla.                                          | Recuperado desde Google (`$user_google->email`). |
| **password**          | Contraseña del usuario. Para usuarios de Google, este campo permanece vacío (`null`).               | No aplica para este flujo.                     |
| **google_id**         | Identificador único proporcionado por Google para el usuario.                                       | Recuperado desde Google (`$user_google->id`).  |
| **imagen**            | URL de la imagen de perfil del usuario.                                                             | Recuperado desde Google (`$user_google->avatar`). |
| **tipo_usuario_id**   | Identificador del tipo de usuario (rol) en la plataforma.                                           | Definido en la sesión (`session('profile_type')`). |
| **email_verified_at** | Marca la fecha y hora en la que se verificó el correo electrónico. Para Google, se marca al registro.| Se asigna con `now()`.                         |
| **created_at**        | Fecha y hora de creación del registro.                                                              | Generado automáticamente.                      |
| **updated_at**        | Fecha y hora de la última actualización del registro.                                               | Generado automáticamente.                      |

---

#### **Cómo se Guardan los Datos en la Tabla**

1. **Flujo para Usuarios Nuevos:**
   - Cuando el usuario no existe en la base de datos, se crea un nuevo registro utilizando el modelo `User`:
     ```php
     $user = User::create([
         'google_id' => $user_google->id,
         'nombres' => $user_google->name,
         'email' => $user_google->email,
         'imagen' => $user_google->avatar,
         'tipo_usuario_id' => $profile_type,
         'email_verified_at' => now(),
     ]);
     ```
   - **Explicación del Registro:**
     - **`google_id`:** Se guarda el identificador único proporcionado por Google.
     - **`nombres`:** Se almacena el nombre completo del usuario.
     - **`email`:** Se guarda el correo electrónico recuperado de Google, garantizando que sea único.
     - **`imagen`:** Se almacena la URL del avatar del usuario proporcionado por Google.
     - **`tipo_usuario_id`:** Define el rol del usuario (e.g., propietario, corredor), y se obtiene de la sesión (`profile_type`).
     - **`email_verified_at`:** Se marca automáticamente como verificado en la fecha y hora actual (`now()`).

2. **Flujo para Usuarios Existentes:**
   - Si el usuario ya existe en la base de datos (verificado por `google_id`):
     ```php
     $existingUser = User::where('google_id', $user_google->id)->first();
     Auth::login($existingUser);
     ```
   - No se crea un nuevo registro. En su lugar, el usuario existente se autentica y accede a la plataforma.

3. **Valores por Defecto:**
   - **`password`:** Permanece `null` ya que el usuario utiliza Google para autenticarse.
   - **`created_at` y `updated_at`:** Se generan automáticamente por el framework.

---

#### **Relación con el Modelo**
El modelo `User` en Laravel permite manipular la tabla `users` y definir las relaciones, validaciones y comportamientos asociados a este flujo de registro.

```php
protected $fillable = [
    'google_id',
    'nombres',
    'email',
    'imagen',
    'tipo_usuario_id',
    'email_verified_at',
];
```
Este array define los campos que pueden ser asignados masivamente al crear o actualizar registros, como en el caso de:
```php
User::create([...]);
```

---

## 5. Métodos del Controlador

### 5.1. selectAccountGoogle

**Descripción:**  
Este método redirige al usuario a la página de autenticación de Google con la opción de seleccionar una cuenta específica, utilizando el parámetro `prompt=select_account`.

**Código del Método:**
```php
public function selectAccountGoogle() {
    return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();   
}
```

**Explicación:**
1. **`Socialite::driver('google')`:**
   - Configura el driver de Google para gestionar la autenticación.

2. **`with(['prompt' => 'select_account'])`:**
   - Agrega un parámetro adicional para forzar al usuario a seleccionar una cuenta específica, incluso si ya está autenticado con una cuenta en Google.

3. **`->redirect()`:**
   - Redirige al usuario a la página de autenticación de Google.

### 5.2. createLoginGoogle

**Descripción:**  
Este método maneja el callback tras la autenticación con Google. Verifica si el usuario ya existe en la base de datos y, dependiendo del caso, lo autentica o lo registra como un nuevo usuario.

**Código del Método:**
```php
public function createLoginGoogle() {
    $user_google = Socialite::driver('google')->user();
    $profile_type = session('profile_type', 2); 
    $existingUser = User::where('google_id', $user_google->id)->first();

    if ($existingUser) {
        // Loguear al usuario existente
        Auth::login($existingUser);
        return redirect('/')->with('user', $existingUser->toJson());
    } else {
        // Crear un nuevo usuario
        $user = User::create([
            'google_id' => $user_google->id,
            'nombres' => $user_google->name,
            'email' => $user_google->email,
            'imagen' => $user_google->avatar,
            'tipo_usuario_id' => $profile_type,
            'email_verified_at' => now(),
        ]);

        // Loguear al nuevo usuario
        Auth::login($user);
        return redirect('/')->with('user', $user->toJson());
    } 
}
```

**Explicación Paso a Paso:**
1. **`$user_google = Socialite::driver('google')->user()`:**
   - Recupera la información del usuario autenticado desde Google.
   - Devuelve un objeto que contiene:
     - `id`: Identificador único de Google.
     - `name`: Nombre del usuario.
     - `email`: Correo electrónico del usuario.
     - `avatar`: URL de la imagen de perfil.

2. **`$profile_type = session('profile_type', 2)`:**
   - Recupera el tipo de perfil seleccionado por el usuario desde la sesión.
   - El valor por defecto es `2`, que representa un perfil estándar.

3. **`$existingUser = User::where('google_id', $user_google->id)->first()`:**
   - Busca en la base de datos si existe un usuario registrado con el identificador de Google (`google_id`).

4. **Si el Usuario Existe:**
   - **`Auth::login($existingUser)`:**
     - Inicia sesión automáticamente al usuario existente.
   - **`redirect('/')->with('user', $existingUser->toJson())`:**
     - Redirige al usuario a la página principal, pasando su información como JSON.

5. **Si el Usuario No Existe:**
   - **Registro del Usuario:**
     ```php
     $user = User::create([
         'google_id' => $user_google->id,
         'nombres' => $user_google->name,
         'email' => $user_google->email,
         'imagen' => $user_google->avatar,
         'tipo_usuario_id' => $profile_type,
         'email_verified_at' => now(),
     ]);
     ```
     - Crea un nuevo usuario con los datos recuperados de Google.
     - Asigna el tipo de perfil desde la sesión (`tipo_usuario_id`).
     - Marca el correo como verificado (`email_verified_at`).

   - **`Auth::login($user)`:**
     - Inicia sesión automáticamente con el nuevo usuario registrado.
   - **`redirect('/')->with('user', $user->toJson())`:**
     - Redirige al usuario a la página principal.

6. **Manejo de Errores:**
   - En caso de problemas con el callback, el flujo puede personalizarse para redirigir al login con mensajes específicos.

---

## 6. Validaciones Implementadas

1. **Verificar Google ID:**
   - Se asegura que no existan usuarios duplicados con el mismo `google_id`.

2. **Correo Electrónico Único:**
   - Garantiza que el correo recuperado de Google no esté duplicado en la base de datos.

3. **Tipo de Perfil:**
   - Se utiliza un valor por defecto (`2`) si no se especifica un tipo de perfil en la sesión.

4. **Email Verificado:**
   - Los usuarios registrados a través de Google tienen automáticamente el estado de correo verificado.

---

## 7. Manejo de Errores

1. **Problemas con Google OAuth:**
   - Si Google no responde correctamente, se redirige al login con un mensaje de error.

2. **Errores al Guardar el Usuario:**
   - En caso de problemas con la base de datos, se puede personalizar la respuesta para mostrar un mensaje al usuario.

---

## 8. Flujo General de Autenticación

1. **Redirección Inicial:**
   - El usuario es enviado a Google para autenticarse y seleccionar una cuenta.

2. **Callback:**
   - Google redirige al sistema con un código de autorización.

3. **Registro/Inicio de Sesión:**
   - Si el usuario ya existe, se autentica.
   - Si el usuario no existe, se registra y se autentica.

4. **Redirección Final:**
   - El usuario es redirigido a la página principal con su sesión iniciada.

---

## 9. Historial de Cambios

| **Versión** | **Fecha**       | **Cambios Realizados**                 | **Autor**         |
|-------------|-----------------|----------------------------------------|-------------------|
| v1.0        | 11/12/2024      | Documento técnico inicial creado.      | Walker Alfaro     |
