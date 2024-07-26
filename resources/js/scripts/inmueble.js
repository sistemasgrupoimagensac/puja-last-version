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
// ====================================================
let selectedPlanData = null; // Variable global para almacenar los datos del plan seleccionado

// cargar planes contratados
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

// pintar planes contratados
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
            <button 
              class="btn btn-dark fs-5 rounded-top-0 publicar-plan-btn" 
              data-bs-toggle="modal" 
              data-bs-target="#publicarAviso" 
              data-plan-user-id="${plan.plan_user.id}" 
              data-plan-id="${plan.id}"
              data-plan-tipo="${plan.name}"
            >
              Publicar con este Plan
            </button>
          </div>
      `
      plansContainer.appendChild(planCard)
  })

  // Add event listeners to each "Publicar con este Plan" button
  document.querySelectorAll('.publicar-plan-btn').forEach(button => {
      button.addEventListener('click', (event) => {
          const planUserId = event.target.getAttribute('data-plan-user-id')
          const planId = event.target.getAttribute('data-plan-id')
          const planTipo = event.target.getAttribute('data-plan-tipo')
          let tipoDeAviso = 1

          if(planTipo === 'Plan Top Plus') {
            tipoDeAviso = 3
          } else if (planTipo === 'Plan Top') {
            tipoDeAviso = 2
          } else if (planTipo === 'Estandar') {
            tipoDeAviso = 1
          }

          // Store the selected plan data
          selectedPlanData = {
              plan_id: planId,
              tipo_aviso: tipoDeAviso,
              aviso_id: avisoId,
              plan_user_id: planUserId
          }

          console.log(selectedPlanData);
      })
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

// Enviar POST cuando se acepta usar este plan para publicar el inmueble
document.getElementById('siUsarEstePlan').addEventListener('click', () => {
  if (selectedPlanData) {
      fetch('/publicar-aviso', {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(selectedPlanData)
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === "Success") {
              console.log('Petición realizada con éxito:', data)
          } else {
              console.error('Error al realizar la petición:', data.message)
          }
      })
      .catch(error => {
          console.error('Error al realizar la petición:', error.message)
      })
  }
})

// inicializar la carga de planes
fetchActivePlans()