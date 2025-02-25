const windowWidth = window.innerWidth

// Si el ancho de la ventana es mayor o igual a 992px, agrega la clase "show" a los acordeones
if (windowWidth >= 992) {
    const colapsaVentas = document.getElementById('flush-colapsaVentas')
    const colapsaAlquiler = document.getElementById('flush-colapsaAlquiler')
    const colapsaRemates = document.getElementById('flush-colapsaRemates')

    colapsaVentas.classList.add('show')
    colapsaAlquiler.classList.add('show')
    colapsaRemates.classList.add('show')
}

function animateCounter(element, start, end, duration) {
	let startTime = null;

	function step(timestamp) {
		if (!startTime) startTime = timestamp;
		let progress = timestamp - startTime;
		let current = Math.min(
			Math.floor(progress / duration * (end - start) + start),
			end
		);

		element.textContent = current.toLocaleString();

		if (current < end) {
			requestAnimationFrame(step);
		}
	}

  	requestAnimationFrame(step);
}

document.addEventListener('DOMContentLoaded', () => {
	const counterElement = document.getElementById("visit-counter");
	const views = document.getElementById("views").value
	animateCounter(counterElement, 0, views, 2000);
})