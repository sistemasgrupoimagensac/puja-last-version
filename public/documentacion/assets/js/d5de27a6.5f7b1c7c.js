"use strict";(self.webpackChunkdocumentacion=self.webpackChunkdocumentacion||[]).push([[9563],{9533:(e,n,i)=>{i.r(n),i.d(n,{assets:()=>c,contentTitle:()=>l,default:()=>h,frontMatter:()=>a,metadata:()=>o,toc:()=>t});const o=JSON.parse('{"id":"funcional/DF_Pago_Proyecto_Inmobiliario","title":"Pago Proyecto Inmobiliario","description":"---","source":"@site/docs/funcional/DF_Pago_Proyecto_Inmobiliario.md","sourceDirName":"funcional","slug":"/funcional/DF_Pago_Proyecto_Inmobiliario","permalink":"/documentacion/docs/funcional/DF_Pago_Proyecto_Inmobiliario","draft":false,"unlisted":false,"tags":[],"version":"current","sidebarPosition":11,"frontMatter":{"sidebar_label":"Pago Proyecto Inmobiliario","sidebar_position":11,"title":"Pago Proyecto Inmobiliario"},"sidebar":"documentationSidebar","previous":{"title":"Pago Propietario, Corredor, Acreedor","permalink":"/documentacion/docs/funcional/DF_Pago_Propietario_Corredor_Acreedor"},"next":{"title":"Manejo de Leads Proyecto","permalink":"/documentacion/docs/funcional/DF_Manejo_Leads_Proyecto"}}');var r=i(4848),s=i(8453);const a={sidebar_label:"Pago Proyecto Inmobiliario",sidebar_position:11,title:"Pago Proyecto Inmobiliario"},l="Documento Funcional: Pago de Proyectos Inmobiliarios",c={},t=[{value:"1. Resumen",id:"1-resumen",level:2},{value:"2. Requerimiento Funcional",id:"2-requerimiento-funcional",level:2},{value:"3. Flujo",id:"3-flujo",level:2},{value:"Flujo General:",id:"flujo-general",level:3},{value:"Diagrama de Flujo (Mermaid):",id:"diagrama-de-flujo-mermaid",level:3},{value:"4. Artefactos T\xe9cnicos Relacionados",id:"4-artefactos-t\xe9cnicos-relacionados",level:2},{value:"5. Historial de Cambios",id:"5-historial-de-cambios",level:2}];function d(e){const n={br:"br",code:"code",h1:"h1",h2:"h2",h3:"h3",header:"header",hr:"hr",li:"li",mermaid:"mermaid",ol:"ol",p:"p",strong:"strong",table:"table",tbody:"tbody",td:"td",th:"th",thead:"thead",tr:"tr",ul:"ul",...(0,s.R)(),...e.components};return(0,r.jsxs)(r.Fragment,{children:[(0,r.jsx)(n.header,{children:(0,r.jsx)(n.h1,{id:"documento-funcional-pago-de-proyectos-inmobiliarios",children:"Documento Funcional: Pago de Proyectos Inmobiliarios"})}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h2,{id:"1-resumen",children:"1. Resumen"}),"\n",(0,r.jsxs)(n.p,{children:[(0,r.jsx)(n.strong,{children:"Descripci\xf3n:"}),(0,r.jsx)(n.br,{}),"\n","Este flujo permite a los clientes de proyectos inmobiliarios realizar pagos asociados a contratos. Los pagos pueden ser \xfanicos o fraccionados, y se procesan de forma segura utilizando OpenPay."]}),"\n",(0,r.jsxs)(n.p,{children:[(0,r.jsx)(n.strong,{children:"Prop\xf3sito:"}),(0,r.jsx)(n.br,{}),"\n","Facilitar el pago de contratos de proyectos inmobiliarios, garantizar la trazabilidad de las transacciones y permitir a los clientes cumplir con sus obligaciones financieras de manera eficiente."]}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h2,{id:"2-requerimiento-funcional",children:"2. Requerimiento Funcional"}),"\n",(0,r.jsxs)(n.p,{children:[(0,r.jsx)(n.strong,{children:"ID:"})," ",(0,r.jsx)(n.code,{children:"RF011"}),(0,r.jsx)(n.br,{}),"\n",(0,r.jsx)(n.strong,{children:"Nombre del Requisito:"})," Gesti\xf3n y Procesamiento de Pagos para Proyectos Inmobiliarios"]}),"\n",(0,r.jsxs)(n.p,{children:[(0,r.jsx)(n.strong,{children:"Descripci\xf3n:"}),(0,r.jsx)(n.br,{}),"\n","El sistema debe permitir a los clientes de proyectos inmobiliarios realizar pagos en l\xednea, registrar las transacciones y emitir comprobantes electr\xf3nicos. Adem\xe1s, debe manejar pagos fraccionados y \xfanicos seg\xfan las condiciones del contrato."]}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Reglas de Negocio:"})}),"\n",(0,r.jsxs)(n.ol,{children:["\n",(0,r.jsx)(n.li,{children:"Los clientes con pagos pendientes deben ser redirigidos autom\xe1ticamente al flujo de pago."}),"\n",(0,r.jsx)(n.li,{children:"Los pagos pueden ser \xfanicos o fraccionados seg\xfan las condiciones del contrato."}),"\n",(0,r.jsx)(n.li,{children:"Los pagos se procesan exclusivamente mediante OpenPay."}),"\n",(0,r.jsx)(n.li,{children:"Los clientes no pueden realizar pagos adicionales si ya est\xe1n al d\xeda con sus obligaciones financieras."}),"\n"]}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h2,{id:"3-flujo",children:"3. Flujo"}),"\n",(0,r.jsx)(n.h3,{id:"flujo-general",children:"Flujo General:"}),"\n",(0,r.jsxs)(n.ol,{children:["\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Inicio de Sesi\xf3n:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"El cliente inicia sesi\xf3n en el sistema."}),"\n",(0,r.jsx)(n.li,{children:"Si tiene pagos pendientes, se redirige autom\xe1ticamente a la pantalla de pago."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Validaci\xf3n del Estado del Cliente:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"El sistema verifica si el cliente tiene deudas pendientes."}),"\n",(0,r.jsx)(n.li,{children:"Si est\xe1 al d\xeda, no se permite realizar un pago."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Visualizaci\xf3n de los Detalles del Contrato:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"El cliente revisa los detalles de su contrato, incluyendo el monto y la fecha l\xedmite de pago."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Ingreso de Datos de Pago:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"El cliente ingresa los datos de su tarjeta en el formulario de pago."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Procesamiento del Pago:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"El sistema registra al cliente en OpenPay."}),"\n",(0,r.jsx)(n.li,{children:"Tokeniza la tarjeta y procesa el d\xe9bito correspondiente."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(n.li,{children:[(0,r.jsx)(n.strong,{children:"Registro y Notificaci\xf3n:"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"Se registra la transacci\xf3n en la base de datos."}),"\n",(0,r.jsx)(n.li,{children:"Se genera un comprobante electr\xf3nico."}),"\n",(0,r.jsx)(n.li,{children:"El cliente recibe una notificaci\xf3n en la plataforma y por correo electr\xf3nico."}),"\n"]}),"\n"]}),"\n"]}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h3,{id:"diagrama-de-flujo-mermaid",children:"Diagrama de Flujo (Mermaid):"}),"\n",(0,r.jsx)(n.mermaid,{value:"graph TD\r\n    A[Inicio de Sesi\xf3n del Cliente] --\x3e B{\xbfTiene Pagos Pendientes?}\r\n    B -- S\xed --\x3e C[Redirigir a Pantalla de Pago]\r\n    C --\x3e D[Mostrar Detalles del Contrato]\r\n    D --\x3e E[Ingresar Datos de la Tarjeta]\r\n    E --\x3e F[Procesar Pago con OpenPay]\r\n    F --\x3e G{\xbfPago Exitoso?}\r\n    G -- S\xed --\x3e H[Registrar Transacci\xf3n en DB]\r\n    H --\x3e I[Actualizar Estado del Cliente]\r\n    I --\x3e J[Generar Comprobante Electr\xf3nico]\r\n    J --\x3e K[Notificar al Cliente]\r\n    G -- No --\x3e L[Mostrar Mensaje de Error]\r\n    B -- No --\x3e M[Permitir Inicio de Sesi\xf3n]\r\n    M --\x3e N[Acceder al Panel de Gesti\xf3n]\r\n"}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h2,{id:"4-artefactos-t\xe9cnicos-relacionados",children:"4. Artefactos T\xe9cnicos Relacionados"}),"\n",(0,r.jsxs)(n.table,{children:[(0,r.jsx)(n.thead,{children:(0,r.jsxs)(n.tr,{children:[(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Artefacto T\xe9cnico"})}),(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Descripci\xf3n"})})]})}),(0,r.jsxs)(n.tbody,{children:[(0,r.jsxs)(n.tr,{children:[(0,r.jsxs)(n.td,{children:["Tabla ",(0,r.jsx)(n.code,{children:"proyecto_clientes"})]}),(0,r.jsx)(n.td,{children:"Almacena informaci\xf3n de los clientes de proyectos."})]}),(0,r.jsxs)(n.tr,{children:[(0,r.jsxs)(n.td,{children:["Tabla ",(0,r.jsx)(n.code,{children:"proyecto_cronograma_pagos"})]}),(0,r.jsx)(n.td,{children:"Registra los pagos fraccionados asociados a los contratos."})]}),(0,r.jsxs)(n.tr,{children:[(0,r.jsxs)(n.td,{children:["Tabla ",(0,r.jsx)(n.code,{children:"transacciones"})]}),(0,r.jsx)(n.td,{children:"Registra las transacciones de pago realizadas."})]}),(0,r.jsxs)(n.tr,{children:[(0,r.jsxs)(n.td,{children:["Controlador ",(0,r.jsx)(n.code,{children:"PlanController"})]}),(0,r.jsx)(n.td,{children:"Implementa la l\xf3gica del procesamiento de pagos."})]}),(0,r.jsxs)(n.tr,{children:[(0,r.jsxs)(n.td,{children:["Vista ",(0,r.jsx)(n.code,{children:"proyecto-pago.blade.php"})]}),(0,r.jsx)(n.td,{children:"Pantalla donde el cliente realiza el pago."})]}),(0,r.jsxs)(n.tr,{children:[(0,r.jsx)(n.td,{children:"Integraci\xf3n con OpenPay"}),(0,r.jsx)(n.td,{children:"Maneja la creaci\xf3n de clientes, tokenizaci\xf3n de tarjetas y pagos."})]})]})]}),"\n",(0,r.jsx)(n.hr,{}),"\n",(0,r.jsx)(n.h2,{id:"5-historial-de-cambios",children:"5. Historial de Cambios"}),"\n",(0,r.jsxs)(n.table,{children:[(0,r.jsx)(n.thead,{children:(0,r.jsxs)(n.tr,{children:[(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Versi\xf3n"})}),(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Fecha"})}),(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Cambios Realizados"})}),(0,r.jsx)(n.th,{children:(0,r.jsx)(n.strong,{children:"Autor"})})]})}),(0,r.jsx)(n.tbody,{children:(0,r.jsxs)(n.tr,{children:[(0,r.jsx)(n.td,{children:"v1.0"}),(0,r.jsx)(n.td,{children:"06/12/2024"}),(0,r.jsx)(n.td,{children:"Documento funcional inicial creado."}),(0,r.jsx)(n.td,{children:"Walker Alfaro"})]})})]})]})}function h(e={}){const{wrapper:n}={...(0,s.R)(),...e.components};return n?(0,r.jsx)(n,{...e,children:(0,r.jsx)(d,{...e})}):d(e)}},8453:(e,n,i)=>{i.d(n,{R:()=>a,x:()=>l});var o=i(6540);const r={},s=o.createContext(r);function a(e){const n=o.useContext(s);return o.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function l(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(r):e.components||r:a(e.components),o.createElement(s.Provider,{value:n},e.children)}}}]);