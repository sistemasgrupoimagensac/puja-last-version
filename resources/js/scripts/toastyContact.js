import * as bootstrap from 'bootstrap';

const toastContactTrigger = document.getElementById('toastBtnContact')
const toastContactForm = document.getElementById('contactToast')

if (toastContactTrigger) {
	const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastContactForm, {
		autohide: true,
		delay: 1000,
	});
	toastContactTrigger.addEventListener('click', () => {
		toastBootstrap.show()
	})
}

toastContactForm.addEventListener('hidden.bs.toast', () => {
  	window.location.href = contactoUrl
})