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
      // Aquí puedes recargar la página o eliminar el aviso del DOM sin recargar
      location.reload();
    } else {
      alert('Hubo un error al eliminar el aviso.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});
