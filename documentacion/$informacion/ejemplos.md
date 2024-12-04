# Documento Funcional: Gestión de Clientes

## Introducción
El sistema permitirá a los usuarios administrar clientes, contratos y planes activos.

## Requisitos Funcionales
### Crear un Cliente
- **ID:** RF001
- **Descripción:** El sistema debe permitir registrar un nuevo cliente ingresando datos básicos.
- **Flujo:**
  1. El usuario ingresa al módulo "Clientes".
  2. Hace clic en "Nuevo Cliente".
  3. Llena los campos obligatorios (razón social, RUC, dirección fiscal, teléfono).
  4. Guarda los datos.
- **Validaciones:**
  - El RUC debe ser único.
  - El teléfono debe cumplir con el formato `9XXXXXXXX`.
- **Resultado Esperado:** El cliente queda registrado en la base de datos.

### Editar Cliente
- **ID:** RF002
- **Descripción:** Permitir modificar la información de un cliente existente.

---

## **2. Documentación Funcional**
### **Ejemplo: Detalle de Funcionalidad**
<!-- ```markdown -->
# Documentación Funcional: Renovación de Contratos

## Introducción
Los contratos de los clientes deben renovarse automáticamente si el cliente tiene activada la opción de renovación automática.

## Flujo Principal
1. El sistema verifica si el cliente tiene la opción de renovación activada (`renovacion_automatica = true`).
2. Si la fecha actual coincide con la fecha de finalización del contrato (`fecha_fin_contrato`):
   - Se crea un nuevo contrato con las mismas condiciones que el anterior.
   - Se actualiza la fecha de inicio y fin.
3. Si la opción está desactivada, el contrato se marca como "finalizado".

## Campos Involucrados
- `ProyectoPlanesActivos.renovacion_automatica`
- `ProyectoPlanesActivos.fecha_inicio`
- `ProyectoPlanesActivos.fecha_fin`

## Validaciones
- El cliente debe estar "activo".
- No se puede renovar si existe un contrato pendiente de pago.

---

## **3. Manual de Usuario**
### **Ejemplo: Crear un Cliente**
<!-- ```markdown -->
# Manual de Usuario: Crear Cliente

## Introducción
Este módulo permite a los usuarios registrar clientes nuevos en el sistema.

## Pasos
1. Inicie sesión en el sistema.
2. Vaya al menú principal y haga clic en "Clientes".
3. Haga clic en el botón "Nuevo Cliente".
4. Complete los campos obligatorios:
   - **Razón Social**: Nombre oficial de la empresa.
   - **RUC**: Número único de contribuyente.
   - **Dirección Fiscal**: Dirección registrada de la empresa.
   - **Teléfono**: Número de contacto.
5. Presione "Guardar".
6. Si todos los datos son correctos, aparecerá un mensaje de confirmación.

## Captura de Pantalla
![Crear Cliente](https://example.com/crear-cliente.png)

---

## **4. Guía de Usuario**
### **Ejemplo: Renovación Automática**
<!-- ```markdown -->
# Guía de Usuario: Activar Renovación Automática

## Pasos
1. Inicie sesión en el sistema.
2. En el menú principal, haga clic en "Planes Activos".
3. Localice el plan que desea renovar automáticamente.
4. Active la opción "Renovación Automática" moviendo el interruptor al estado "ON".
5. Guarde los cambios.

---

## **5. Documentación de Casos de Uso**
### **Ejemplo: Crear Cliente**
<!-- ```markdown -->
# Caso de Uso: Crear Cliente

## Descripción
El usuario registra un cliente nuevo en el sistema.

## Actor(es)
- Usuario administrativo.

## Flujo Principal
1. El usuario accede al módulo "Clientes".
2. Hace clic en "Nuevo Cliente".
3. Llena los campos obligatorios y opcionales.
4. Presiona "Guardar".
5. El sistema valida los datos ingresados.
6. El cliente queda registrado en el sistema.

## Flujo Alternativo
- **Error en la validación:**
  1. Si el RUC ya existe, el sistema muestra un mensaje de error.
  2. El usuario corrige los datos y vuelve a intentarlo.

---

## **6. Documentación Técnica**
### **Ejemplo: Modelo `ProyectoCliente`**
<!-- ```markdown -->
# Modelo: ProyectoCliente

## Descripción
Este modelo representa a los clientes que tienen proyectos en el sistema.

## Relación con Otros Modelos
- `hasMany`: `ProyectoPlanesActivos`
- `hasMany`: `ProyectoClienteLegal`

## Campos Principales
- **razon_social:** Nombre de la empresa.
- **ruc:** Número único de contribuyente.
- **activo:** Indica si el cliente está activo.

## Ejemplo de Código
```php
public function planesActivos()
{
    return $this->hasMany(ProyectoPlanesActivos::class, 'proyecto_cliente_id');
}
