# Documento Funcional: Publicar inmueble como Corredor

## 1. Resumen
**Descripción:** El usuario con el perfil ***corredor*** puede comprar un paquete de publicaciones y publicar su cartera de inmuebles.
**Propósito:** Darle visibilidad a los inmuebles, en venta o alquiler, de los usuarios del tipo *corredor*.

---

## 2. Requerimiento Funcional
**ID:** RFxxx
**Nombre del Requisito:** Publicar inmueble como Corredor.
**Descripción:** El usuario tipo **corredor** puede publicar su cartera de inmuebles para su venta o alquiler, con el fin de que a través de la página de Puja inmobiliaria tenga un espacio en internet por el cual posibles interesados las compren o alquilen, agilizando esta búsqueda.
**Reglas de Negocio:**  
- Regla 1: El usuario debe estar registrado como **corredor**.
- Regla 2: Se debe adquirir previamente un plan o paquete de anuncios.
- Regla 3: El tipo de inmueble es obligatorio.
- Regla 4: Los campos dormitorios, baños, medios baños y estacionamientos son opcionales.
- Regla 5: Se debe elegir al menos un precio en soles o dólares.
- Regla 6: La superficie es obligatoria.
- Regla 7: La antiguedad es obligatoria.
- Regla 8: La imagen principal es obligatoria.
- Regla 9: Las imágenes adicionales son opcionales.
- Regla 10: Las *comodidades* y *adicionales* son opcionales.
- Regla 11: El formulario para subir los datos del inmueble está dividido en 6 pasos.
- Regla 12: Cada paso del formulario se guarda parcialmente en la base de datos.

---

## 3. Flujo:
1. El usuario inicia sesión como *corredor*.
2. Da clic sobre le botón *Publica Aquí*.
3. Selecciona y adquiere un plan (paque de anuncios).
4. Selecciona *venta* o *alquiler*.
5. Selecciona ubicación.
6. Ingresa las características.
7. Selecciona la imagen principal.
8. Selecciona las imagenes adicionales.
9. Seleccionar las comodidades.
10. Selecciona los adicionales.
11. Da clic en **Guardar y Publicar**.
12. El usuario es redirigido a la publicación del inmueble.
13. El usuario puede editar la descripción del inmueble.
14. El usuario puede elegir en cual plan (adquirido previamente) quiere publicar.
15. Elegido el plan, el anuncio es publicado.

---

## 4. Artefactos Técnicos Relacionados
| **Requisito Funcional** | **Artefacto Técnico**                 | **Descripción**                                        |
|-------------------------|---------------------------------------|--------------------------------------------------------|
<!-- | RFxxx                   | TODO:                                | TODO:                                                   | -->

---

## 5. Historial de Cambios
|**Versión**   |**Fecha**    |**Cambios Realizados**     |**Autor**       |
|--------------|-------------|---------------------------|----------------|
|v1.0          |04/12/2024   |Documento inicial creado   |Walker Alfaro   |