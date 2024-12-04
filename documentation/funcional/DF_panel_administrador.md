# Documento Funcional: Panel Administrador

## 1. Resumen
**Descripción:** Panel administrador.
**Propósito:** Administrar el Blog (crear y editar Posts), los Proyectos Inmobiliarios (crear nuevos Cliente Inmobiliario, manejar Leads interesados), y las transacciones (mostrar gráficos de las transacciones realizadas a través de la pasarela de pagos).

---

## 2. Requerimiento Funcional
**ID:** RFxxx
**Nombre del Requisito:** Implementación de un Panel Administrador.
**Descripción:** El Panel Administrador está implementado con [Filament PHP](https://filamentphp.com/), un paquete de software bajo la licencia MIT (software libre), que proporciona funcionalidades de administración visual, orientado exclusivamente para **Laravel** versión 10 en adelante.

---

## 3. Flujo:
1. Se accede al panel administrador por medio de la URL `/admin`.
2. Se ingresa el correo y contraseña de administrador.

---

## 4. Artefactos Técnicos Relacionados
| **Requisito Funcional** | **Artefacto Técnico**                                  | **Descripción**                                  |
|-------------------------|--------------------------------------------------------|--------------------------------------------------|
| RFxxx                   | Provider `App/Providers/Filament/AdminPanelProvider`   | Contiene los de un usuario para iniciar sesión   |


---

## 5. Historial de Cambios
|**Versión**   |**Fecha**    |**Cambios Realizados**     |**Autor**       |
|--------------|-------------|---------------------------|----------------|
|v1.0          |03/12/2024   |Documento inicial creado   |Walker Alfaro   |