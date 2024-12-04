# Documento Funcional: Publicar inmueble como Propietario

## 1. Resumen
**Descripción:** El usuario con el perfil ***propietario*** puede publicar un inmueble.
**Propósito:** Darle visibilidad a los inmuebles, en venta o alquiler, de los usuarios del tipo *propietario*.

---

## 2. Requerimiento Funcional
**ID:** RFxxx
**Nombre del Requisito:** Publicar inmueble como Propietario.
**Descripción:** El usuario tipo **propietario** puede publicar un inmueble para su venta o alquiler, con el fin de que a través de la página de Puja inmobiliaria tenga un espacio en internet por el cual posibles interesados la compren o alquilen, agilizando esta búsqueda.
**Reglas de Negocio:**  
- Regla 1: El usuario debe estar registrado como **propietario**.
- Regla 2: El tipo de inmueble es obligatorio.
- Regla 3: Los campos dormitorios, baños, medios baños y estacionamientos son opcionales.
- Regla 4: Se debe elegir al menos un precio en soles o dólares.
- Regla 5: La superficie es obligatoria.
- Regla 6: La antiguedad es obligatoria.
- Regla 7: La imagen principal es obligatoria.
- Regla 8: Las imágenes adicionales son opcionales.
- Regla 9: Las *comodidades* y *adicionales* son opcionales.
- Regla 10: El formulario para subir los datos del inmueble está dividido en 6 pasos.
- Regla 11: Cada paso del formulario se guarda parcialmente en la base de datos.

---

## 3. Flujo:
1. El usuario inicia sesión como *propietario*.
2. Da clic sobre le botón *Publica Aquí*.
3. Selecciona *venta* o *alquiler*.
4. Selecciona ubicación.
5. Ingresa las características.
6. Selecciona la imagen principal.
7. Selecciona las imagenes adicionales.
8. Seleccionar las comodidades.
9. Selecciona los adicionales.
10. Da clic en **Guardar y Publicar**.
11. El usuario es redirigido a la publicación del inmueble.
12. El usuario puede editar la descripción del inmueble.
13. Se habilita el botón de ***+ Plan*** para comprar un plan.
14. El usuario puede elegir entre 1 a 5 avisos.
15. El usuario puede elegir entre tres planes diferentes: Premium, Top, Estándar.
16. El usuario realiza el pago del plan elegido.
17. El inmueble es publicado.

---

## 4. Artefactos Técnicos Relacionados
| **Requisito Funcional** | **Artefacto Técnico**                 | **Descripción**                                        |
|-------------------------|---------------------------------------|--------------------------------------------------------|
<!-- | RFxxx                   | TODO                                | TODO                                                    | -->

---

## 5. Historial de Cambios
|**Versión**   |**Fecha**    |**Cambios Realizados**     |**Autor**       |
|--------------|-------------|---------------------------|----------------|
|v1.0          |04/12/2024   |Documento inicial creado   |Walker Alfaro   |