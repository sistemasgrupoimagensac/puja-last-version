document.addEventListener("DOMContentLoaded",()=>{document.querySelectorAll("[id^='whatsapp_contact_button']").forEach(t=>{t.addEventListener("click",function(){const o=t.getAttribute("data-caract-id"),e=document.querySelector(`#whatsapp-dialog_${o}`);document.body.classList.add("modal-open"),e.showModal()})}),document.querySelectorAll("[id^='whatsapp-dialog']").forEach(t=>{t.addEventListener("close",function(){document.body.classList.remove("modal-open")}),t.addEventListener("click",function(o){o.target===t&&closeModal(t.getAttribute("data-caract-id"))})}),window.closeModal=function(t){const o=document.querySelector(`#whatsapp-dialog_${t}`);document.body.classList.remove("modal-open"),o.close()}});