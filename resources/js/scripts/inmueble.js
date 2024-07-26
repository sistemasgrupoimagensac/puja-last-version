// logica para ver mas o menos texto de la descripcion
const fullText = document.querySelector('#fullText')
const shortText = document.querySelector('#shortText')

const verMasBtn = document.querySelector('#verMasBtn')
const verMenosBtn = document.querySelector('#verMenosBtn')

verMasBtn?.addEventListener('click', () => {
  fullText.style.display = 'block'
  shortText.style.display = 'none'
  verMasBtn.style.display = 'none'
  verMenosBtn.style.display = 'block'
})

verMenosBtn?.addEventListener('click', () => {
  fullText.style.display = 'none'
  shortText.style.display = 'block'
  verMenosBtn.style.display = 'none'
  verMasBtn.style.display = 'block'
})

// pintar planes contratados
function fetchActivePlans() {
  fetch('/planes-user', {
      method: 'POST',
      headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
  })
  .then(response => response.json())
  .then(data => {
      if (data.status === "OK") {
          renderPlans(data.active_plan_users)
          console.log(data)
      } else {
          console.error('Error fetching active plans:', data.message)
      }
  })
  .catch(error => {
      console.error('Error fetching active plans:', error.message)
  })
}

function renderPlans(plans) {
  const plansContainer = document.getElementById('plans-container')
  plansContainer.innerHTML = '' // Clear any existing content

  plans.forEach(plan => {
      const planCard = document.createElement('div')
      planCard.classList.add('card')
      planCard.innerHTML = `
          <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${plan.name} </div>
            <div class="card-body">
              <ul class=" list-unstyled m-0">
                <li>Vence: <span class="fw-bold"> ${formatDate(plan.plan_user.end_date)} </span></li>
                <li>Avisos Top Plus: <span class="fw-bold"> ${plan.plan_user.premium_ads_remaining} </span></li>
                <li>Avisos Top: <span class="fw-bold"> ${plan.plan_user.top_ads_remaining} </span></li>
                <li>Avisos Típicos: <span class="fw-bold"> ${plan.plan_user.typical_ads_remaining} </span></li>
              </ul>
            </div>
            <button class="btn btn-dark fs-5 rounded-top-0" data-bs-toggle="modal" data-bs-target="#publicarAviso">
              Publicar con este Plan
            </button>
          </div>
      `
      plansContainer.appendChild(planCard)
  })
}

function formatDate(dateString) {
  const date = new Date(dateString)
  const monthNames = [
      "enero", "febrero", "marzo", "abril", "mayo", "junio",
      "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
  ]

  const day = date.getDate()
  const month = monthNames[date.getMonth()]
  const year = date.getFullYear()

  return `${day} ${month} ${year}`
}

// utilizar plan comprado previamente
const si = document.querySelector('#siUsarEstePlan')

/* si.addEventListener('click', () => {

  console.log('si usar este plan');

}) */

fetchActivePlans()