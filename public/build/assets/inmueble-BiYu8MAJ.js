const u=document.querySelector("#fullText"),g=document.querySelector("#shortText"),i=document.querySelector("#verMasBtn"),o=document.querySelector("#verMenosBtn");i==null||i.addEventListener("click",()=>{u.style.display="block",g.style.display="none",i.style.display="none",o.style.display="block"});o==null||o.addEventListener("click",()=>{u.style.display="none",g.style.display="block",o.style.display="none",i.style.display="block"});let a=null;function f(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?h(e.active_plan_users):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function h(e){const s=document.getElementById("plans-container");s.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
        <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${t.name} </div>
            <div class="card-body">
                <ul class="list-unstyled m-0">
                    <li>Vence: <span class="fw-bold"> ${v(t.plan_user.end_date)} </span></li>
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
                data-premium-ads-remaining="${t.plan_user.premium_ads_remaining}"
                data-top-ads-remaining="${t.plan_user.top_ads_remaining}"
                data-typical-ads-remaining="${t.plan_user.typical_ads_remaining}"
            >
                Publicar con este Plan
            </button>
        </div>
    `,s.appendChild(n)}),document.querySelectorAll(".publicar-plan-btn").forEach(t=>{t.addEventListener("click",n=>{const l=n.target.getAttribute("data-plan-user-id"),r=n.target.getAttribute("data-plan-id");n.target.getAttribute("data-plan-tipo");const y=n.target.getAttribute("data-premium-ads-remaining"),b=n.target.getAttribute("data-top-ads-remaining"),_=n.target.getAttribute("data-typical-ads-remaining");document.getElementById("premiumAdsRemaining").innerText=y,document.getElementById("topAdsRemaining").innerText=b,document.getElementById("typicalAdsRemaining").innerText=_,a={plan_id:r,aviso_id:avisoId,plan_user_id:l}})})}var c;(c=document.getElementById("btnPremiumAds"))==null||c.addEventListener("click",()=>{a.tipo_aviso=3,console.log(a)});var d;(d=document.getElementById("btnTopAds"))==null||d.addEventListener("click",()=>{a.tipo_aviso=2,console.log(a)});var p;(p=document.getElementById("btnTypicalAds"))==null||p.addEventListener("click",()=>{a.tipo_aviso=1,console.log(a)});function v(e){const s=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=s.getDate(),l=t[s.getMonth()],r=s.getFullYear();return`${n} ${l} ${r}`}var m;(m=document.getElementById("siUsarEstePlan"))==null||m.addEventListener("click",()=>{a&&fetch("/contratar_plan",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(a)}).then(e=>e.json()).then(e=>{e.status==="Success"?(alert("Aviso publicado con exito"),window.location.href="/panel/avisos"):(console.error("Error al realizar la petición:",e.message),alert(e.message))}).catch(e=>{console.error("Error al realizar la petición:",e.message)})});document.addEventListener("DOMContentLoaded",()=>{avisoType||f()});