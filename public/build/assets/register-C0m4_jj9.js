const a=document.getElementById("document_type"),m=document.getElementById("label_document_number"),r=document.getElementById("label_name"),n=document.getElementById("surename"),c=document.querySelector("#submit-register-button"),d=document.querySelector("#terminos");let o=!1;d.addEventListener("change",()=>{d.checked?o=!0:o=!1,s()});function s(){o===!1?c.disabled=!0:c.disabled=!1}s();a.addEventListener("change",function(){let l=a.value;console.log(l);let e="",t="";switch(l){case"1":e="DNI",t="Nombre",n.disabled=!1;break;case"3":e="RUC",t="Nombre o Razón Social",n.disabled=!0;break;case"2":e="Otro Documento",t="Nombre",n.disabled=!1;break;default:e="Documento",t="Nombre"}m.textContent=e,r.textContent=t});