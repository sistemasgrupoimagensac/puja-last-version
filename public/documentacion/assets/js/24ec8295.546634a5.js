"use strict";(self.webpackChunkdocumentacion=self.webpackChunkdocumentacion||[]).push([[2957],{9667:(e,i,n)=>{n.r(i),n.d(i,{assets:()=>d,contentTitle:()=>c,default:()=>h,frontMatter:()=>l,metadata:()=>s,toc:()=>a});const s=JSON.parse('{"id":"tecnica/DT_Iniciar_Sesion_Google","title":"Inicio de Sesi\xf3n con Google","description":"---","source":"@site/docs/tecnica/DT_Iniciar_Sesion_Google.md","sourceDirName":"tecnica","slug":"/tecnica/DT_Iniciar_Sesion_Google","permalink":"/documentacion/docs/tecnica/DT_Iniciar_Sesion_Google","draft":false,"unlisted":false,"tags":[],"version":"current","sidebarPosition":4,"frontMatter":{"sidebar_label":"Inicio de Sesi\xf3n con Google","sidebar_position":4,"title":"Inicio de Sesi\xf3n con Google"},"sidebar":"documentationSidebar","previous":{"title":"Inicio de Sesi\xf3n","permalink":"/documentacion/docs/tecnica/DT_Iniciar_Sesion"},"next":{"title":"Publicar Inmueble Propietario","permalink":"/documentacion/docs/tecnica/DT_Publicar_Inmueble_Propietario"}}');var r=n(4848),o=n(8453);const l={sidebar_label:"Inicio de Sesi\xf3n con Google",sidebar_position:4,title:"Inicio de Sesi\xf3n con Google"},c="Documento T\xe9cnico: Iniciar Sesi\xf3n con Google",d={},a=[{value:"1. Resumen",id:"1-resumen",level:2},{value:"2. Requisitos Funcionales Relacionados",id:"2-requisitos-funcionales-relacionados",level:2},{value:"3. Base de Datos Relacionada",id:"3-base-de-datos-relacionada",level:2},{value:"Tablas Implicadas",id:"tablas-implicadas",level:3},{value:"Tabla: <code>users</code>",id:"tabla-users",level:4},{value:"4. Relaci\xf3n de Tablas",id:"4-relaci\xf3n-de-tablas",level:2},{value:"5. APIs y Scripts",id:"5-apis-y-scripts",level:2},{value:"Dependencia Externa: Socialite",id:"dependencia-externa-socialite",level:3},{value:"Scripts Relacionados",id:"scripts-relacionados",level:3},{value:"6. Controladores",id:"6-controladores",level:2},{value:"<code>selectAccountGoogle()</code>",id:"selectaccountgoogle",level:3},{value:"<code>createLoginGoogle()</code>",id:"createlogingoogle",level:3},{value:"7. Historial de Cambios",id:"7-historial-de-cambios",level:2}];function t(e){const i={br:"br",code:"code",h1:"h1",h2:"h2",h3:"h3",h4:"h4",header:"header",hr:"hr",li:"li",mermaid:"mermaid",ol:"ol",p:"p",strong:"strong",table:"table",tbody:"tbody",td:"td",th:"th",thead:"thead",tr:"tr",ul:"ul",...(0,o.R)(),...e.components};return(0,r.jsxs)(r.Fragment,{children:[(0,r.jsx)(i.header,{children:(0,r.jsx)(i.h1,{id:"documento-t\xe9cnico-iniciar-sesi\xf3n-con-google",children:"Documento T\xe9cnico: Iniciar Sesi\xf3n con Google"})}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"1-resumen",children:"1. Resumen"}),"\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Descripci\xf3n:"}),(0,r.jsx)(i.br,{}),"\n","Este flujo permite a los usuarios iniciar sesi\xf3n en el sistema utilizando su cuenta de Google. Es una alternativa eficiente que elimina la necesidad de recordar contrase\xf1as o completar formularios de registro, haciendo uso de la API de Google para autenticaci\xf3n."]}),"\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Prop\xf3sito:"}),(0,r.jsx)(i.br,{}),"\n","Facilitar y agilizar el proceso de inicio de sesi\xf3n para mejorar la experiencia del usuario y aumentar la tasa de retenci\xf3n en la plataforma."]}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"2-requisitos-funcionales-relacionados",children:"2. Requisitos Funcionales Relacionados"}),"\n",(0,r.jsxs)(i.table,{children:[(0,r.jsx)(i.thead,{children:(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"ID"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Nombre del Requisito"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Descripci\xf3n"})})]})}),(0,r.jsx)(i.tbody,{children:(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:(0,r.jsx)(i.code,{children:"RF004"})}),(0,r.jsx)(i.td,{children:"Iniciar sesi\xf3n con Google"}),(0,r.jsx)(i.td,{children:"Permitir a los usuarios iniciar sesi\xf3n mediante su cuenta de Google."})]})})]}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"3-base-de-datos-relacionada",children:"3. Base de Datos Relacionada"}),"\n",(0,r.jsx)(i.h3,{id:"tablas-implicadas",children:"Tablas Implicadas"}),"\n",(0,r.jsxs)(i.h4,{id:"tabla-users",children:["Tabla: ",(0,r.jsx)(i.code,{children:"users"})]}),"\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Prop\xf3sito:"}),(0,r.jsx)(i.br,{}),"\n","Almacena los datos de los usuarios, incluyendo informaci\xf3n b\xe1sica, tipo de usuario y datos necesarios para su autenticaci\xf3n."]}),"\n",(0,r.jsxs)(i.table,{children:[(0,r.jsx)(i.thead,{children:(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Columna"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Tipo"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Descripci\xf3n"})})]})}),(0,r.jsxs)(i.tbody,{children:[(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"id"}),(0,r.jsx)(i.td,{children:"BIGINT"}),(0,r.jsx)(i.td,{children:"Identificador \xfanico del usuario."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"tipo_usuario_id"}),(0,r.jsx)(i.td,{children:"BIGINT"}),(0,r.jsxs)(i.td,{children:["Relaci\xf3n con la tabla ",(0,r.jsx)(i.code,{children:"tipos_usuario"})," para identificar el perfil del usuario."]})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"google_id"}),(0,r.jsx)(i.td,{children:"STRING"}),(0,r.jsx)(i.td,{children:"Identificador \xfanico asignado por Google para el usuario."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"nombres"}),(0,r.jsx)(i.td,{children:"STRING"}),(0,r.jsx)(i.td,{children:"Nombre del usuario registrado en Google."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"email"}),(0,r.jsx)(i.td,{children:"STRING"}),(0,r.jsx)(i.td,{children:"Direcci\xf3n de correo electr\xf3nico del usuario."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"imagen"}),(0,r.jsx)(i.td,{children:"STRING"}),(0,r.jsx)(i.td,{children:"URL de la imagen de perfil del usuario proporcionada por Google."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"email_verified_at"}),(0,r.jsx)(i.td,{children:"TIMESTAMP"}),(0,r.jsx)(i.td,{children:"Fecha y hora de verificaci\xf3n del correo electr\xf3nico."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"created_at"}),(0,r.jsx)(i.td,{children:"TIMESTAMP"}),(0,r.jsx)(i.td,{children:"Fecha y hora de creaci\xf3n del registro."})]}),(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"updated_at"}),(0,r.jsx)(i.td,{children:"TIMESTAMP"}),(0,r.jsx)(i.td,{children:"Fecha y hora de la \xfaltima actualizaci\xf3n del registro."})]})]})]}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"4-relaci\xf3n-de-tablas",children:"4. Relaci\xf3n de Tablas"}),"\n",(0,r.jsx)(i.mermaid,{value:'erDiagram\r\n    users {\r\n        BIGINT id PK\r\n        BIGINT tipo_usuario_id FK\r\n        STRING google_id\r\n        STRING nombres\r\n        STRING email\r\n        STRING imagen\r\n        TIMESTAMP email_verified_at\r\n        TIMESTAMP created_at\r\n        TIMESTAMP updated_at\r\n    }\r\n\r\n    tipos_usuario {\r\n        BIGINT id PK\r\n        STRING tipo\r\n        BOOLEAN estado\r\n        TIMESTAMP created_at\r\n        TIMESTAMP updated_at\r\n    }\r\n\r\n    users ||--o{ tipos_usuario : "1:N"'}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"5-apis-y-scripts",children:"5. APIs y Scripts"}),"\n",(0,r.jsx)(i.h3,{id:"dependencia-externa-socialite",children:"Dependencia Externa: Socialite"}),"\n",(0,r.jsx)(i.p,{children:"Laravel Socialite facilita la integraci\xf3n con proveedores de OAuth, como Google. Los m\xe9todos clave en este flujo son:"}),"\n",(0,r.jsxs)(i.ol,{children:["\n",(0,r.jsxs)(i.li,{children:[(0,r.jsx)(i.strong,{children:(0,r.jsx)(i.code,{children:"Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect()"})}),(0,r.jsx)(i.br,{}),"\n","Redirige al usuario a la p\xe1gina de autenticaci\xf3n de Google, donde seleccionar\xe1 su cuenta."]}),"\n",(0,r.jsxs)(i.li,{children:[(0,r.jsx)(i.strong,{children:(0,r.jsx)(i.code,{children:"Socialite::driver('google')->user()"})}),(0,r.jsx)(i.br,{}),"\n","Recupera los datos del usuario autenticado desde Google, como su correo, nombre y avatar."]}),"\n"]}),"\n",(0,r.jsx)(i.h3,{id:"scripts-relacionados",children:"Scripts Relacionados"}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["El frontend contiene el bot\xf3n que redirige a la ruta ",(0,r.jsx)(i.code,{children:"/google-auth/redirect"}),", iniciando el proceso de autenticaci\xf3n."]}),"\n"]}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"6-controladores",children:"6. Controladores"}),"\n",(0,r.jsx)(i.h3,{id:"selectaccountgoogle",children:(0,r.jsx)(i.code,{children:"selectAccountGoogle()"})}),"\n",(0,r.jsxs)(i.ol,{children:["\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Prop\xf3sito:"}),(0,r.jsx)(i.br,{}),"\n","Redirigir al usuario a la p\xe1gina de autenticaci\xf3n de Google para seleccionar su cuenta."]}),"\n"]}),"\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsx)(i.p,{children:(0,r.jsx)(i.strong,{children:"Explicaci\xf3n del Flujo:"})}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["Este m\xe9todo utiliza ",(0,r.jsx)(i.code,{children:"Socialite::driver('google')"})," para iniciar el flujo OAuth con Google."]}),"\n",(0,r.jsxs)(i.li,{children:["La opci\xf3n ",(0,r.jsx)(i.code,{children:"with(['prompt' => 'select_account'])"})," asegura que Google solicite al usuario seleccionar una cuenta, incluso si ya ha iniciado sesi\xf3n en su navegador."]}),"\n",(0,r.jsx)(i.li,{children:"Finalmente, redirige al usuario a la p\xe1gina de inicio de sesi\xf3n de Google."}),"\n"]}),"\n"]}),"\n"]}),"\n",(0,r.jsx)(i.h3,{id:"createlogingoogle",children:(0,r.jsx)(i.code,{children:"createLoginGoogle()"})}),"\n",(0,r.jsxs)(i.ol,{children:["\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Prop\xf3sito:"}),(0,r.jsx)(i.br,{}),"\n","Completar el proceso de inicio de sesi\xf3n, verificando si el usuario existe en la base de datos o registr\xe1ndolo si no lo est\xe1."]}),"\n"]}),"\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsx)(i.p,{children:(0,r.jsx)(i.strong,{children:"Explicaci\xf3n del Flujo:"})}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Recuperar Datos del Usuario:"}),(0,r.jsx)(i.br,{}),"\n","Utiliza ",(0,r.jsx)(i.code,{children:"Socialite::driver('google')->user()"})," para obtener informaci\xf3n como ",(0,r.jsx)(i.code,{children:"id"}),", ",(0,r.jsx)(i.code,{children:"name"}),", ",(0,r.jsx)(i.code,{children:"email"}),", y ",(0,r.jsx)(i.code,{children:"avatar"}),"."]}),"\n"]}),"\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Verificar Existencia del Usuario:"}),(0,r.jsx)(i.br,{}),"\n","Busca al usuario en la base de datos utilizando el ",(0,r.jsx)(i.code,{children:"google_id"})," recibido."]}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsx)(i.p,{children:"Si el usuario existe:"}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["Inicia sesi\xf3n con ",(0,r.jsx)(i.code,{children:"Auth::login($existingUser)"}),"."]}),"\n",(0,r.jsx)(i.li,{children:"Redirige al usuario a la p\xe1gina principal con sus datos cargados en sesi\xf3n."}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsx)(i.p,{children:"Si el usuario no existe:"}),"\n",(0,r.jsxs)(i.ul,{children:["\n",(0,r.jsxs)(i.li,{children:["Crea un nuevo registro en la tabla ",(0,r.jsx)(i.code,{children:"users"})," con la informaci\xf3n proporcionada por Google."]}),"\n",(0,r.jsxs)(i.li,{children:["Asigna un ",(0,r.jsx)(i.code,{children:"tipo_usuario_id"})," predeterminado (por defecto, ",(0,r.jsx)(i.code,{children:"2: corredor"}),")."]}),"\n",(0,r.jsxs)(i.li,{children:["Inicia sesi\xf3n con ",(0,r.jsx)(i.code,{children:"Auth::login($user)"})," y redirige al usuario a la p\xe1gina principal."]}),"\n"]}),"\n"]}),"\n"]}),"\n"]}),"\n",(0,r.jsxs)(i.li,{children:["\n",(0,r.jsxs)(i.p,{children:[(0,r.jsx)(i.strong,{children:"Manejo de Errores:"}),(0,r.jsx)(i.br,{}),"\n","Si ocurre alg\xfan error durante el proceso, se captura mediante un bloque ",(0,r.jsx)(i.code,{children:"try-catch"}),", asegurando que el sistema no falle."]}),"\n"]}),"\n"]}),"\n"]}),"\n"]}),"\n",(0,r.jsx)(i.hr,{}),"\n",(0,r.jsx)(i.h2,{id:"7-historial-de-cambios",children:"7. Historial de Cambios"}),"\n",(0,r.jsxs)(i.table,{children:[(0,r.jsx)(i.thead,{children:(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Versi\xf3n"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Fecha"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Cambios Realizados"})}),(0,r.jsx)(i.th,{children:(0,r.jsx)(i.strong,{children:"Autor"})})]})}),(0,r.jsx)(i.tbody,{children:(0,r.jsxs)(i.tr,{children:[(0,r.jsx)(i.td,{children:"v1.0"}),(0,r.jsx)(i.td,{children:"03/12/2024"}),(0,r.jsx)(i.td,{children:"Documento t\xe9cnico inicial creado"}),(0,r.jsx)(i.td,{children:"Walker Alfaro"})]})})]})]})}function h(e={}){const{wrapper:i}={...(0,o.R)(),...e.components};return i?(0,r.jsx)(i,{...e,children:(0,r.jsx)(t,{...e})}):t(e)}},8453:(e,i,n)=>{n.d(i,{R:()=>l,x:()=>c});var s=n(6540);const r={},o=s.createContext(r);function l(e){const i=s.useContext(o);return s.useMemo((function(){return"function"==typeof e?e(i):{...i,...e}}),[i,e])}function c(e){let i;return i=e.disableParentContext?"function"==typeof e.components?e.components(r):e.components||r:l(e.components),s.createElement(o.Provider,{value:i},e.children)}}}]);