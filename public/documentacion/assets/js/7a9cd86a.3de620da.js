"use strict";(self.webpackChunkdocumentacion=self.webpackChunkdocumentacion||[]).push([[5924],{4257:(e,n,i)=>{i.r(n),i.d(n,{assets:()=>t,contentTitle:()=>l,default:()=>u,frontMatter:()=>c,metadata:()=>o,toc:()=>d});const o=JSON.parse('{"id":"funcional/DF_Iniciar_Sesion_Google","title":"Inicio de Sesi\xf3n con Google","description":"1. Resumen","source":"@site/docs/funcional/DF_Iniciar_Sesion_Google.md","sourceDirName":"funcional","slug":"/funcional/DF_Iniciar_Sesion_Google","permalink":"/documentacion/docs/funcional/DF_Iniciar_Sesion_Google","draft":false,"unlisted":false,"tags":[],"version":"current","sidebarPosition":4,"frontMatter":{"sidebar_label":"Inicio de Sesi\xf3n con Google","sidebar_position":4,"title":"Inicio de Sesi\xf3n con Google"},"sidebar":"documentationSidebar","previous":{"title":"Inicio de Sesi\xf3n","permalink":"/documentacion/docs/funcional/DF_Iniciar_Sesion"},"next":{"title":"Publicar Inmueble Propietario","permalink":"/documentacion/docs/funcional/DF_Publicar_Inmueble_Propietario"}}');var s=i(4848),r=i(8453);const c={sidebar_label:"Inicio de Sesi\xf3n con Google",sidebar_position:4,title:"Inicio de Sesi\xf3n con Google"},l="Documento Funcional: Iniciar Sesi\xf3n con Google",t={},d=[{value:"1. Resumen",id:"1-resumen",level:2},{value:"2. Requerimiento Funcional",id:"2-requerimiento-funcional",level:2},{value:"3. Flujo:",id:"3-flujo",level:2},{value:"4. Artefactos T\xe9cnicos Relacionados",id:"4-artefactos-t\xe9cnicos-relacionados",level:2},{value:"5. Historial de Cambios",id:"5-historial-de-cambios",level:2}];function a(e){const n={code:"code",h1:"h1",h2:"h2",header:"header",hr:"hr",li:"li",ol:"ol",p:"p",strong:"strong",table:"table",tbody:"tbody",td:"td",th:"th",thead:"thead",tr:"tr",ul:"ul",...(0,r.R)(),...e.components};return(0,s.jsxs)(s.Fragment,{children:[(0,s.jsx)(n.header,{children:(0,s.jsx)(n.h1,{id:"documento-funcional-iniciar-sesi\xf3n-con-google",children:"Documento Funcional: Iniciar Sesi\xf3n con Google"})}),"\n",(0,s.jsx)(n.h2,{id:"1-resumen",children:"1. Resumen"}),"\n",(0,s.jsxs)(n.p,{children:[(0,s.jsx)(n.strong,{children:"Descripci\xf3n:"})," El sistema debe permitir iniciar sesi\xf3n con una cuenta de Google en s\xf3lo clic.\n",(0,s.jsx)(n.strong,{children:"Prop\xf3sito:"})," Flexibilizar el proceso de registro iniciando sesi\xf3n directamente con una cuenta de Google."]}),"\n",(0,s.jsx)(n.hr,{}),"\n",(0,s.jsx)(n.h2,{id:"2-requerimiento-funcional",children:"2. Requerimiento Funcional"}),"\n",(0,s.jsxs)(n.p,{children:[(0,s.jsx)(n.strong,{children:"ID:"})," ",(0,s.jsx)(n.code,{children:"RF004"}),"\n",(0,s.jsx)(n.strong,{children:"Nombre del Requisito:"})," Iniciar sesi\xf3n con Google.\n",(0,s.jsx)(n.strong,{children:"Descripci\xf3n:"})," Permitir a los usuarios iniciar sesi\xf3n con su cuenta de Google, por lo que no ser\xe1 necesario pasar por el proceso de registro ni crear una contrase\xf1a, debe ser suficiente con un correo Gmail registrado en el navegador.\n",(0,s.jsx)(n.strong,{children:"Reglas de Negocio:"})]}),"\n",(0,s.jsxs)(n.ul,{children:["\n",(0,s.jsx)(n.li,{children:"Regla 1: El usuario requiere un correo de Gmail activo."}),"\n",(0,s.jsx)(n.li,{children:"Regla 2: S\xf3lo se permite un tipo de usuario por correo electr\xf3nico."}),"\n",(0,s.jsx)(n.li,{children:"Regla 3: Existen tres tipos de perfil que pueden iniciar sesi\xf3n con una cuenta de Google: propietario, corredor, acreedor."}),"\n"]}),"\n",(0,s.jsx)(n.hr,{}),"\n",(0,s.jsx)(n.h2,{id:"3-flujo",children:"3. Flujo:"}),"\n",(0,s.jsxs)(n.ol,{children:["\n",(0,s.jsx)(n.li,{children:"El usuario accede a la pantalla de inicio de sesi\xf3n."}),"\n",(0,s.jsx)(n.li,{children:"Le da clic en el bot\xf3n de Google."}),"\n",(0,s.jsx)(n.li,{children:"Selecciona un correo Gmail para iniciar sesi\xf3n."}),"\n",(0,s.jsx)(n.li,{children:"El usuario es registrado en el Sistema con su correo de Gmail."}),"\n"]}),"\n",(0,s.jsx)(n.hr,{}),"\n",(0,s.jsx)(n.h2,{id:"4-artefactos-t\xe9cnicos-relacionados",children:"4. Artefactos T\xe9cnicos Relacionados"}),"\n",(0,s.jsxs)(n.table,{children:[(0,s.jsx)(n.thead,{children:(0,s.jsxs)(n.tr,{children:[(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Artefacto T\xe9cnico"})}),(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Descripci\xf3n"})})]})}),(0,s.jsxs)(n.tbody,{children:[(0,s.jsxs)(n.tr,{children:[(0,s.jsxs)(n.td,{children:["Tabla ",(0,s.jsx)(n.code,{children:"users"})]}),(0,s.jsx)(n.td,{children:"Contiene los datos de un usuario para iniciar sesi\xf3n"})]}),(0,s.jsxs)(n.tr,{children:[(0,s.jsxs)(n.td,{children:["Modelo ",(0,s.jsx)(n.code,{children:"User"})]}),(0,s.jsx)(n.td,{children:"Representa la l\xf3gica del cliente."})]}),(0,s.jsxs)(n.tr,{children:[(0,s.jsxs)(n.td,{children:["Controlador ",(0,s.jsx)(n.code,{children:"selectAccountGoogle()"})]}),(0,s.jsx)(n.td,{children:"M\xe9todo que selecciona la cuenta de Google"})]}),(0,s.jsxs)(n.tr,{children:[(0,s.jsxs)(n.td,{children:["Vista ",(0,s.jsx)(n.code,{children:"auth.signin"})]}),(0,s.jsx)(n.td,{children:"Pantalla de inicio de sesi\xf3n."})]})]})]}),"\n",(0,s.jsx)(n.hr,{}),"\n",(0,s.jsx)(n.h2,{id:"5-historial-de-cambios",children:"5. Historial de Cambios"}),"\n",(0,s.jsxs)(n.table,{children:[(0,s.jsx)(n.thead,{children:(0,s.jsxs)(n.tr,{children:[(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Versi\xf3n"})}),(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Fecha"})}),(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Cambios Realizados"})}),(0,s.jsx)(n.th,{children:(0,s.jsx)(n.strong,{children:"Autor"})})]})}),(0,s.jsx)(n.tbody,{children:(0,s.jsxs)(n.tr,{children:[(0,s.jsx)(n.td,{children:"v1.0"}),(0,s.jsx)(n.td,{children:"03/12/2024"}),(0,s.jsx)(n.td,{children:"Documento inicial creado"}),(0,s.jsx)(n.td,{children:"Walker Alfaro"})]})})]})]})}function u(e={}){const{wrapper:n}={...(0,r.R)(),...e.components};return n?(0,s.jsx)(n,{...e,children:(0,s.jsx)(a,{...e})}):a(e)}},8453:(e,n,i)=>{i.d(n,{R:()=>c,x:()=>l});var o=i(6540);const s={},r=o.createContext(s);function c(e){const n=o.useContext(r);return o.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function l(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(s):e.components||s:c(e.components),o.createElement(r.Provider,{value:n},e.children)}}}]);