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
    const planCard = document.createElement('div');
    planCard.classList.add('card');
    planCard.innerHTML = `
        <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${plan.name} </div>
            <div class="card-body">
                <ul class="list-unstyled m-0">
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
                data-premium-ads-remaining="${plan.plan_user.premium_ads_remaining}"
                data-top-ads-remaining="${plan.plan_user.top_ads_remaining}"
                data-typical-ads-remaining="${plan.plan_user.typical_ads_remaining}"
            >
                Publicar con este Plan
            </button>
        </div>
    `

    plansContainer.appendChild(planCard)
})

  // addeventlister dinamico por cada plan
  document.querySelectorAll('.publicar-plan-btn').forEach(button => {
    button.addEventListener('click', (event) => {
        const planUserId = event.target.getAttribute('data-plan-user-id')
        const planId = event.target.getAttribute('data-plan-id')
        const planTipo = event.target.getAttribute('data-plan-tipo')
        const premiumAdsRemaining = event.target.getAttribute('data-premium-ads-remaining')
        const topAdsRemaining = event.target.getAttribute('data-top-ads-remaining')
        const typicalAdsRemaining = event.target.getAttribute('data-typical-ads-remaining')

        // Actualizar modal con los valores correspondientes
        document.getElementById('premiumAdsRemaining').innerText = premiumAdsRemaining
        document.getElementById('topAdsRemaining').innerText = topAdsRemaining
        document.getElementById('typicalAdsRemaining').innerText = typicalAdsRemaining

        // Store the selected plan data
        selectedPlanData = {
            plan_id: planId,
            aviso_id: avisoId,
            plan_user_id: planUserId,
            tipo_aviso: null
        }
    })
  })
}

// Añadir eventos a los botones del modal para seleccionar el tipo de aviso
document.getElementById('btnPremiumAds')?.addEventListener('click', () => {
  selectedPlanData.tipo_aviso = 3 // Plan Top Plus
  console.log(selectedPlanData)
})
document.getElementById('btnTopAds')?.addEventListener('click', () => {
  selectedPlanData.tipo_aviso = 2 // Plan Top
  console.log(selectedPlanData)
})
document.getElementById('btnTypicalAds')?.addEventListener('click', () => {
  selectedPlanData.tipo_aviso = 1 // Plan Típico
  console.log(selectedPlanData)
})

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
document.getElementById('siUsarEstePlan')?.addEventListener('click', () => {
  if (selectedPlanData.tipo_aviso) {
    
      fetch('/contratar_plan', {
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
            alert('Aviso publicado con exito')
            window.location.href = '/panel/avisos'
          } else {
              console.error('Error al realizar la petición:', data.message)
              alert(data.message)
          }
      })
      .catch(error => {
          console.error('Error al realizar la petición:', error.message)
      })
  }
})

document.addEventListener('DOMContentLoaded', () => {
  if(!avisoType) {
    fetchActivePlans()
  }
})
