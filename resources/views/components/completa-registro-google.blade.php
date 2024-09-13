{{-- Si esta logueado con Google y faltan datos, se los debe pedir por medio de este Modal --}}
<div>
  <div class="modal fade" id="staticBackdropRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content p-2">
              <div class="modal-body">
                  <form id="formCompletaRegistro" class="d-flex flex-column gap-3">
                  @csrf
                      <fieldset class="d-flex flex-column gap-2">
                          <legend class="h4 m-0 p-0 icon-orange">Completa tu registro</legend>
    

                          <input type="hidden" name="accept_terms" value="1">

                          {{-- Teléfono --}}
                          <div class="form-floating">
                            <input type="phone" class="form-control shadow-none" id="phone" maxlength="9" minlength="9" name="telefono" placeholder="Teléfono">
                            <label class="text-secondary" for="phone">Teléfono</label>
                            <div id="validationServerTelefonoFeedback" class="invalid-feedback"></div>
                          </div>
                          
                          {{-- Tipo de documento --}}
                          <div class="form-floating">
                              <select class="form-select" id="document_type" name="tipo_documento">
                                  <option value="1" selected>DNI</option>
                                  <option value="3">RUC</option>
                                  <option value="2">Otro Documento</option>
                              </select>
                              <label for="document_type">Documento</label>
                              <div id="validationServerTipo_documentoFeedback" class="invalid-feedback"></div>
                          </div>
                          
                          {{-- Número de documento --}}
                          <div class="form-floating">
                              <input type="text" class="form-control" id="document_number" minlength="8" maxlength="20" name="numero_de_documento" placeholder="DNI">
                              <label class="text-secondary" for="document_number" id="label_document_number">DNI</label>
                              <div id="validationServerNumero_de_documentoFeedback" class="invalid-feedback"></div>
                          </div>

                          {{-- Dirección --}}
                          <div class="form-floating">
                              <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                              <label class="text-secondary" for="direccion" id="label_direccion">Dirección</label>
                              <div id="validationServerDireccionFeedback" class="invalid-feedback"></div>
                          </div>
      
                          {{-- Aceptación de los terminos --}}
                          <small class="text-body-tertiary py-1">
                            Al hacer click en Competar Registro, está aceptando nuestros <a href="/terminos-uso" target="blank" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="/politica-privacidad" target="blank" class="custom-link-register text-decoration-none">Políticas de Privacidad</a>
                          </small>
                      </fieldset>
                  
                      <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-completa-registro-google" value="COMPLETAR REGISTRO">
                  </form>

              </div>
          </div>
      </div>
  </div>
</div>

<script>

  document.getElementById('submit-completa-registro-google').addEventListener('click', (event) => {
    event.preventDefault();
    clearErrors();
    submitForm();
  });


  function submitForm() {
      let form = document.getElementById('formCompletaRegistro');

      let bodyTipoDoc = ''
      const tipo = form.tipo_documento.value
      const documento = form.numero_de_documento.value

      if(tipo === '1') {
        bodyTipoDoc = 'dni'
      } else if (tipo === '3') {
        bodyTipoDoc = 'ruc'
      } 

      fetch("/consulta-dni-ruc", {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ [bodyTipoDoc]: documento }),
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log('Response:', data)
              consultarFormulario();

          } else {
              console.log('Response error:', data)
              const errors = {
                numero_de_documento: [data.message],
              }
              console.log(errors);
              
              handleErrors(errors)
          }
      })
      .catch(error => {
          console.error('Error:', error.message)
      })
  }

  function consultarFormulario() {
    let form = document.getElementById('formCompletaRegistro');
    let formData = new FormData(form);

    fetch('/store-completeUserGoogle', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "Success") {
            alert(data.message)
            location.reload()
        } else {
            handleErrors(data.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
  }

  function handleErrors(errors) {
    for (const field in errors) {
        
        const inputElement = document.querySelector(`[name="${field}"]`);
        const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

        console.log(inputElement);
        

        if (inputElement && feedbackElement) {
            inputElement.classList.add('is-invalid');
            if(inputElement.getAttribute('id') === 'terminos') {
                feedbackElement.textContent = 'Acepte los términos';
            } else {
                console.log(errors[field]);
                
                feedbackElement.textContent = errors[field][0];
            }
        }
    }
  }

  function clearErrors() {
    const inputElements = document.querySelectorAll('.is-invalid');
    inputElements.forEach(element => {
      element.classList.remove('is-invalid');
    });

    const feedbackElement = document.querySelectorAll('.invalid-feedback');
    feedbackElement.forEach(element => {
      element.textContent = '';
    });
  }

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  
</script>