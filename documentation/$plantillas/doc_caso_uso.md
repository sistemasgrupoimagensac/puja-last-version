# Caso de Uso: [Nombre del Caso de Uso]

## 1. Identificación
**ID del Caso de Uso:** CU-001  
**Nombre:** [Ejemplo: Registrar Cliente]  
**Actor Principal:** [Ejemplo: Usuario Administrador]  

---

## 2. Descripción
**Propósito:** [Permitir a los administradores registrar nuevos clientes en el sistema.]

---

## 3. Flujo Principal
1. El usuario accede al formulario de registro de clientes.
2. Llena los campos obligatorios: Razón Social, RUC, Dirección.
3. Presiona el botón "Registrar".
4. El sistema valida los datos.
5. El cliente se registra exitosamente en la base de datos.

---

## 4. Flujos Alternativos
- **FA1:** Error de validación: El RUC ya está registrado.
  - El sistema muestra un mensaje de error: "El RUC ya existe."
- **FA2:** Falta de datos obligatorios:
  - El sistema muestra un mensaje de error: "Complete los campos obligatorios."

---

## 5. Resultado Esperado
**Registro exitoso del cliente en la base de datos.**
