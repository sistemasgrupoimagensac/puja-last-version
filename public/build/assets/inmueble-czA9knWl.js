const p=document.querySelector("#fullText"),u=document.querySelector("#shortText"),s=document.querySelector("#verMasBtn"),o=document.querySelector("#verMenosBtn");s==null||s.addEventListener("click",()=>{p.style.display="block",u.style.display="none",s.style.display="none",o.style.display="block"});o==null||o.addEventListener("click",()=>{p.style.display="none",u.style.display="block",o.style.display="none",s.style.display="block"});let i=null;function m(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?(b(e.active_plan_users),console.log(e)):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function b(e){const a=document.getElementById("plans-container");a.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
          <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${t.name} </div>
            <div class="card-body">
              <ul class=" list-unstyled m-0">
                <li>Vence: <span class="fw-bold"> ${y(t.plan_user.end_date)} </span></li>
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
      `,a.appendChild(n)}),document.querySelectorAll(".publicar-plan-btn").forEach(t=>{t.addEventListener("click",n=>{const r=n.target.getAttribute("data-plan-user-id"),c=n.target.getAttribute("data-plan-id"),d=n.target.getAttribute("data-plan-tipo");let l=1;d==="Plan Top Plus"?l=3:d==="Plan Top"?l=2:d==="Estandar"&&(l=1),i={plan_id:c,tipo_aviso:l,aviso_id:avisoId,plan_user_id:r},console.log(i)})})}function y(e){const a=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=a.getDate(),r=t[a.getMonth()],c=a.getFullYear();return`${n} ${r} ${c}`}document.getElementById("siUsarEstePlan").addEventListener("click",()=>{i&&fetch("/publicar-aviso",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(i)}).then(e=>e.json()).then(e=>{e.status==="Success"?console.log("Petición realizada con éxito:",e):console.error("Error al realizar la petición:",e.message)}).catch(e=>{console.error("Error al realizar la petición:",e.message)})});m();
