const b=document.querySelector("#fullText"),f=document.querySelector("#shortText"),r=document.querySelector("#verMasBtn"),l=document.querySelector("#verMenosBtn");r==null||r.addEventListener("click",()=>{b.style.display="block",f.style.display="none",r.style.display="none",l.style.display="block"});l==null||l.addEventListener("click",()=>{b.style.display="none",f.style.display="block",l.style.display="none",r.style.display="block"});let o=null;function v(){fetch("/planes-user",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")}}).then(e=>e.json()).then(e=>{e.status==="OK"?_(e.active_plan_users):console.error("Error fetching active plans:",e.message)}).catch(e=>{console.error("Error fetching active plans:",e.message)})}function _(e){const a=document.getElementById("plans-container");a.innerHTML="",e.forEach(t=>{const n=document.createElement("div");n.classList.add("card"),n.innerHTML=`
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
		`,a.appendChild(n)}),document.querySelectorAll(".publicar-plan-btn").forEach(t=>{t.addEventListener("click",n=>{const i=n.target.getAttribute("data-plan-user-id"),s=n.target.getAttribute("data-plan-id");n.target.getAttribute("data-plan-tipo");const c=n.target.getAttribute("data-premium-ads-remaining"),m=n.target.getAttribute("data-top-ads-remaining"),d=n.target.getAttribute("data-typical-ads-remaining");document.getElementById("premiumAdsRemaining").innerText=c,document.getElementById("topAdsRemaining").innerText=m,document.getElementById("typicalAdsRemaining").innerText=d,o={plan_id:s,aviso_id:avisoId,plan_user_id:i,tipo_aviso:null}})})}var u;(u=document.getElementById("btnPremiumAds"))==null||u.addEventListener("click",()=>{o.tipo_aviso=3});var p;(p=document.getElementById("btnTopAds"))==null||p.addEventListener("click",()=>{o.tipo_aviso=2});var g;(g=document.getElementById("btnTypicalAds"))==null||g.addEventListener("click",()=>{o.tipo_aviso=1});function h(e){const a=new Date(e),t=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],n=a.getDate(),i=t[a.getMonth()],s=a.getFullYear();return`${n} ${i} ${s}`}document.getElementById("loader-overlay");var y;(y=document.getElementById("siUsarEstePlan"))==null||y.addEventListener("click",function(){this.disabled=!0,o.tipo_aviso&&fetch("/contratar_plan",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(o)}).then(e=>e.json()).then(e=>{e.status==="Success"?(alert("Aviso publicado con exito"),window.location.href="/panel/avisos"):(this.disabled=!1,console.error("Error al realizar la petición:",e.message),alert(e.message))}).catch(e=>{console.error("Error al realizar la petición:",e.message)})});function E(e,a,t,n){let i=null;function s(c){i||(i=c);let m=c-i,d=Math.min(Math.floor(m/n*(t-a)+a),t);e.textContent=d.toLocaleString(),d<t&&requestAnimationFrame(s)}requestAnimationFrame(s)}document.addEventListener("DOMContentLoaded",()=>{avisoType||v();const e=document.getElementById("visit-counter"),a=document.getElementById("views").value;E(e,0,a,2e3)});
