const u=document.querySelector("#fullText"),m=document.querySelector("#shortText"),s=document.querySelector("#verMasBtn"),o=document.querySelector("#verMenosBtn");s==null||s.addEventListener("click",()=>{u.style.display="block",m.style.display="none",s.style.display="none",o.style.display="block"});o==null||o.addEventListener("click",()=>{u.style.display="none",m.style.display="block",o.style.display="none",s.style.display="block"});let d=null;function b(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?y(e.active_plan_users):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function y(e){const a=document.getElementById("plans-container");a.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
          <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${t.name} </div>
            <div class="card-body">
              <ul class=" list-unstyled m-0">
                <li>Vence: <span class="fw-bold"> ${f(t.plan_user.end_date)} </span></li>
                <li>Avisos Top Plus: <span class="fw-bold"> ${t.plan_user.premium_ads_remaining} </span></li>
                <li>Avisos Top: <span class="fw-bold"> ${t.plan_user.top_ads_remaining} </span></li>
                <li>Avisos Típicos: <span class="fw-bold"> ${t.plan_user.typical_ads_remaining} </span></li>
              </ul>
            </div>
            <button 
              class="btn btn-dark fs-5 rounded-top-0 publicar-plan-btn" 
              data-bs-toggle="modal" 
              data-bs-target="#publicarAviso" 
              data-plan-user-id="${t.plan_user.id}" 
              data-plan-id="${t.id}"
              data-plan-tipo="${t.name}"
            >
              Publicar con este Plan
            </button>
          </div>
      `,a.appendChild(n)}),document.querySelectorAll(".publicar-plan-btn").forEach(t=>{t.addEventListener("click",n=>{const i=n.target.getAttribute("data-plan-user-id"),r=n.target.getAttribute("data-plan-id"),c=n.target.getAttribute("data-plan-tipo");let l=1;c==="Plan Top Plus"?l=3:c==="Plan Top"?l=2:c==="Estandar"&&(l=1),d={plan_id:r,tipo_aviso:l,aviso_id:avisoId,plan_user_id:i}})})}function f(e){const a=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=a.getDate(),i=t[a.getMonth()],r=a.getFullYear();return`${n} ${i} ${r}`}var p;(p=document.getElementById("siUsarEstePlan"))==null||p.addEventListener("click",()=>{d&&fetch("/publicar-aviso",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(d)}).then(e=>e.json()).then(e=>{e.status==="Success"?(alert("Aviso publicado con exito"),window.location.href="/panel/avisos"):console.error("Error al realizar la petición:",e.message)}).catch(e=>{console.error("Error al realizar la petición:",e.message)})});document.addEventListener("DOMContentLoaded",()=>{avisoType||b()});
