const a=document.querySelector("#fullText"),c=document.querySelector("#shortText"),o=document.querySelector("#verMasBtn"),l=document.querySelector("#verMenosBtn");o==null||o.addEventListener("click",()=>{a.style.display="block",c.style.display="none",o.style.display="none",l.style.display="block"});l==null||l.addEventListener("click",()=>{a.style.display="none",c.style.display="block",l.style.display="none",o.style.display="block"});function d(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?(u(e.active_plan_users),console.log(e)):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function u(e){const t=document.getElementById("plans-container");t.innerHTML="",e.forEach(s=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
          <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${s.name} </div>
            <div class="card-body">
              <ul class=" list-unstyled m-0">
                <li>Vence: <span class="fw-bold"> ${p(s.plan_user.end_date)} </span></li>
                <li>Avisos Top Plus: <span class="fw-bold"> ${s.plan_user.premium_ads_remaining} </span></li>
                <li>Avisos Top: <span class="fw-bold"> ${s.plan_user.top_ads_remaining} </span></li>
                <li>Avisos Típicos: <span class="fw-bold"> ${s.plan_user.typical_ads_remaining} </span></li>
              </ul>
            </div>
            <button class="btn btn-dark fs-5 rounded-top-0" data-bs-toggle="modal" data-bs-target="#publicarAviso">
              Publicar con este Plan
            </button>
          </div>
      `,t.appendChild(n)})}function p(e){const t=new Date(e),s=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=t.getDate(),i=s[t.getMonth()],r=t.getFullYear();return`${n} ${i} ${r}`}const m=document.querySelector("#siUsarEstePlan");m.addEventListener("click",()=>{console.log("si usar este plan")});d();
