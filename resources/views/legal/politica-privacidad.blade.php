@extends('layouts.app')

@section('title')
  Política de Privacidad
@endsection

<style>
    /* Estilos opcionales para personalizar la lista */
    ul.custom-bullets {
        list-style-type: disc; /* Tipo de viñeta: disc, circle, square, etc. */
        padding-left: 20px; /* Espacio a la izquierda de la lista */
    }
    ul.custom-bullets li {
        margin-bottom: 10px; /* Espacio entre elementos de la lista */
        line-height: 1.6; /* Altura de línea para mejor legibilidad */
    }
</style>

@push('styles')
  	@vite(['resources/sass/pages/terminos.scss'])
@endpush

@section('header')
  @include('components.header')
@endsection

@section('content')
    
    <div class="container my-5">
        <div class="terminos p-5">

            <h1 class="terminos-titulo">Políticas de Privacidad</h1>

            <h3 class="terminos-articulo">1. COMPROMISO DE “PUJA INMOBILIARIA</h3>

            <p>
                <strong>“PUJA INMOBILIARIA”</strong> se compromete a respetar la privacidad de todas las personas
que accedan al sitio web señalado en la cláusula 11 (en adelante, el "Sitio Web").
Esta Política de Privacidad detalla la información que <strong>"PUJA INMOBILIARIA"</strong> puede
recoger a través del Sitio Web, los fines para los que se utilizará dicha información y las
medidas implementadas para garantizar su protección. Asimismo, establece cómo
puede acceder a su información personal y con quién puede comunicarse dentro de
<strong>"PUJA INMOBILIARIA"</strong> para resolver cualquier duda o consulta relacionada con esta
Política de Privacidad.
            </p>

            <h3 class="terminos-articulo">2. . RECOPILACIÓN Y UTILIZACIÓN DE SU INFORMACIÓN</h3>
            
            <p>
                2.1. Esta Política de Privacidad regula la recopilación y el uso de datos personales en el
Sitio Web.
            </p>
            
            <p>2.2. <strong>"PUJA INMOBILIARIA"</strong> no obtendrá información que permita identificarlo
                personalmente, como su nombre, dirección, número de teléfono o correo electrónico
                (en adelante, "Información Personal"), a menos que usted la proporcione de manera
                voluntaria. Si no desea que recopilemos su Información Personal, le pedimos que no la
                comparta. Sin embargo, es importante destacar que, si decide no proporcionarla,
                podría no tener acceso a ciertos servicios e información ofrecidos a través del Sitio Web.
            </p>

            <p>
                2.3. En caso de que nos facilite su Información Personal, le informamos que será
procesada de forma automatizada y añadida a la base de datos de <strong>"PUJA INMOBILIARIA"</strong>.
            </p>

            <p>
                2.4. Bajo ninguna circunstancia <strong>"PUJA INMOBILIARIA"</strong> recopilará información sensible
sobre usted.
            </p>
            
            <h3 class="terminos-articulo">3. INFORMACIÓN PERSONAL</h3>
            
            <p>
                3.1. "PUJA INMOBILIARIA" recopila Información Personal en línea en los siguientes
casos, entre otros:

            </p>

            <ul class="custom-bullets">
                <li>Cuando usted se registra para utilizar servicios disponibles en el Sitio Web.</li>
                <li>Al interactuar con el Sitio Web.</li>
                <li>Cuando envía preguntas, consultas, comentarios o se contacta a través del Sitio Web.</li>
                <li>Al solicitar información o materiales.</li>
                <li>Al proporcionar información de</li>
            </ul>

            <p>
                3.2. Su Información Personal podrá ser utilizada por <strong>"PUJA INMOBILIARIA"</strong> y sus
aliados comerciales, directamente o a través de proveedores, con los siguientes fines
            </p>

            <ul class="custom-bullets">
                <li>Gestionar actividades relacionadas con el objeto social de la compañía y el
                    cumplimiento de los contratos celebrados con usted.
                    </li>
                <li>Cumplir obligaciones adquiridas con usted.</li>
                <li>Desarrollar, promocionar y ofrecer nuevos productos y servicios, o mejorar los
                    existentes.</li>
                <li>Ajustar la oferta de productos y servicios al perfil del cliente, así como realizar
                    análisis, reportes y evaluaciones relacionados.
                    </li>
                <li>Realizar acciones comerciales, generales o personalizadas, para mejorar su
                    experiencia como usuario, siempre con su consentimiento.</li>
                <li>Compartir su Información Personal con terceros para la prevención de fraudes y
                    reducción de riesgos crediticios.
                    </li>
                <li>Transferir su Información Personal dentro o fuera del país a empresas
                    relacionadas para cumplir los fines descritos en esta Política de Privacidad.
                    </li>
            </ul>
            
            <p>
                3.3. <strong>"PUJA INMOBILIARIA"</strong> podrá permitir a sus usuarios acceder a cualquiera de los
portales operados por la compañía mediante las credenciales de acceso (usuario y
contraseña) creadas para ingresar a dichos portales, con el objetivo de cumplir el
servicio contratado.
            </p>
            
            <p>
                3.4. La información recopilada puede incluir, entre otros datos, nombre, tipo y número
de documento, teléfono, dirección de correo electrónico y cualquier otra información
que permita identificarlo. Al proporcionar su Información Personal, usted declara que
es correcta, verdadera y está actualizada, de acuerdo con la legislación vigente
            </p>

            <p>
                3.5. Al brindar su Información Personal, usted otorga su consentimiento libre, previo,
expreso e informado para que sea utilizada con las finalidades mencionadas. Autoriza
su tratamiento, almacenamiento y recopilación en la base de datos USUARIOS DE
PLATAFORMAS WEB Y MÓVIL de <strong>"PUJA INMOBILIARIA"</strong>, registrada mediante
Resolución N.° 3111-2016-JUS/DGPDP-DRN y código de inscripción RNPDP-PJP N.°
11156. Asimismo, acepta que su Información Personal pueda compartirse con los
clientes de <strong>"PUJA INMOBILIARIA"</strong>, cuya lista está disponible en el Sitio Web.
            </p>

            <p>
                3.6. <strong>"PUJA INMOBILIARIA"</strong> conservará los datos personales de los usuarios por un
periodo máximo de 25 años, salvo que el usuario cancele su cuenta o ejerza su derecho
de supresión. En cualquiera de estos casos, los datos serán eliminados una vez cumplido
el plazo correspondiente
            </p>

            
            <h3 class="terminos-articulo">4. CORREO ELECTRÓNICO</h3>
            
            <p>
                4.1. <strong>"PUJA INMOBILIARIA"</strong> podrá comunicarse con usted por correo electrónico para
temas relacionados con el contenido del Sitio Web, los servicios que ofrece o su cuenta.
También responderá a sus preguntas, solicitudes, consultas o comentarios.
Adicionalmente, con su consentimiento, podrá enviarle información sobre productos y
servicios propios o de terceros asociados comercialmente que puedan ser de su interés,
salvo que usted manifieste de forma explícita su deseo de no recibir dichos correos a
través de los procedimientos habilitados por <strong>"PUJA INMOBILIARIA"</strong> para este fin.
            </p>
            
            <p>
                4.2. Cada correo electrónico enviado por <strong>"PUJA INMOBILIARIA"</strong> incluirá instrucciones
claras para que pueda rechazar futuros correos promocionales. Además, en cualquier
momento, podrá modificar sus preferencias para recibir este tipo de comunicaciones
publicitarias desde la configuración de su cuenta en el Sitio Web.
            </p>
            <h3 class="terminos-articulo">5. INFORMACIÓN ADICIONAL</h3>
            
            <p>
                <strong>"PUJA INMOBILIARIA"</strong> emplea diversos métodos para recopilar información sobre
usted y la tecnología que utiliza, como el tipo de navegador y sistema operativo, en
relación con nuestros Portales. Entre estos métodos se incluyen cookies, cookies flash,
web beacons y otros dispositivos automatizados de recopilación de información. Estos
datos pueden ser utilizados para analizar tendencias, gestionar el sitio, rastrear el
comportamiento en el portal y obtener información demográfica sobre nuestra base de
usuarios, además de fines publicitarios y para la operación de nuestras actividades
comerciales. También podemos vincular esta información recopilada
automáticamente con su información personal.
Cookies: Las cookies son pequeños archivos de texto que se guardan en su dispositivo
para registrar sus preferencias y mejorar su experiencia en nuestras plataformas. Estas
se utilizan para recopilar información de manera anónima y en conjunto. Las cookies
que empleamos se clasifican en las siguientes categorías:
            </p>

            <ul class="custom-bullets">
                <li>Cookies esenciales: Reconocen al usuario al ingresar, guardan configuraciones
                    y protegen su cuenta. Son indispensables para el funcionamiento del Sitio Web
                    y no se pueden desactivar.</li>
                <li>Cookies de rendimiento y análisis: Ayudan a optimizar funciones del portal y
                    analizan la navegación del usuario para mejorar nuestros servicios.</li>
                <li>Cookies de publicidad: Recopilan datos para mostrar anuncios personalizados
                    basados en intereses o preferencias.</li>
            </ul>

            <p>
                Si desea más información sobre las cookies utilizadas en el Portal, puede enviar un
correo a <a class="footer-link-puja" href="#" target="blank">atencionalcliente@pujainmobiliaria.com.pe</a> .
Se informa además que:

            </p>

            <ul class="custom-bullets">
                <li>El listado de terceros con acceso a datos personales y cualquier modificación
                    será actualizado en esta Política de Privacidad.</li>
                <li>Su autorización es necesaria para procesar sus datos conforme a los fines
                    indicados</li>
                <li>Usted tiene derecho a acceder, rectificar, oponerse o cancelar el uso de sus
                    datos personales. Para ejercer estos derechos, puede enviar una solicitud a
                    <a class="footer-link-puja" href="#" target="blank">atencionalcliente@pujainmobiliaria.com.pe</a>
                    </li>
            </ul>

            <p>
                En caso de no estar satisfecho con nuestra respuesta, podrá recurrir a la Dirección
General de Protección de Datos Personales, órgano encargado de supervisar el
cumplimiento de la Ley de Protección de Datos Personales – Ley N.º 29733 y su
Reglamento.
            </p>

            <h3 class="terminos-articulo">6. PROTEGIENDO SU INFORMACIÓN PERSONAL</h3>

            <p>
                6.1. Con el fin de evitar accesos no autorizados, garantizar la exactitud de los datos y
asegurar el uso adecuado de su información personal, <strong>"PUJA INMOBILIARIA"</strong> ha
implementado medidas físicas, electrónicas y administrativas, así como
procedimientos de seguridad para proteger la información personal recopilada en línea.
Nos comprometemos a resguardar estos datos siguiendo estándares y protocolos de
seguridad vigentes, evaluando de manera continua nuevas tecnologías para optimizar
su protección. Asimismo, <strong>"PUJA INMOBILIARIA"</strong> asegura que los procesos internos de
sus bases de datos cumplen con las disposiciones legales aplicables en materia de
seguridad, privacidad y protección de datos personales en cada país.
            </p>

            <p>
                6.2. No obstante lo anterior, usted reconoce que ningún sistema de seguridad es
completamente invulnerable y que, a pesar de adoptar todas las medidas razonables
para proteger la información, esta podría verse expuesta a alteraciones, destrucción o
pérdida. En caso de que ocurra alguna de estas situaciones, <strong>"PUJA INMOBILIARIA"</strong>
actuará conforme a las leyes y regulaciones de privacidad y protección de datos
personales de cada jurisdicción.
            </p>

            <p>
                6.3. Los colaboradores de <strong>"PUJA INMOBILIARIA"</strong> reciben formación específica para
comprender y aplicar los principios de protección de datos personales y seguridad de la
información. Además, los empleados están sujetos a estrictos compromisos de
confidencialidad respecto a la información personal que manejan en el desempeño de
sus funciones.
            </p>

            <p>
                6.4. Usted acepta y reconoce que su información personal podrá ser almacenada en la
jurisdicción donde <strong>"PUJA INMOBILIARIA"</strong> opere o transferida, almacenada y
procesada en ubicaciones fuera de su país de residencia.

            </p>

            <h3 class="terminos-articulo">7. MENORES DE EDAD</h3>

            <p>
                7.1. <strong>"PUJA INMOBILIARIA"</strong>  no busca recopilar información personal de menores de
edad. En los casos aplicables, se advertirá expresamente a los menores que no
proporcionen su información personal a través del sitio web. Asimismo, se
implementarán medidas razonables para obtener el consentimiento de los padres,
tutores o representantes legales antes de recopilar dicha información.
            </p>

            <p>
                7.2. Como padre, tutor o representante legal, usted es responsable de supervisar el
acceso de los menores bajo su tutela al sitio web. Por este motivo, le recomendamos
tomar las precauciones necesarias durante la navegación. Cabe destacar que algunos
navegadores ofrecen configuraciones que restringen el acceso de los niños a ciertas
páginas web.

            </p>

            <h3 class="terminos-articulo">8. ENLACES EXTERNOS</h3>

            <p>

                El sitio web puede incluir enlaces hacia otros sitios de internet o recibir enlaces desde
ellos. <strong>"PUJA INMOBILIARIA"</strong> no se hace responsable de las políticas de privacidad ni
del manejo de datos personales en esos sitios. Por ello, recomendamos revisar sus
políticas de privacidad antes de utilizar dichos portales.

            </p>

            <h3 class="terminos-articulo">9. DERECHOS DEL USUARIO</h3>


<p>
    9.1. Si ha proporcionado su información personal mediante el sitio web, usted tiene
derecho a acceder, revisar, modificar, eliminar y actualizar dichos datos en cualquier
momento.


</p>

    <p>
        9.2. Para ejercer estos derechos o en caso de que su información personal sea
incorrecta, esté desactualizada o desee eliminarla, debe enviar su solicitud por correo
electrónico conforme a las regulaciones de su país, detalladas en la cláusula 11. Use un
asunto específico como “Informar”, “Rectificar”, “Suprimir” o “Actualizar”, según
corresponda, y explique claramente su requerimiento. La solicitud deberá incluir, al
menos, los siguientes datos:

    </p>

    <p>
        Nombre completo y domicilio, para poder responder en los plazos legales
correspondientes
    </p>

        <p>
            Copia de un documento de identidad (DNI, pasaporte, etc.) que verifique su identidad
o, en caso de ser representante legal, el documento que acredite dicha representación.
Descripción clara de los datos personales sobre los cuales desea ejercer su derecho
(acceso, rectificación, cancelación, etc.) y detalles específicos de su solicitud.
Fecha y firma del solicitante.
        </p>

        <p>
            Cualquier otro documento o elemento que facilite la localización de los datos
solicitados.
        </p>

        <p>
            9.3. Si se ha suscrito a algún servicio o comunicación de <strong>"PUJA INMOBILIARIA"</strong>, podrá
            cancelar su suscripción en cualquier momento siguiendo las instrucciones incluidas en
            los mensajes que reciba.

        </p>

        <p>
            9.4. <strong>"PUJA INMOBILIARIA"</strong> colaborará con las autoridades pertinentes cuando estas
soliciten formalmente información contenida en nuestras bases de datos.
        </p>

        <h3 class="terminos-articulo">10. CAMBIOS A ESTE AVISO DE PRIVACIDAD
        </h3>

        <p>
            <strong>"PUJA INMOBILIARIA"</strong> se reserva el derecho de actualizar o modificar esta Política de
Privacidad cuando lo considere necesario. Cualquier cambio será publicado en este sitio
web, por lo que es responsabilidad del usuario revisar periódicamente esta sección para
estar al tanto de las actualizaciones. Además, se notificará cualquier modificación
enviando un aviso a la dirección de correo electrónico registrada por el usuario.
        </p>

        <h3 class="terminos-articulo">11. LOCALIZACIÓN
        </h3>

        

        <h5 class="terminos-articulo">11.1 PARA USUARIOS EN PERÚs</h5>

        <p>
            11.1.1. “PUJA INMOBILIARIA” es administrada por ESTUDIO BUSTAMANTE &
ROMERO S.A.C., con número de RUC 20606061341 y domicilio en Av. Canaval y
Moreyra N° 290, Dpto. 32, San Isidro, Lima, Perú. El sitio web oficial es
<a class="footer-link-puja" href="/" target="blank"> www.pujainmobiliaria.com.pe</a>, y la presente política se rige por las leyes peruanas.
        </p>

        <p>

            11.1.2. Como titular de sus datos personales, usted puede revocar su consentimiento en
cualquier momento y limitar el uso o divulgación de su información. Asimismo, tiene
derecho a acceder, rectificar, cancelar u oponerse al tratamiento de sus datos
personales, enviando su solicitud al correo
atencionalcliente@pujainmobiliaria.com.pe, conforme a lo establecido en la Ley 29733
sobre protección de datos personales.

        </p>

        <p>
            11.1.3. Si no desea recibir llamadas con fines comerciales, puede registrarse en el
sistema “Gracias No Insista” del INDECOPI. Para más información, visite
indecopi.gob.pe/gracias-no-insista o comuníquese al (+511) 224-7777
        </p>

        <p>
            11.1.4. En caso de no recibir respuesta satisfactoria a una solicitud sobre sus datos
personales, puede acudir a la Dirección General de Protección de Datos Personales, la
autoridad encargada de supervisar el cumplimiento de la Ley 29733 y su reglamento.
Para más información, visite <a class="footer-link-puja" href="/" target="blank">  www.gob.pe/anpd</a>.

        </p>

        <h3 class="terminos-articulo">12. CONTACTO
        </h3>


        <p>
            Si tiene preguntas sobre su privacidad cuando utilice el Sitio Web, por favor
contáctenos a los siguientes correos
electrónicos: atencionalcliente@pujainmobiliaria.com.pe

        </p>

        <p>
            Esta Política de Privacidad fue actualizada por última vez el 17 de diciembre de 2024
        </p>

        <p class="text-center">
            ¿Ha quedado contestada tu pregunta?
        </p>


        
        </div>
    </div>
@endsection

@section('footer')
	<x-footer></x-footer>
@endsection