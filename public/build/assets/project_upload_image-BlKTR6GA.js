document.addEventListener("DOMContentLoaded",function(){const d=document.getElementById("proyectoForm"),i=d?d.dataset.proyectoId:null,a=document.getElementById("proyectoImgDropZone"),r=document.getElementById("proyectoImgInput"),m=document.getElementById("proyectoImgPreviewContainer"),l=document.getElementById("proyectoImgUploadButton"),g=400*1024,s=50,u=document.querySelector('meta[name="csrf-token"]').getAttribute("content");let n=[];a.addEventListener("click",()=>r.click()),r.addEventListener("change",()=>{const e=Array.from(r.files);c(e),r.value=""}),a.addEventListener("dragover",e=>{e.preventDefault(),a.classList.add("dragover")}),a.addEventListener("dragleave",()=>a.classList.remove("dragover")),a.addEventListener("drop",e=>{e.preventDefault(),a.classList.remove("dragover"),c(Array.from(e.dataTransfer.files))}),l.addEventListener("click",()=>{if(n.length===0){alert("No has seleccionado ninguna imagen.");return}if(!i){alert("El ID del proyecto no está definido.");return}const e=new FormData;n.forEach(t=>{e.append("images[]",t)}),fetch(`/proyectos/${i}/imagenes`,{method:"POST",body:e,headers:{"X-CSRF-TOKEN":u}}).then(t=>{if(!t.ok)throw new Error(`Error al subir las imágenes: ${t.statusText}`);return t.json()}).then(t=>{alert("Imágenes subidas correctamente."),console.log("Imágenes subidas:",t.images)}).catch(t=>{console.error("Error al subir las imágenes:",t),alert("Hubo un error al subir las imágenes.")})});function c(e){e.forEach(t=>{p(t)&&(n.push(t),f(t))}),n.length>=s&&(r.disabled=!0)}function p(e){return e.size>g?(alert(`La imagen ${e.name} supera el tamaño máximo de 400KB.`),!1):["image/jpeg","image/png","image/webp"].includes(e.type)?n.length>=s?(alert("Has alcanzado el límite de 50 imágenes."),!1):!0:(alert(`El archivo ${e.name} no es un formato de imagen válido.`),!1)}function f(e){const t=new FileReader;t.onload=y=>{const o=document.createElement("div");o.classList.add("image-preview"),o.innerHTML=`
              <img src="${y.target.result}" alt="${e.name}">
              <button class="remove-image-btn btn-close d-flex justify-content-center align-items-center" data-name="${e.name}">
                <i class="fa-solid fa-xmark"></i>
              </button>
          `,m.appendChild(o),o.querySelector(".remove-image-btn").addEventListener("click",()=>{v(e.name),o.remove()})},t.readAsDataURL(e)}function v(e){n=n.filter(t=>t.name!==e),r.disabled=n.length>=s}});