function setDeleteModal(title, id) {
	document.getElementById('aviso-title-to-delete').innerText = title;
	document.getElementById('aviso-id-to-delete').value = id;  // Asigna el ID del aviso al input oculto
}

window.setDeleteModal = setDeleteModal;

document.getElementById('delete-aviso-btn').addEventListener('click', function () {
  	const avisoId = document.getElementById('aviso-id-to-delete').value;
  
	fetch('/my-post/delete', {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Agrega el token CSRF
		},
		body: JSON.stringify({ aviso_id: avisoId }) // Enviar el ID del aviso como JSON
	})
	.then(response => response.json())
	.then(data => {
		if (data.htpp_code === 200) {
			alert('Aviso eliminado correctamente.');
			location.reload();
		} else {
			alert('Hubo un error al eliminar el aviso.');
		}
	})
	.catch(error => {
		console.error('Error:', error);
	});
});


function setCancelModal(title, id, estado) {
	let act_canc;
	if ( estado == 3 ) {
		act_canc = "Cancelar"
	} else if ( estado == 7 ) {
		act_canc = "Activar"
	}
	document.getElementById('aviso-cancelar-activar-main').innerText = act_canc.toLocaleLowerCase();
	document.getElementById('aviso-cancelar-activar').innerText = act_canc;
	document.getElementById('aviso-cancelar-activar-acept').innerText = act_canc;
	document.getElementById('aviso-title-to-cancel').innerText = title;
	document.getElementById('aviso-id-to-cancel').value = id;
	document.getElementById('aviso-estado-to-cancel').value = estado;
}

window.setCancelModal = setCancelModal;

document.getElementById('cancel-aviso-btn').addEventListener('click', function () {
	const avisoId = document.getElementById('aviso-id-to-cancel').value;
	const avisoEstado = document.getElementById('aviso-estado-to-cancel').value;

	const datos = {
		aviso_id: avisoId,
		aviso_estado: avisoEstado,
	}
	
	fetch('/my-post/cancel', {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		},
		body: JSON.stringify(datos)
	})
	.then(response => response.json())
	.then(data => {
		if (data.htpp_code === 200) {
			alert('Aviso actualizado correctamente.');
			location.reload();
		} else {
			alert('Hubo un error al actualizar el aviso.');
		}
	})
	.catch(error => {
		console.error('Error:', error);
	});
});