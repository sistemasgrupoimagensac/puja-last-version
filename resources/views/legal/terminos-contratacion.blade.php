@extends('layouts.app')

@section('title')
  	Terminos y Condiciones de Contratación Publicitaria
@endsection

<style>
    ol.custom-list {
        list-style-type: lower-roman;
        /* Define numerales romanos minúsculos */
        padding-left: 20px;
    }

    li {
        margin-bottom: 10px;
        line-height: 1.5;
    }
</style>

<style>
	/* Estilos para la lista personalizada */
	ol {
		list-style: none; /* Elimina la numeración por defecto */
		padding-left: 0;
	}
	li {
		margin-bottom: 10px;
		line-height: 1.6;
		position: relative;
		padding-left: 60px; /* Espacio para los números personalizados */
	}
	.list-number::before {
		content: attr(data-number) " "; /* Utiliza el atributo data-number para la numeración */
		position: absolute;
		left: 0;
		top: 0;
		/* font-weight: bold; */
	}

	h3, h5 {
		font-weight: 700 !important;
	}

	.footer-link-terminos {
		text-decoration: none;
		color: #0006ff;
		font-weight: bold;
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
        <div class="terminos p-5" style="text-align: justify;">

            <h1 class="terminos-titulo">Términos y Condiciones Generales de Contratación</h1>

            <p>
                Esta sección establece los Términos y Condiciones Generales de Contratación (en adelante, las "Condiciones")
                para los servicios proporcionados por <strong>“PUJA INMOBILIARIA”</strong> (en adelante, los “Servicios”), a
                través del sitio web (en adelante, el "Sitio Web"). Tanto el Sitio Web como los Servicios son operados por
                la empresa ESTUDIO BUSTAMANTE & ROMERO S.A.C., titular de la marca <strong>“PUJA INMOBILIARIA”</strong>.
            </p>

            <p>
                En adelante, el término “Solicitante” se utilizará para referirse a todas las personas físicas y/o jurídicas
                que deseen contratar los Servicios regulados por estas Condiciones.
            </p>

            <h3 class="terminos-articulo">1. CONTRATACIÓN</h3>

            <p>
                Los Servicios estarán disponibles para el Solicitante dentro de las cuarenta y ocho (48) horas siguientes a
                la aceptación de estas Condiciones y/o al recibo del pago correspondiente. La aceptación será notificada por
                el Solicitante a <strong>PUJA INMOBILIARIA</strong> al ingresar al Sitio Web, crear su usuario identificable
                completando exitosamente el formulario de registro detallado en el Sitio Web y aceptar incondicionalmente
                las Condiciones.
            </p>

            <p>
                Los Servicios son de uso exclusivo del Solicitante contratante, quien no podrá compartir su Usuario con
                terceras personas. Cada Solicitante deberá aceptar directamente las Condiciones para los Servicios y no
                podrá hacerlo a través de terceros.
            </p>

            <h3 class="terminos-articulo">2. ACCESO AL SITIO WEB</h3>

            <h5 class="terminos-articulo">2.1 Acceso a los Servicios</h5>

            <p>
                Para contratar los Servicios, el Solicitante deberá crear una cuenta con un Nombre de Usuario y una
                Contraseña. El Nombre de Usuario no podrá contener ni consistir en palabras, expresiones o conjuntos
                gráfico-denominativos ofensivos, injuriosos, coincidentes con marcas, nombres comerciales, rótulos de
                establecimientos, denominaciones sociales, expresiones publicitarias, nombres y seudónimos de personajes
                relevantes o famosos para cuya utilización no esté autorizado, y, en general, contrarios a la ley o a las
                exigencias de la moral y buenas costumbres.
            </p>

            <p>
                El Solicitante es el único y exclusivo responsable de mantener y proteger la confidencialidad de su
                Contraseña. En caso de pérdida, robo o vulneración en la seguridad del Nombre de Usuario y Contraseña, el
                Solicitante se compromete a comunicarlo a <strong>PUJA INMOBILIARIA</strong> a la mayor brevedad posible,
                así como cualquier riesgo de acceso no autorizado por terceros.
            </p>

            <p>
                En cualquier momento, <strong>PUJA INMOBILIARIA</strong> podrá permitir a los Solicitantes ingresar a
                cualquiera de los portales operados por <strong>PUJA INMOBILIARIA</strong> mediante las credenciales de
                acceso (usuario y contraseña) que hayan creado para acceder a dichos portales.
            </p>

            <h3 class="terminos-articulo">3. UTILIZACIÓN DEL SITIO WEB</h3>

            <p>
                El Solicitante se compromete a no utilizar el Sitio Web y/o los Servicios con fines ilícitos, delictivos o
                ilegales, contrarios a lo establecido en estas Condiciones, en la ley peruana, lesivos a los derechos e
                intereses de terceros (incluyendo clientes de PUJA INMOBILIARIA y otros usuarios del Sitio Web), o que de
                cualquier forma puedan dañar, inutilizar, sobrecargar o deteriorar el Sitio Web o impedir su normal
                utilización por parte de los usuarios y Solicitantes
            </p>

            <h5 class="terminos-articulo">3.1 Contenido del Sitio Web</h5>

            <p>
                Los contenidos del Sitio Web, tales como texto, información, gráficos, imágenes, logos, marcas, programas de
                computación, bases de datos, diseños, arquitectura funcional y cualquier otro material (en adelante, el
                "Contenido"), están protegidos por las leyes
                aplicables, incluyendo, pero no limitándose a, las leyes sobre derechos de autor,
                patentes, marcas, modelos de utilidad, diseños industriales y nombres de dominio.
                Todo el Contenido es propiedad de <strong>PUJA INMOBILIARIA</strong> y/o de sus empresas afiliadas,
                subsidiarias y/o cualquier otra sociedad vinculada y/o de sus proveedores de contenido.
                La compilación, interconexión, operatividad y disposición de los Contenidos del Sitio
                Web es de propiedad exclusiva de <strong>PUJA INMOBILIARIA</strong> y/o de sus empresas
                vinculadas. El uso, adaptación, reproducción y/o comercialización no autorizada del
                Contenido puede estar penado por la legislación aplicable.
            </p>

            <p>
                Los Solicitantes no deberán copiar ni adaptar el código de programación desarrollado
                por, o por cuenta de, <strong>PUJA INMOBILIARIA</strong>, el cual está protegido por la legislación
                aplicable.
            </p>

            <h5 class="terminos-articulo">3.2 Uso permitido del Sitio</h5>

            <p>
                Reglas generales: Los Solicitantes tienen prohibido utilizar el Sitio Web:
            </p>

            <ol type="a">
                <li>intentando incumplir, incumpliendo o violando la legislación aplicable,</li>
                <li>de forma que se viole la confidencialidad, honor, privacidad, imagen u otros derechos de terceros,
                    incluyendo los derechos de <strong>PUJA INMOBILIARIA</strong> y de los clientes de <strong>PUJA
                        INMOBILIARIA</strong>;</li>
                <li>para enviar correos sin autorización expresa del propietario de los datos, lo cual incluye cualquier
                    tipo de comunicación, promociones y/o publicidad de productos o servicios, SPAM o propaganda política,
                    de acuerdo a lo establecido en la Ley 29751 - el Código de Protección y Defensa del Consumidor o la
                    norma que sustituya a la misma.</li>
            </ol>

            <p>
                Reglas de seguridad del Sitio Web: Los Solicitantes tienen prohibido violar o intentar
                violar la seguridad del Sitio Web, incluyendo, pero no limitándose a:
            </p>

            <ol class="custom-list">
                <li>el acceso a datos que no estén destinados a tal Solicitante o entrar en un servidor o cuenta cuyo acceso
                    no está autorizado al Solicitante,</li>
                <li>evaluar o probar la vulnerabilidad de un sistema o red, o violar las medidas de seguridad o
                    identificación sin la adecuada autorización,</li>
                <li>intentar impedir (total o parcialmente) la prestación del servicio a cualquier usuario, anfitrión o red,
                    incluyendo, pero sin limitación, mediante el envío de virus al Sitio Web, o mediante saturación o
                    ataques de denegación de servicio,</li>
                <li>enviar correos no pedidos (spam), incluyendo promociones y/o publicidad de productos o servicios, o</li>
                <li>falsificar cualquier cabecera de paquete TCP/IP y/u otro tipo de paquete de datos, o cualquier parte de
                    la información de la cabecera de cualquier correo electrónico o en mensajes de foros de debate.</li>
            </ol>

            <p>
                Las violaciones de la seguridad del sistema o de la red constituyen delitos penales y
                pueden derivar en responsabilidades civiles. <strong>PUJA INMOBILIARIA</strong> investigará los
                casos de violaciones a la seguridad del sistema, pudiendo dirigirse a la autoridad judicial
                o administrativa competente a los efectos de perseguir a los Solicitantes involucrados
                en tales violaciones.
            </p>

            <p>
                <strong>PUJA INMOBILIARIA</strong> prohíbe específicamente cualquier utilización del Sitio Web o de
                los Servicios para:
            </p>

            <ol>
                <li>Anunciar datos biográficos incompletos, falsos o inexactos.</li>
                <li>Usar cualquier mecanismo para impedir o intentar impedir el adecuado funcionamiento de este Sitio Web
                    y/o cualquier actividad que se esté realizando en el Sitio Web.</li>
                <li>Revelar o compartir su contraseña con terceras personas, o usar su contraseña para propósitos no
                    autorizados.</li>
                <li>El uso o intento de uso de cualquier máquina, software, herramienta, agente u otro mecanismo para
                    navegar o buscar en el Sitio Web que sean distintos a las herramientas de búsqueda provistos por
                    <strong>PUJA INMOBILIARIA</strong>.</li>
                <li>Intentar descifrar, descompilar u obtener el código fuente de cualquier programa de software del Sitio
                    Web.</li>
            </ol>

            <h5 class="terminos-articulo">3.3 Los Solicitantes no deberán:</h5>

            <ol type="a">
                <li>Hacer mención y/o referencia y/o publicar enlaces a otras páginas web
                    dedicadas a la búsqueda de inmuebles.</li>
                <li>Publicar dos o más avisos que refieran a la misma propiedad con el mismo tipo
                    de operación, en forma simultánea.
                </li>
                <li>Publicar avisos falsos o erróneos.</li>
                <li>Comercializar el Servicio contratado a terceras personas.
                </li>
                <li>Compartir el Servicio con terceras personas.</li>
                <li>Publicar en el título y/o descripción y/o en las fotografías del aviso datos de
                    contacto (números telefónicos, direcciones, correos electrónicos, etc) o
                    información (por ejemplo, links) que dirijan a páginas web externas a las del Sitio
                    Web.</li>
                <li>Publicar propagandas o contenido políticos y/o religiosos de ningún tipo, y/o que
                    fueren contrario a la moral, los usos y buenas costumbres.</li>
                <li>Publicar avisos clasificados (gratuitos o de costo) para el arrendamiento y/o
                    compraventa de bienes inmuebles de los cuales no se tenga la propiedad,
                    derecho de usufructo, representación, poder o encargo contractual para
                    ofrecerlos a terceros.</li>
                <li>
                    Publicar ofertas que hagan mención de manera directa o indirecta a actividades
                    ilícitas o fraudulentas.
                </li>
                <li>
                    Publicar avisos que no sean de venta y/o alquiler de inmuebles y/o que ofrezcan
                    bienes muebles o servicios, y/o sean meramente publicitarios.
                </li>
                <li>Realizar la publicación de avisos (gratuitos o de costo) para el arrendamiento y/o
                    compraventa de bienes inmuebles con fines ilícitos, ilegales, o delictivos, que
                    sean contrarios a lo establecido en estas Condiciones, las Condiciones Generales
                    de Uso y lesivos de los derechos e intereses de terceras personas.
                </li>
                <li>Omitir información respecto a cobros y/o depósitos previos para realizar visitas
                    al inmueble.
                </li>
                <li>Colocar números de contacto del extranjero.</li>
                <li>Solicitar adelantos de dinero fuera de un contrato de alquiler/venta o arras de
                    una separación.</li>
            </ol>

            <h5 class="terminos-articulo">3.4 Canales de comunicación disponibles para los Solicitantes</h5>

            <p>
                El Solicitante deberá utilizar los canales de comunicación disponibles —como chats y
                foros de discusión, entre otros— (en adelante, los <strong>“Canales”</strong>) de forma responsable,
                correcta, respetuosa y dando fiel cumplimiento a la normativa vigente.
            </p>

			<p>
				El contenido de cada mensaje enviado por el Solicitante a través de los Canales es de única y exclusiva responsabilidad del Solicitante. <strong>PUJA INMOBILIARIA</strong> no garantiza la veracidad ni exactitud de los datos personales y/o contenidos de cada mensaje efectuados y/o publicados en los Canales por el Solicitante. El Solicitante acepta voluntariamente que el acceso a y/o el uso de los Canales tiene lugar, en todo caso, bajo su exclusiva y única responsabilidad.
			</p>

			<p>
				<strong>PUJA INMOBILIARIA</strong> se reserva el derecho a suspender temporal o definitivamente el
                acceso a los Canales y/o a los Servicios sin previo aviso, a quien no respete las presentes
                Condiciones o realice actos que atenten contra el normal funcionamiento de los
                Servicios y/o de los Canales y/o del Sitio Web y/o que utilice los Canales y/o Servicios en
                forma contraria a estas Condiciones o los Términos y Condiciones Generales de Uso.
			</p>

            <p>
                El Solicitante reconoce y acepta que las siguientes conductas se encuentran
                terminantemente prohibidas y por lo tanto se obliga irrevocablemente a abstenerse de
                realizarlas, a saber:
            </p>

            <ol>
                <li><span class="list-number" data-number="3.4.1."></span> utilizar lenguaje vulgar / obsceno,discriminatorio y/u ofensivo;</li>
                <li><span class="list-number" data-number="3.4.2."></span> todo tipo de ataque personal contra usuarios del Sitio Web y/o terceros, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>, mediante acoso, amenazas, insultos;</li>
                <li><span class="list-number" data-number="3.4.3."></span> todo acto contrario a las leyes, la moral y las buenas costumbres;</li>
                <li><span class="list-number" data-number="3.4.4."></span> publicar mensajes, imágenes e hipervínculos agraviantes, difamatorios, calumniosos, injuriosos, falsos, discriminatorios, pornográficos, de contenido violento, insultantes, amenazantes, incitantes a conductas ilícitas o peligrosas para la salud, que lesionen el honor y/o que vulneren de cualquier forma la privacidad de cualquier tercero como así también la violación directa o indirecta de los derechos de propiedad intelectual de <strong>PUJA INMOBILIARIA</strong> y/o de cualquier tercero, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>;</li>
                <li><span class="list-number" data-number="3.4.5."></span> publicar mensajes que puedan herir y/o afectar la sensibilidad del resto de los usuarios del Sitio Web y/o de cualquier tercero, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>;</li>
                <li><span class="list-number" data-number="3.4.6."></span> promocionar, comercializar, vender, publicar y/u
                    ofrecer cualquier clase de productos, servicios y/u actividades por intermedio de o a través de la
                    utilización de los Canales, excepto aquellas expresamente permitidas por <strong>PUJA INMOBILIARIA</strong>;</li>
                <li><span class="list-number" data-number="3.4.7."></span> la venta, locación o cesión, ya sea a título
                    oneroso o gratuito, del espacio de comunicación de los Canales;</li>
                <li><span class="list-number" data-number="3.4.8."></span> publicar mensajes que de cualquier forma
                    contengan publicidad;</li>
                <li><span class="list-number" data-number="3.4.9."></span> el uso o envío de virus informáticos, malware,
                    spyware, ransomware y/o la realización de todo acto que cause o pudiera causar daños o perjuicios al
                    normal funcionamiento de los Servicios y/o los Canales, o de los equipos informáticos o software de <strong>PUJA INMOBILIARIA</strong> y/o de cualquier tercero, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>;</li>
                <li><span class="list-number" data-number="3.4.10."></span> todo acto dirigido a enmascarar y/o falsificar o
                    disimular direcciones IP, correos electrónicos y/o cualquier otro medio técnico de identificación de los
					Solicitantes o sus equipos informáticos;</li>
                <li><span class="list-number" data-number="3.4.11."></span> todo acto que viole la privacidad de los
                    usuarios del Sitio Web, o que viole cualquiera de sus derechos bajo la legislación en vigor en el país;
                </li>
                <li><span class="list-number" data-number="3.4.12."></span> la publicación de datos personales sin el
                    consentimiento expreso del titular de los mismos;</li>
                <li><span class="list-number" data-number="3.4.13."></span> la transmisión o divulgación de material que
                    viole la legislación en vigor en el país y/o que pudiera herir la sensibilidad de los usuarios del Sitio
                    Web y/o de cualquier tercero, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>;</li>
                <li><span class="list-number" data-number="3.4.14."></span> la publicación de cualquier tipo de contenido en
                    violación de derechos de terceros, incluyendo clientes de <strong>PUJA INMOBILIARIA</strong>, incluyendo sin limitación
                    los derechos de propiedad intelectual y/o industrial.</li>
            </ol>

            <p>
                <strong>IMPORTANTE: PUJA INMOBILIARIA</strong> no tiene obligación de controlar ni controla la utilización que el Solicitante haga de los Canales ni del contenido de las publicaciones realizadas en los mismos y/o en los avisos del Sitio Web. No obstante, ello, <strong>PUJA INMOBILIARIA</strong> se reserva el derecho de no publicar o remover luego de ser publicados todos aquellos contenidos y/o mensajes propuestos y/o publicados por el Solicitante que, a exclusivo criterio de <strong>PUJA INMOBILIARIA</strong>, no respondan estrictamente a las disposiciones contenidas en estas Condiciones y/o resulten impropios y/o inadecuados a las características, finalidad y/o calidad de los Servicios.
            </p>

            <p>
                <strong>PUJA INMOBILIARIA</strong> no garantiza la disponibilidad y continuidad del funcionamiento de los Canales.
            </p>

            <p>
                <strong>PUJA INMOBILIARIA</strong> no es en ningún caso responsable de la destrucción, alteración o eliminación del contenido o información que cada Solicitante o usuario del Sitio Web incluya en sus mensajes.
            </p>

            <p>
                Cada Solicitante y usuario del Sitio Web es el único y exclusivo responsable de sus manifestaciones, dichos, opiniones y todo acto que realice a través de los Canales.
            </p>

            <h5 class="terminos-articulo">3.5 Derecho de suspensión y/o baja</h5>

            <p>
                <strong>PUJA INMOBILIARIA</strong> se reserva el derecho de suspender en forma indefinida, excluir,
                prohibir el acceso al Sitio Web y/o dar de baja a cualquier cuenta, aviso, Solicitante y/o
                usuario que, a exclusivo criterio de <strong>PUJA INMOBILIARIA</strong>, no cumpla con los estándares
                definidos en estas Condiciones, los Términos y Condiciones Generales de Uso, o con las
                políticas vigentes de <strong>PUJA INMOBILIARIA</strong>, sin que ello implique el deber de reembolso
                o resarcimiento alguno por parte de <strong>PUJA INMOBILIARIA</strong>.
            </p>

            <h3 class="terminos-articulo">4. CONDICIONES COMERCIALES</h3>

            <h5 class="terminos-articulo">4.1 Condiciones comerciales generales</h5>

            <p>
                Como contraprestación por la prestación de los Servicios, el Solicitante se obliga a
                abonar a <strong>PUJA INMOBILIARIA</strong> los cargos indicados en la orden particular emitida al
                solicitar el Servicio, o bien detallados en la sección “Publicar un Inmueble” del Sitio Web
                en caso de Planes adquiridos via E-Commerce, en función de cada servicio contratado.
                La fecha y forma de pago será la que pacten las partes al momento de la contratación
                de los Servicios o en su defecto dentro de los 15 días de la fecha de facturación. El
                Servicio no incluye costos ni servicio de conexión a Internet ni ninguna otra prestación
                y/o servicio que no esté expresamente detallada en la orden particular, los cuales son a
                cargo y costo total y exclusivo del Solicitante.
            </p>

            <p>
                Mediante la aceptación de estas Condiciones, el Solicitante acepta que los Servicios se
                prestan a través de distintas modalidades y paquetes, atendiendo a distintos factores
                (por ejemplo, el volumen y cantidad de los Servicios que contrate el Solicitante), por lo
                que los precios o costos finales puede variar de un proceso de contratación a otro. Cada
                Servicio contratado por cada Solicitante es una relación comercial y jurídica
                independiente de cualquier otra y la prestación de Servicios por parte de <strong>PUJA INMOBILIARIA</strong>
                no se deberá de interpretar en conjunto, sino en lo individual.
            </p>

            <p>
                Los Solicitantes podrán cancelar los Servicios que hubieren contratado en cualquier
                momento y a su entera discreción, debiendo dar previa notificación a <strong>PUJA INMOBILIARIA</strong>. Sin
                perjuicio de ello, no tendrán derecho a reembolso alguno de los
                Servicios contratados.
            </p>

            <h5 class="terminos-articulo">4.2 Condiciones comerciales especiales para compras online o por E-Commerce</h5>

            <p>
                En caso de que los Solicitantes adquieran a través de E-Commerce los Servicios que se
                encuentran detallados en la sección “Publicar un Inmueble” y descriptos como planes
                para Particular Dueño Directo, Inmobiliaria Corredor o Desarrolladora Constructora (en
                adelante los <strong>“Planes”</strong>), los siguientes términos y condiciones especiales aplicarán:
            </p>

            <ol>
                <li><span class="list-number" data-number="4.2.1."></span> Los Solicitantes deberán leer detenidamente los
                    Servicios que incluye cada Plan, los términos de pago, y las demás condiciones de cada Plan, los cuales
                    estarán descriptas en el Sitio Web.</li>
                <li><span class="list-number" data-number="4.2.2."></span> Cada Plan tendrá un plazo de publicación de 30
                    (treinta) o 90 (noventa) días corridos/naturales contados a partir de la acreditación del pago, o bien
                    el plazo especificado para cada Plan.</li>
                <li><span class="list-number" data-number="4.2.3."></span> Vencido el referido plazo, y en caso de así
                    detallarlo la descripción del Plan, el mismo se renovará en forma automática por igual plazo, salvo que
                    el Solicitante lo cancele, bajo las condiciones detalladas en el punto 4 siguiente.</li>
                <li><span class="list-number" data-number="4.2.4."></span> El Solicitante podrá cancelar su Plan en
                    cualquier momento, y continuará teniendo acceso al Plan hasta el final de su periodo de facturación. Los
                    pagos no son reembolsables y no se otorgarán reembolsos ni créditos por los periodos del Plan utilizados
                    parcialmente o por el servicio no utilizado. Si cancela el Plan, el mismo se dará de baja
                    automáticamente al final de su periodo de facturación actual. Para cancelar el Plan, el Solicitante
                    deberá ingresar a la sección “Contrataciones” en su panel de anunciante.</li>
                <li><span class="list-number" data-number="4.2.5."></span> El Plan será facturado al Solicitante por
                    adelantado y conforme se encuentra especificado en la descripción de cada Plan. Para la activación del
                    Plan contratado, se deberá acreditar el pago de la primera factura.</li>
                <li><span class="list-number" data-number="4.2.6."></span> El pago de la facturación se realizará por débito
                    automático mediante las tarjetas de crédito autorizadas por <strong>PUJA INMOBILIARIA</strong></li>
            </ol>

            <h3 class="terminos-articulo">5. MORA. FALTA DE PAGO. INCUMPLIMIENTOS</h3>

            <p>
                La mora en el cumplimiento de las obligaciones asumidas por el Solicitante en estas
                Condiciones será automática, sin necesidad de notificación judicial o extrajudicial
                alguna, y devengará los intereses moratorios.
            </p>

            <p>
                La falta de pago en término de cualquier factura remitida por <strong>PUJA INMOBILIARIA</strong> al
                Solicitante facultará a <strong>PUJA INMOBILIARIA</strong> a suspender inmediatamente el Servicio
                hasta su efectivo pago, sin que ello genere derecho al Solicitante a reclamo ni
                indemnización alguna. Si dicho pago no se regulariza, <strong>PUJA INMOBILIARIA</strong> podrá, a
                su exclusivo criterio, resolver la relación contractual con el Solicitante, y reclamar los
                daños y perjuicios ocasionados.
            </p>

            <p>
                En caso que el Solicitante adeuda el pago de facturas a <strong>PUJA INMOBILIARIA</strong> y realizare
                un pago para la contratación de un nuevo servicio, <strong>PUJA INMOBILIARIA</strong> podrá a su
                sola discreción, imputar los pagos realizados a las facturas impagas y suspender
                inmediatamente el Servicio hasta que el Solicitante cancele todas las facturas impagas,
                sin que ello genere derecho al Solicitante a reclamo ni indemnización alguna. Si dicho
                pago no se regulariza, <strong>PUJA INMOBILIARIA</strong> podrá, a su exclusivo criterio, resolver la
                relación contractual con el Solicitante, y reclamar los daños y perjuicios ocasionados.
            </p>

            <h3 class="terminos-articulo">6. PLAZO DE VIGENCIA</h3>

            <p>
                Los Servicios serán provistos por <strong>PUJA INMOBILIARIA</strong> durante el plazo determinado
                en la orden de servicio acordada con el ejecutivo de ventas o a través de los medios
                especialmente determinados a tal efecto, o bien el detallado en el Sitio Web al
                momento de hacer la compra de un Plan por E-Commerce. El plazo de vigencia será
                contado en días calendario corridos desde la fecha de aceptación de la Solicitud por
                parte de <strong>PUJA INMOBILIARIA</strong>, o a partir de la acreditación del pago para el caso de
                Planes adquiridos por E-Commerce (en adelante, el <strong>“Plazo de Vigencia”</strong>). Vencido el
                Plazo de Vigencia, la prestación de los Servicios cesará en forma automática, sin
                necesidad de previo aviso al Solicitante, salvo que se trate de Planes con renovación
                automática para los cuales regirá lo establecido en la Cláusula 4.2 del presente.
            </p>


            <h3 class="terminos-articulo">7. DISPONIBILIDAD DEL SERVICIO</h3>

            <p>
                <strong>PUJA INMOBILIARIA</strong> no garantiza la disponibilidad ininterrumpida de los Servicios, ni
                su funcionamiento libre de errores. El Solicitante reconoce y acepta expresamente que
                <strong>PUJA INMOBILIARIA</strong>, sus sociedades controladas, controlantes, vinculadas y
                empresas intervinientes en la prestación del Servicio, NO SERÁN EN MODO ALGUNO
                RESPONSABLES POR LA SUSPENSIÓN Y/O INTERRUPCIÓN DEL SERVICIO Y/O
                FALLAS EN LA PROVISIÓN DEL SERVICIO (SALVO DOLO O CULPA GRAVE), NI
                RESULTAN POR ENDE EN MODO ALGUNO RESPONSABLES POR LOS DAÑOS Y
                PERJUICIOS QUE PUDIERAN DERIVARSE DE ELLO.
            </p>

            <h3 class="terminos-articulo">8. . DECLARACIONES Y GARANTÍAS</h3>

            <h5 class="terminos-articulo">8.1 El Solicitante reconoce y acepta que:</h5>

            <ol>
                <li><span class="list-number" data-number="8.1.1."></span> <strong>PUJA INMOBILIARIA</strong> no garantiza la utilidad de los
                    Servicios para finalidades específicas.</li>
                <li><span class="list-number" data-number="8.1.2."></span> <strong>PUJA INMOBILIARIA</strong> no será responsable por las
                    relaciones que como consecuencia del uso de los Servicios puedan entablarse entre los usuarios del Sitio
                    Web y el Solicitante.</li>
                <li><span class="list-number" data-number="8.1.3."></span> <strong>PUJA INMOBILIARIA</strong> no será responsable por la
                    veracidad de los datos y/o información, y/o la licitud de los contenidos que los usuarios o los
                    Solicitantes ingresen al Sitio Web.</li>
                <li><span class="list-number" data-number="8.1.4."></span> <strong>PUJA INMOBILIARIA</strong> tampoco tiene la obligación de
                    verificar la identidad ni la capacidad para contratar de los usuarios del Sitio Web, ni la veracidad,
                    vigencia, y/u autenticidad de los datos que los usuarios proporcionen sobre sí mismos.</li>
                <li><span class="list-number" data-number="8.1.5."></span> <strong>PUJA INMOBILIARIA</strong> no garantiza ningún número
                    mínimo de visitas por parte de Usuarios a los anuncios que publique el Solicitante en los Sitios Webs,
                    por lo que el Solicitante excluye toda responsabilidad de PUJAINMOBILIARIA por los daños y perjuicios de
                    toda naturaleza que pudiera sufrir como consecuencia de la ausencia de visitas de Usuarios.</li>
                <li><span class="list-number" data-number="8.1.6."></span> <strong>PUJA INMOBILIARIA</strong> podrá replicar el contenido de
                    los anuncios que publique el Solicitante en los Sitios Web.</li>
                <li><span class="list-number" data-number="8.1.7."></span> <strong>PUJA INMOBILIARIA</strong> no es responsable en ningún
                    caso por el mal uso que le den los Solicitantes anunciantes al Sitio Web mediante la publicación de
                    avisos clasificados que sean o resulten engañosos, fraudulentos, incompletos, falsos o inexactos.</li>
                <li><span class="list-number" data-number="8.1.8."></span> Cualquier Solicitante que utiliza el Sitio Web y
                    contrata los Servicios, lo hace asumiendo todos los riesgos que ello implica. <strong>PUJA INMOBILIARIA</strong> en
                    ningún caso garantiza que: (i) los Solicitantes anunciantes sean quien ostentan ser; (ii) los derechos o
                    interés jurídico que los Solicitantes anunciantes tengan, o bien no tengan, sobre los inmuebles
                    anunciados; (iii) los precios de venta o renta de los inmuebles anunciados, en cualquier modalidad, en
                    nuestra plataforma, y tampoco asume obligación alguna de verificar dicha información.</li>
                <li><span class="list-number" data-number="8.1.9."></span> <strong>PUJA INMOBILIARIA</strong>, sus directivos, empleados,
                    accionistas o asesores, en ningún caso crean, realizan, o redactan el anuncio que publican los
                    Solicitantes anunciantes.</li>
                <li><span class="list-number" data-number="8.1.10."></span> <strong>PUJA INMOBILIARIA</strong> niega expresamente cualquier
                    garantía de comerciabilidad, calidad satisfactoria, idoneidad para un fin determinado, uso y disfrute
                    pacífico o no infracción, así como cualquier garantía expresa o implícita.</li>
            </ol>

            <h5 class="terminos-articulo">8.2 El Solicitante declara y garantiza que:</h5>

            <ol>
                <li><span class="list-number" data-number="8.2.1."></span> El uso de los Servicios se lleva a cabo bajo su
                    única y exclusiva responsabilidad y riesgo comercial.</li>
                <li><span class="list-number" data-number="8.2.2."></span> Utilizará los Servicios en un todo de acuerdo a
                    estas Condiciones, las Condiciones Generales de Uso, la normativa vigente y demás leyes, decretos,
                    resoluciones, disposiciones y decisiones gubernamentales que en el futuro se dicten y resulten
                    aplicables.</li>
                <li><span class="list-number" data-number="8.2.3."></span> Cuenta con plenas facultades para aceptar estas
                    Condiciones y cumplir con todas las obligaciones emergentes de la prestación de los Servicios.</li>
                <li><span class="list-number" data-number="8.2.4."></span> Ningún integrante del personal del Solicitante
                    actuará ni realizará declaración alguna ni actuará de modo tal que razonablemente pueda dar lugar a un
                    daño para <strong>PUJA INMOBILIARIA</strong>, inclusive un perjuicio a su reputación. El Solicitante será responsable por
                    las acciones de las personas que utilicen su cuenta y el Servicio en su nombre y/o que estén en relación
                    de dependencia y/o contratadas y/o vinculadas.</li>
                <li><span class="list-number" data-number="8.2.5."></span> El Solicitante indemnizará y mantendrá indemne a
                    PUJA INMOBILIARIA por los reclamos y las pérdidas sufridas como resultado de cualquier violación a
                    cualquier garantía estipulada en la presente cláusula y en las Condiciones y/o por cualquier reclamo
                    relacionado al uso del Servicio y/o formulado por sus dependientes y/o terceros.</li>
            </ol>

            <h3 class="terminos-articulo">9. RESPONSABILIDAD</h3>

            <p>
                9.1. El Solicitante expresamente reconoce y acepta: (i) que <strong>PUJA INMOBILIARIA</strong>, sus
                sociedades controlantes, controladas, vinculadas y las empresas intervinientes en la
                prestación del Servicio, no serán en ningún caso responsables por ningún daño
                mediato, indirecto, especial de carácter ejemplar o punitorio (incluyendo a manera
                enunciativa no limitativa, lucro cesante, pérdida de ingresos, de información, de
                intereses, valor llave, pérdida o alteración de datos o cualquier otra pérdida o
                interrupción de actividades comerciales del Solicitante, ya sea contractual o
                extracontractual, aun cuando se hubiera advertido de la posibilidad de que tales daños
                ocurran, y (ii) que la responsabilidad total hacia el Solicitante (esto es el monto máximo
                de daños y perjuicios que <strong>PUJA INMOBILIARIA</strong> pueda estar obligada a pagar) está
                limitada al precio total del Servicio por el Plazo de Vigencia; renunciando el Solicitante
                en forma irrevocable en este acto a formular reclamo alguno a <strong>PUJA INMOBILIARIA</strong>,
                a las sociedades controlantes, controladas y vinculadas de <strong>PUJA INMOBILIARIA</strong> y a las
                empresas intervinientes en la prestación del Servicio, como así también a efectuar
                reclamo alguno a <strong>PUJA INMOBILIARIA</strong> por un monto superior al límite antedicho.
            </p>

            <p>
                9.2. El Solicitante acepta expresamente que este límite constituye un componente
                fundamental de su contrato con <strong>PUJA INMOBILIARIA</strong> y de la aprobación de la Solicitud
                por parte de <strong>PUJA INMOBILIARIA</strong>, reflejando la distribución de riesgos relacionados
                con la prestación del Servicio. <strong>PUJA INMOBILIARIA</strong> no aceptaría una Solicitud bajo
                ninguna otra condición.
            </p>

            <p>
                9.3. Tanto <strong>PUJA INMOBILIARIA</strong> como el Solicitante no serán responsables por
                cualquier incumplimiento o demora ocasionada por eventos o circunstancias fuera de
                su control razonable, incluyendo, pero no limitándose a, fuerza mayor, actos
                gubernamentales, terrorismo, desastres naturales, etc.
            </p>

            <h3 class="terminos-articulo">10. PROPIEDAD INTELECTUAL</h3>

            <p>
                10.1. El Solicitante se compromete a no utilizar, bajo ninguna forma, las marcas,
                solicitudes de marcas, patentes, modelos de utilidad, modelos y diseños industriales,
                insignias, logotipos, isotipos, nombres comerciales, nombres sociales, enseñas,
                derechos de autor, nombres de dominio, “know how” y todos los demás derechos de
                propiedad intelectual e industrial (de cualquier tipo y naturaleza a nivel mundial
                independientemente de su designación) de <strong>PUJA INMOBILIARIA</strong> y/o cualquier
                sociedad controlante, controlada, afiliada y/o vinculada, sin previa autorización por
                escrito.
            </p>

            <p>
                10.2. El Solicitante reconoce los derechos, títulos e intereses de <strong>PUJA INMOBILIARIA</strong>
                en las marcas registradas o no, insignias, logotipos, diseños, palabras o nombres no
                registrados que identifican y distinguen a <strong>PUJA INMOBILIARIA</strong>, y acepta no
                involucrarse en actividades ni realizar actos que puedan directa o indirectamente
                disputar o poner en riesgo dichos derechos, títulos o intereses. Asimismo, el Solicitante
                no deberá solicitar ni adquirir ante las autoridades competentes, como marca de
                producto, servicio, denominación, nombre de dominio, razón social o nombre
                comercial, marcas similares, parecidas o confundibles con las marcas registradas u
                otros signos no registrados que identifiquen y distingan a <strong>PUJA INMOBILIARIA</strong>, ni
                reclamar derechos, títulos o intereses sobre las marcas de <strong>PUJA INMOBILIARIA</strong>.
            </p>

            <p>
                10.3. En caso de que el Solicitante utilice marcas, logotipos, denominaciones sociales u
                otros elementos de propiedad intelectual en los anuncios publicados, autoriza
                expresamente a <strong>PUJA INMOBILIARIA</strong> a utilizar, publicar y/o difundir los mismos
                únicamente para los fines del cumplimiento del Servicio contratado y solo por el
                periodo de duración del mismo.
            </p>

            <h3 class="terminos-articulo">11. MODIFICACIONES</h3>

            <p>
                La plataforma, herramientas y el Sitio Web a través de los cuales se prestan los Servicios
                podrán ser modificados unilateralmente por <strong>PUJA INMOBILIARIA</strong> (total o
                parcialmente) sin necesidad de previo aviso ni conformidad del Solicitante, sin que este
                tenga derecho a indemnización ni reembolso alguno por los Servicios contratados.
                Todas las modificaciones se considerarán conocidas y aceptadas por el Solicitante con
                solo acceder a los Servicios, siendo responsabilidad de cada usuario y/o Solicitante
                revisar periódicamente estas Condiciones, independientemente de si ya contrató un
                Servicio.
            </p>

            <p>
                Asimismo, el Solicitante reconoce y acepta que <strong>PUJA INMOBILIARIA</strong> podrá, previa
                notificación por escrito con al menos quince (15) días corridos de anticipación, modificar
                las condiciones comerciales de contratación de cada Servicio (incluyendo su precio). El
                Solicitante tendrá un plazo de diez (10) días corridos de recibida la notificación de PUJA
                INMOBILIARIA para aceptar o rechazar los nuevos precios o condiciones propuestas.
                Vencido dicho plazo sin que el Solicitante hubiera notificado fehacientemente el
                rechazo a los nuevos precios o condiciones propuestas por <strong>PUJA INMOBILIARIA</strong>, éstas
                se reputarán aceptados por el Solicitante y resultarán aplicables automáticamente
                desde la fecha indicada en la notificación cursada por <strong>PUJA INMOBILIARIA</strong>. En caso
                que el Solicitante notificare fehacientemente a <strong>PUJA INMOBILIARIA</strong> el rechazo a los
                nuevos precios o condiciones propuestas dentro del plazo de diez (10) días antes
                mencionado, finalizará la prestación del Servicio por parte de <strong>PUJA INMOBILIARIA</strong> el
                día inmediato anterior al de la entrada en vigencia de las nuevas condiciones
                comerciales propuesta por <strong>PUJA INMOBILIARIA</strong>, sin que ello genere el derecho a
                resarcimiento alguno para cualquiera de las partes.
            </p>

            <h3 class="terminos-articulo">12. TERMINACIÓN</h3>

            <p>
                12.1. <strong>PUJA INMOBILIARIA</strong> podrá terminar anticipadamente la relación contractual con
                el Solicitante y por ende la prestación del Servicio: (a) sin necesidad de invocar causa
                alguna, debiendo al efecto preavisar en forma fehaciente con por lo menos treinta (30)
                días corridos de anticipación a la fecha de terminación; (b) en cualquier momento y sin
                deber de otorgar preaviso al Solicitante, en caso de que el Solicitante incumpla con
                cualquiera de las disposiciones contenidas en estas Condiciones y/o en los Términos y
                Condiciones Generales de Uso. Asimismo, en caso de infracción o incumplimiento de
                cualquiera de las estipulaciones de estas Condiciones o de los Términos y Condiciones
                Generales de Uso por parte del el Solicitante, el ejercicio de esta opción por parte de
                <strong>PUJA INMOBILIARIA</strong> no generará a favor del Solicitante derecho a devoluciones o a
                percibir suma alguna por ningún concepto, en especial por daños y perjuicios, lucro
                cesante o ganancias perdidas, daño emergente, etc.; y (c) en cualquier momento y sin
                deber de otorgar preaviso al Solicitante, en caso de mediar un pedido de quiebra,
                presentación en concurso preventivo, cesación de pagos o cualquier otra circunstancia
                que manifieste razonablemente una disminución de la solvencia del Solicitante o de su
                capacidad en el cumplimiento de las obligaciones asumidas. El ejercicio de esta opción
                no generará a favor del Solicitante derecho a percibir suma alguna por ningún concepto,
                en especial por daños y perjuicios, lucro cesante o ganancias perdidas, daño emergente,
                etc.
            </p>

            <p>
                12.2. El incumplimiento por el Solicitante a cualquiera de las obligaciones a su cargo consignadas en las presentes Condiciones, en las Condiciones Generales de Uso o en las condiciones particulares que pudieran aplicar a cada Servicio, facultará a <strong>PUJA INMOBILIARIA</strong> a: (a) tener por resuelto el presente automáticamente y de pleno derecho y sin deber de preaviso o indemnización al Solicitante; y/o (b) exigir el cumplimiento de la prestación debida, en ambos casos con más la indemnización de los daños y perjuicios ocasionados.
            </p>

            <h3 class="terminos-articulo">13. CESIÓN O USO COMERCIAL NO AUTORIZADO</h3>

            <p>
                13.1. El Solicitante acepta no ceder, bajo ningún título, sus derechos u obligaciones bajo
                estas Condiciones y/o las condiciones particulares que pudieran aplicar a los Servicios.
                El Solicitante también acepta no realizar ningún uso comercial no autorizado del Sitio
                Web. Por su parte, <strong>PUJA INMOBILIARIA</strong> podrá ceder las presentes Condiciones y/o las
                condiciones particulares que pudieran aplicar a los Servicios, sin necesidad de
                notificación o autorización del Solicitante.
            </p>

            <p>
                13.2. Asimismo, el Usuario se compromete a utilizar el Sitio Web y los Servicios
                diligentemente y de conformidad con la ley aplicable y con estas Condiciones
            </p>

            <h3 class="terminos-articulo">14. INDEPENDENCIA JURÍDICA</h3>

            <p>
                En ningún caso se entenderá que existe una relación societaria y/o laboral y/o de
                dependencia ni asociativa de ningún tipo, entre el Solicitante y <strong>PUJA INMOBILIARIA</strong> o
                entre el <strong>PUJA INMOBILIARIA</strong> y el personal dependiente o contratado del Solicitante,
                directivos o accionistas, ni que alguna de las partes tiene poder para representar a la otra.
            </p>

            <h3 class="terminos-articulo">15. INDEMNIDAD</h3>

            <p>
                El Solicitante acepta defender, indemnizar y sacar en paz y a salvo a <strong>PUJA INMOBILIARIA</strong> y a
                sus filiales y subsidiarias, y a sus respectivos consejeros, directivos,
                empleados, representantes, agentes y asesores, frente a cualquier cargo, acción judicial
                o extrajudicial, demanda de cualquier naturaleza, denuncia penal, reclamación o
                responsabilidad, pena, multa o sanción pecuniaria, de cualquier naturaleza y como
                quiera que se denomine, que surjan de o estén de alguna manera relacionados con (a)
                cualquier incumplimiento de las presentes Condiciones; (b) la falsedad o incorrección
                de cualquier información, publicada por el Solicitante en el Sitio Web o por cuenta del
                Usuario, incluyendo en relación con el (los) inmueble(s) anunciados, la titularidad
                Solicitante sobre el Inmueble o su facultad para venderlo o arrendarlo, los datos
                proporcionados <strong>PUJA INMOBILIARIA</strong> para crear su cuenta en el Sitio Web, y/o
                contenido de cualquier anuncio clasificado (ya sea gratuito o de costo); y (c) cualquier
                interacción con cualquier otro Usuario o cualquier tercero. Dicha indemnización
                incluirá, pero no está limitada a los gastos y honorarios razonables de abogados en los
                que <strong>PUJA INMOBILIARIA</strong> incurra al defenderse de cualquier proceso o procedimiento
                que se interponga en su contra.
            </p>

            <h3 class="terminos-articulo">16. GENERAL</h3>

            <p>
                16.1. En caso de declararse la nulidad de alguna de las cláusulas de éstas Condiciones,
                tal nulidad no afectará a la validez de las restantes, las cuales mantendrán su plena
                vigencia y efecto.
            </p>

            <p>
                16.2. <strong>PUJA INMOBILIARIA</strong> se reserva el derecho a modificar total o parcialmente estas Condiciones en cualquier momento, en cuyo caso las Condiciones actualizadas se publicarán en el Sitio Web, siendo obligación de los Solicitantes revisar regularmente esta sección a fin de informarse de cualquier cambio que se pueda haber producido. El Solicitante acepta que la mera publicación de las Condiciones actualizadas por parte de <strong>PUJA INMOBILIARIA</strong> tendrá plena validez como notificación suficiente. Sin perjuicio de ello, en caso de llevar a cabo alguna modificación, <strong>PUJA INMOBILIARIA</strong> podrá notificar al Solicitante a la dirección de correo electrónico registrada para utilizar el Sitio Web y los Servicios. El Solicitante acepta que la notificación por parte de <strong>PUJA INMOBILIARIA</strong> a dicha dirección de correo electrónico tendrá plena validez como notificación suficiente. Asimismo, si el Solicitante persiste en la utilización de los Servicios y/o el Sitio Web, se considerará que ha aceptado implícitamente las nuevas Condiciones.
            </p>

            <p>
                16.3. La tolerancia de <strong>PUJA INMOBILIARIA</strong> respecto del incumplimiento del
                Solicitante a cualquier disposición de las presentes Condiciones no podrá entenderse
                como renuncia a ejercer sus derechos para exigir su cumplimiento.
            </p>

			<p>
				16.4. El Solicitante declara que los inmuebles que anuncia son de su propiedad o se
                encuentra legalmente habilitado para ofrecerlos en alquiler o venta.
			</p>

			<p>
				16.5 Estas Condiciones, junto con la Política de Privacidad, los Términos y Condiciones
                Generales de Uso del Sitio Web, y las condiciones particulares que pudieran
                corresponder a cada Servicio (incluyendo las descripciones de la sección “Publicar un
                Inmueble” del Sitio Web en caso de Planes adquiridos via E-Commerce), constituyen la
                totalidad del acuerdo entre el Solicitante y <strong>PUJA INMOBILIARIA</strong>.
			</p>

			<p>
				16.6 Forman parte integral e inseparable de estas Condiciones la Política de Privacidad
                del Sitio Web. Los mismos se podrán consultar dentro del Sitio Web mediante el enlace
                abajo provisto o accediendo directamente a las páginas correspondientes:
                <a class="footer-link-terminos" href="/politica-privacidad" target="_blank">Politicas de Privacidad</a>
			</p>

            <h3 class="terminos-articulo">17. LOCALIZACIÓN</h3>

            <h5 class="terminos-articulo">17.1 PERÚ</h5>

            <p>
                17.1.1. <strong>PUJA INMOBILIARIA</strong> pertenece a la empresa <strong>ESTUDIO BUSTAMANTE &
                ROMERO S.A.C.</strong>, con número de RUC <strong>20606061341</strong>, con domicilio en Av. Canaval y
                Moreyra 290, Oficina 32, San Isidro, Lima Perú.
            </p>

            <p>
                17.1.2. El Sitio Web es <a class="footer-link-terminos" href="/" target="_blank"> www.pujainmobiliaria.com.pe</a>.
            </p>

            <p>
                17.1.3. Los Servicios son: La subasta de inmuebles que fueron hipotecados, rematando
                a precios por debajo del mercado, en los sitios <a class="footer-link-terminos" href="/" target="_blank"> www.pujainmobiliaria.com.pe</a>.
            </p>

            <p>
                17.1.4. La prestación de los Servicios y estas Condiciones se rigen por las Leyes de la
                República del Perú. El solicitante se somete a la jurisdicción del Centro de Arbitraje de
                la Cámara de Comercio de Lima, con renuncia expresa a cualquier otro fuero y/o
                jurisdicción.
            </p>

            <p>
                17.1.5. El interés moratorio se determinará según la tasa mensual establecida por el BCR
                (Banco Central de Reserva del Perú), a través de su página
                web: <a class="footer-link-terminos" href="https://www.bcrp.gob.pe/" target="_blank"> http://www.bcrp.gob.pe/</a>

            </p>

            <p>
                Estas Condiciones Generales de Contratación fueron actualizadas por última vez el 17
                de diciembre de 2024.
            </p>

        </div>
    </div>
@endsection

@section('footer')
    <x-footer></x-footer>
@endsection