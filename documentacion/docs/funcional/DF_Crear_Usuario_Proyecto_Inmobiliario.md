---
sidebar_label: 'Crear Usuario Proyecto Inmobiliario'
sidebar_position: 9
title: 'Crear Usuario Proyecto Inmobiliario'
---

# Documento Funcional: Crear Usuario Proyecto Inmobiliario

## 1. Resumen
**Descripción:**  
Este flujo permite la creación de un perfil del tipo ***proyecto inmobiliario***. Dicho perfil se establece como resultado de negociaciones con el cliente. Los detalles acordados se reflejan en un contrato formal y en el formulario utilizado para crear la cuenta en **Puja Inmobiliaria**. 

**Propósito:**  
Facilitar al cliente el acceso a la plataforma para la publicación de sus *proyectos inmobiliarios*, respetando las condiciones del contrato.

---

## 2. Requerimiento Funcional
**ID:** `RF009`
**Nombre del Requerimiento:** Crear Usuario Proyecto Inmobiliario.

**Descripción:**  
Crear una cuenta del tipo **proyecto inmobiliario**, respetando las reglas definidas y los detalles del contrato establecido.

**Reglas de Negocio:**  
1. La *razón social* es obligatoria.  
2. El *RUC* es obligatorio.  
3. La *dirección fiscal* es obligatoria.  
4. El *teléfono de la empresa* es obligatorio.  
5. Se requiere al menos un representante legal.  
6. El *nombre del representante legal* es obligatorio.  
7. La *dirección* del representante legal es obligatoria.  
8. El *tipo de documento* del representante legal es obligatorio.  
9. El *número de documento* del representante legal es obligatorio.  
10. Se requiere al menos un contacto.  
11. El *nombre de la persona de contacto* es obligatorio.  
12. El *teléfono de la persona de contacto* es obligatorio.  
13. El *correo de la persona de contacto* es obligatorio.  
14. El **checkbox** *habilitar correo* es opcional.  
15. Habilitar Google Sheet es opcional y depende del trato con el cliente.  
16. La *fecha de inicio de contrato* es obligatoria.  
17. El *periodo del plan* es obligatorio.  
18. El *número de anuncios* es obligatorio.  
19. El *costo del proyecto* es obligatorio.  
20. El **checkbox** de *pago único* es opcional.  
21. El **checkbox** de *pago fraccionado* es opcional.  
22. El **checkbox** de *pago renovación automática* es opcional.  
23. El *contrato* (PDF) es obligatorio.  
24. El *correo electrónico de inicio de sesión* es obligatorio.  

---

## 3. Flujo
1. **Negociación:**  
   Se inicia una negociación con el cliente para definir los términos del contrato personalizado que permitirá la publicación de proyectos inmobiliarios.
2. **Inicio de Sesión:**  
   El **ejecutivo de cuenta** inicia sesión en el *panel administrador*.
3. **Acceso a la Función:**  
   El ejecutivo navega a la pestaña **Ejecutivo de Cuenta**.
4. **Inicio del Proceso:**  
   El ejecutivo da clic en el botón **Crear proyecto cliente**.
5. **Formulario:**  
   Se completa el formulario con la información del contrato y los detalles del cliente.
6. **Creación:**  
   Al finalizar, el ejecutivo da clic en el botón **Crear**, completando el proceso.

---

## 4. Artefactos Técnicos Relacionados

| **Artefacto Técnico**                         | **Descripción**                                                                 |
|-----------------------------------------------|---------------------------------------------------------------------------------|
| `ProyectoClienteResource`                     | Recurso de Filament para gestionar los datos de los clientes tipo proyecto.     |
| `CreateProyectoCliente`                       | Página específica de Filament para la creación de usuarios de proyectos.        |
| `mutateFormDataBeforeCreate`                  | Método encargado de validar y preparar datos antes de la creación.              |
| `ProyectoCliente`                             | Modelo Eloquent que representa la tabla de clientes tipo proyecto.              |
| `User`                                        | Modelo Eloquent que representa a los usuarios, asociado al cliente del proyecto.|
| `ProyectoCronogramaPago`                      | Modelo para gestionar el cronograma de pagos asociado al cliente.               |
| `ProyectoPlanesActivos`                       | Modelo que almacena la relación de los planes activos con el cliente.           |
| `ProyectoClienteContacto`                     | Modelo para gestionar los contactos asociados al cliente.                       |
| Notificaciones (`SendCredentialsProjectNotification`) | Sistema de notificaciones para el envío de credenciales y comunicación.         |

---

## 5. Historial de Cambios
| **Versión** | **Fecha**     | **Cambios Realizados**                | **Autor**         |
|-------------|---------------|----------------------------------------|-------------------|
| v1.0        | 05/12/2024    | Documento funcional inicial creado.    | Walker Alfaro     |
