document.addEventListener('DOMContentLoaded', () => {

  const pageContactMessage = document.querySelector('#page-contact-message')

  // events
  pageContactMessage.addEventListener('input', textareaAutoincrement)

  // auto increment textarea
  function textareaAutoincrement() {
    pageContactMessage.style.height = "auto";
    pageContactMessage.style.height = this.scrollHeight + "px";
  }

  document.getElementById('send-page-contact').addEventListener('click', (event) => {
    event.preventDefault();
    clearErrors();
    submitForm(contactoUrl);
  });

  // Submit formulario
  function submitForm(actionUrl) {
    let form = document.getElementById('page-contact-formData');
    let formData = new FormData(form);

    fetch(actionUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "Success") {
            alert('Formulario enviado correctamente');
            form.reset();
            window.location.href='/';
        } else {
            handleErrors(data.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
  }

  function handleErrors(errors) {
    console.log(errors);
    
    for (const field in errors) {
        
        const inputElement = document.querySelector(`[name="${field}"]`);
        const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

        console.log(inputElement);
        

        if (inputElement && feedbackElement) {
            inputElement.classList.add('is-invalid');
            if(inputElement.getAttribute('id') === 'terminos') {
                feedbackElement.textContent = 'Acepte los términos';
            } else {
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


})