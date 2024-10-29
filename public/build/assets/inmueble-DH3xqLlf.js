const u=document.querySelector("#fullText"),g=document.querySelector("#shortText"),s=document.querySelector("#verMasBtn"),o=document.querySelector("#verMenosBtn");s==null||s.addEventListener("click",()=>{u.style.display="block",g.style.display="none",s.style.display="none",o.style.display="block"});o==null||o.addEventListener("click",()=>{u.style.display="none",g.style.display="block",o.style.display="none",s.style.display="block"});let a=null;function f(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?v(e.active_plan_users):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function v(e){const i=document.getElementById("plans-container");i.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
        <div class="card text-bg-light">
            <div class="card-header fw-bold h5"> ${t.name} </div>
            <div class="card-body">
                <ul class="list-unstyled m-0">
                    <li>Vence: <span class="fw-bold"> ${h(t.plan_user.end_date)} </span></li>
                    <li>Avisos Premium: <span class="fw-bold"> ${t.plan_user.premium_ads_remaining} </span></li>
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
    `,i.appendChild(n)}),document.querySelectorAll(".publicar-plan-btn").forEach(t=>{t.addEventListener("click",n=>{const l=n.target.getAttribute("data-plan-user-id"),r=n.target.getAttribute("data-plan-id");n.target.getAttribute("data-plan-tipo");const y=n.target.getAttribute("data-premium-ads-remaining"),b=n.target.getAttribute("data-top-ads-remaining"),_=n.target.getAttribute("data-typical-ads-remaining");document.getElementById("premiumAdsRemaining").innerText=y,document.getElementById("topAdsRemaining").innerText=b,document.getElementById("typicalAdsRemaining").innerText=_,a={plan_id:r,aviso_id:avisoId,plan_user_id:l,tipo_aviso:null}})})}var d;(d=document.getElementById("btnPremiumAds"))==null||d.addEventListener("click",()=>{a.tipo_aviso=3,console.log(a)});var c;(c=document.getElementById("btnTopAds"))==null||c.addEventListener("click",()=>{a.tipo_aviso=2,console.log(a)});var p;(p=document.getElementById("btnTypicalAds"))==null||p.addEventListener("click",()=>{a.tipo_aviso=1,console.log(a)});function h(e){const i=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=i.getDate(),l=t[i.getMonth()],r=i.getFullYear();return`${n} ${l} ${r}`}document.getElementById("loader-overlay");var m;(m=document.getElementById("siUsarEstePlan"))==null||m.addEventListener("click",function(){this.disabled=!0,a.tipo_aviso&&fetch("/contratar_plan",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(a)}).then(e=>e.json()).then(e=>{e.status==="Success"?(alert("Aviso publicado con exito"),window.location.href="/panel/avisos"):(this.disabled=!1,console.error("Error al realizar la petición:",e.message),alert(e.message))}).catch(e=>{console.error("Error al realizar la petición:",e.message)})});document.addEventListener("DOMContentLoaded",()=>{avisoType||f()});
