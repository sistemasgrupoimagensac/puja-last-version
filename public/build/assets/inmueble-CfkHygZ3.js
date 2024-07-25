const l=document.querySelector("#fullText"),c=document.querySelector("#shortText"),o=document.querySelector("#verMasBtn"),a=document.querySelector("#verMenosBtn");o==null||o.addEventListener("click",()=>{l.style.display="block",c.style.display="none",o.style.display="none",a.style.display="block"});a==null||a.addEventListener("click",()=>{l.style.display="none",c.style.display="block",a.style.display="none",o.style.display="block"});function d(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?(p(e.active_plan_users),console.log(e)):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function p(e){const s=document.getElementById("plans-container");s.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
          <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${t.name} </div>
            <div class="card-body">
              <ul class=" list-unstyled m-0">
                <li>Vence: <span class="fw-bold"> ${u(t.plan_user.end_date)} </span></li>
                <li>Avisos Top Plus: <span class="fw-bold"> ${t.plan_user.premium_ads_remaining} </span></li>
                <li>Avisos Top: <span class="fw-bold"> ${t.plan_user.top_ads_remaining} </span></li>
                <li>Avisos Típicos: <span class="fw-bold"> ${t.plan_user.typical_ads_remaining} </span></li>
              </ul>
            </div>
            <button class="btn btn-dark fs-5 rounded-top-0" data-bs-toggle="modal" data-bs-target="#publicarAviso">
              Publicar con este Plan
            </button>
          </div>
      `,s.appendChild(n)})}function u(e){const s=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=s.getDate(),i=t[s.getMonth()],r=s.getFullYear();return`${n} ${i} ${r}`}d();
