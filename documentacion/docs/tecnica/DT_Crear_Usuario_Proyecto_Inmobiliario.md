---
sidebar_label: 'Crear Usuario Proyecto Inmobiliario'
sidebar_position: 9
title: 'Crear Usuario Proyecto Inmobiliario'
---

# Documento Técnico: Crear Usuario Proyecto Inmobiliario

---

## 1. Resumen

**Descripción:**  
Permite a un ejecutivo de cuenta crear un usuario del tipo **proyecto inmobiliario** basado en las negociaciones y contratos establecidos. Este proceso utiliza **Filament** para la gestión de formularios y recursos.

**Propósito:**  
Garantizar que los clientes tengan acceso a la plataforma para gestionar sus proyectos inmobiliarios y publicar anuncios.

---

## 2. Requisitos Funcionales Relacionados

| **ID**   | **Nombre del Requisito**                 | **Descripción**                                    |
|----------|------------------------------------------|--------------------------------------------------|
| `RF009` | Crear Usuario Proyecto Inmobiliario      | Permite a un ejecutivo registrar clientes para publicar proyectos. |


---

## 3. Base de Datos Relacionada

### Tablas Implicadas

#### Tabla: `proyecto_clientes`

| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                   |
|------------------------|-----------------|---------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único del proyecto.               |
| user_id                | BIGINT (FK)     | Constrained         | Relación con la tabla `users`.                  |
| razon_social           | VARCHAR(255)    | NOT NULL            | Razón social de la empresa.                     |
| ruc                    | VARCHAR(255)    | NOT NULL            | Número de RUC de la empresa.                    |
| direccion_fiscal       | VARCHAR(255)    | NOT NULL            | Dirección fiscal de la empresa.                 |
| telefono_inmobiliaria  | VARCHAR(255)    | NOT NULL            | Teléfono de contacto de la inmobiliaria.        |
| nombre_comercial       | VARCHAR(255)    |                     | Nombre comercial del proyecto inmobiliario.     |
| fecha_inicio_contrato  | DATE            | NOT NULL            | Fecha de inicio del contrato.                   |
| fecha_fin_contrato     | DATE            |                     | Fecha de fin del contrato.                      |
| numero_anuncios        | INT             | DEFAULT 0           | Número de anuncios contratados.                 |
| precio_plan            | DECIMAL(8,2)    |                     | Precio total del plan contratado.               |
| contrato_url           | VARCHAR(255)    |                     | URL del contrato firmado.                       |

#### Tabla: `users`

| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                   |
|------------------------|-----------------|---------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único del usuario.                |
| email                  | VARCHAR(255)    | UNIQUE, NOT NULL    | Correo electrónico del usuario.                 |
| password               | VARCHAR(255)    | NOT NULL            | Contraseña del usuario.                         |
| tipo_usuario_id        | BIGINT (FK)     | Constrained         | Relación con la tabla `tipo_usuario`.           |

#### Tabla: `proyecto_cronograma_pagos`

| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                   |
|------------------------|-----------------|---------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único del cronograma de pagos.    |
| proyecto_cliente_id    | BIGINT (FK)     | Constrained         | Relación con la tabla `proyecto_clientes`.      |
| fecha_programada       | DATE            | NOT NULL            | Fecha programada del pago.                      |
| monto                  | DECIMAL(8,2)    | NOT NULL            | Monto programado para el pago.                  |
| estado_pago_id         | BIGINT (FK)     | Constrained         | Estado actual del pago (Pendiente, Pagado, etc.). |

#### Tabla: `plan_user`

| **Columna**            | **Tipo**        | **Restricciones**   | **Descripción**                                   |
|------------------------|-----------------|---------------------|-------------------------------------------------|
| id                     | BIGINT (PK)     | AUTO_INCREMENT      | Identificador único del plan asignado al usuario. |
| user_id                | BIGINT (FK)     | Constrained         | Relación con la tabla `users`.                  |
| plan_id                | BIGINT (FK)     | Constrained         | Relación con la tabla `planes`.                 |
| start_date             | DATE            |                     | Fecha de inicio del plan.                       |
| end_date               | DATE            |                     | Fecha de fin del plan.                          |
| typical_ads_remaining  | INT             | DEFAULT 0           | Anuncios típicos restantes.                     |

---

## 4. Relación de Tablas

| **Tabla**              | **Relacionada Con**        | **Relación**                                     |
|------------------------|----------------------------|------------------------------------------------|
| `proyecto_clientes`    | `users`                   | Un cliente tiene un usuario asociado.          |
| `proyecto_cronograma_pagos` | `proyecto_clientes` | Un proyecto tiene múltiples pagos.             |
| `proyecto_cronograma_pagos` | `proyecto_pago_estados` | Un estado describe el estado actual del pago.  |

---

## 5. Componentes y Recursos Filament

### **Recurso: `ProyectoClienteResource`**

#### Ruta: `app/Filament/Resources/ProyectoClienteResource.php`
#### **Formulario**

El formulario de creación utiliza **Filament** para construir secciones y entradas dinámicas:

1. **Sección:** `Información de la Empresa`
   - `TextInput`:
     - `razon_social` - Campo obligatorio que valida longitud.
     - `ruc` - Campo obligatorio con validación numérica.
     - `direccion_fiscal` - Valida direcciones correctas.
     - `telefono_inmobiliaria` - Valida formato telefónico.

2. **Sección:** `Representantes Legales`
   - `Repeater`:
     - Campos como `nombre`, `tipo_documento` y `estado_civil`.

3. **Sección:** `Datos del Contrato`
   - `DatePicker` para `fecha_inicio_contrato`.
   - `Select` con opciones dinámicas para `periodo_plan`.

### **Recurso: `CreateProyectoCliente`**
#### Ruta: `app\Filament\Resources\ProyectoClienteResource\Pages\CreateProyectoCliente.php`

**Propósito:**  
Gestión completa de la creación de clientes del tipo **proyecto inmobiliario**, incluyendo validaciones, creación de usuarios asociados, generación de cronogramas de pago y manejo automatizado de contratos, todo mediante el framework Filament.

**Funciones Principales:**

- **Validación y Preparación de Datos:**  
  Utiliza el método `mutateFormDataBeforeCreate` para validar datos clave como el correo y preparar información adicional antes de guardar en la base de datos.

- **Procesos Posteriores a la Creación:**  
  - Envía credenciales al cliente y sus contactos habilitados.
  - Gestiona la subida del contrato y actualiza su URL.
  - Genera cronogramas de pago basados en el plan contratado.
  - Asocia al cliente con un plan activo mediante la tabla `proyecto_planes_activos`.

- **Notificaciones Automáticas:**  
  Envía notificaciones con credenciales al cliente y a sus contactos mediante el sistema de notificaciones de Laravel.

### **Método: `mutateFormDataBeforeCreate`**
#### Ruta: `CreateProyectoCliente@mutateFormDataBeforeCreate`

**Propósito:**  
Prepara y valida los datos del cliente antes de la creación del registro en la base de datos.

**Flujo Principal:**
1. **Validación del Correo:**  
   Verifica que el correo no esté previamente registrado.

   ```php
   $this->validateUserEmail($data['user_email']);
   ```

2. **Creación de Usuario:**  
   Genera un nuevo usuario asociado al cliente con contraseña aleatoria.

   ```php
   $user = User::create([
       'email' => $data['user_email'],
       'password' => Hash::make(Str::random(10)),
   ]);
   $data['user_id'] = $user->id;
   ```

3. **Cálculo de Fechas:**  
   Calcula automáticamente la fecha de finalización del contrato en base a la duración seleccionada.

   ```php
   $data['fecha_fin_contrato'] = Carbon::parse($data['fecha_inicio_contrato'])
       ->addMonths($data['periodo_plan']);
   ```

**Resumen:**  
El método `mutateFormDataBeforeCreate` es crucial para garantizar que los datos almacenados sean válidos y que se asocien correctamente a otros recursos, como usuarios y contratos.

---

## 7. Historial de Cambios

| **Versión** | **Fecha**       | **Cambios Realizados**           | **Autor**              |
|-------------|-----------------|----------------------------------|------------------------|
| v1.0        | 05/12/2024      | Documento técnico inicial creado | Walker Alfaro          |
