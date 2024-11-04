const resultadoConsultaDocContainer = document.querySelector('#resultadoConsultaDocContainer')
const errorConsultaDocContainer = document.querySelector('#errorConsultaDocContainer')
const resultadoEtiqueta = document.querySelector('#resultadoEtiqueta')
const resultadoTipoDoc = document.querySelector('#resultadoTipoDoc')
const resultadoConsultaDoc = document.querySelectorAll('.resultadoConsultaDoc')
const errorConsultaDoc = document.querySelector('#errorConsultaDoc')

resultadoConsultaDocContainer.style.display = 'none'
errorConsultaDocContainer.style.display = 'none'

document.getElementById('consultar-documento').addEventListener('click', (event) => {
  event.preventDefault()
  submitForm()
})

function submitForm() {
  let form = document.getElementById('consultarDocForm')
  const tipo = form.btnSelectDoc.value
  const documento = form.documento.value


  fetch("/consulta-dni-ruc", {
      method: 'POST',
      headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({ [tipo]: documento }),
  })
  .then(response => response.json())
  .then(data_response => {
      if (data_response.success) {

          if (data_response.data.ruc) {  

              resultadoConsultaDoc.forEach(nombre => {
                nombre.textContent = data_response.data.nombre_o_razon_social
              })

              resultadoTipoDoc.textContent = 'RUC'
              resultadoEtiqueta.textContent = 'Razón Social: '
              resultadoConsultaDocContainer.style.display = 'block'
              errorConsultaDocContainer.style.display = 'none'

          } else {

              resultadoConsultaDoc.forEach(nombre => {
                nombre.textContent = data_response.data.nombre_completo
              })

              resultadoTipoDoc.textContent = 'DNI'
              resultadoEtiqueta.textContent = 'Nombre: '
              resultadoConsultaDocContainer.style.display = 'block'
              errorConsultaDocContainer.style.display = 'none'
          }

      } else {
        resultadoConsultaDocContainer.style.display = 'none'
        errorConsultaDocContainer.style.display = 'block'
        errorConsultaDoc.textContent = data_response.message
      }
  })
  .catch(error => {
    console.error('Error:', error.message)
  })
}