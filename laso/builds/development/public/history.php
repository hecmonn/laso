<?php
$title="History";
require_once("../includes/header_login.php");
 ?>
<div class="history laso">
  <div class="history-holder laso-holder">
    <div class="history-content laso-content">
        <div class="history-header">
            <p>History</p><hr>
        </div>
        <div class="ages-selector">
            <ul>
                <li id="1847" class="active-age">1847</li>
                <li id="1936">1936</li>
                <li id="1962">1962</li>
                <li id="1965">1965</li>
                <li id="1980">1980</li>
                <li id="1982">1982</li>
                <li id="1988">1988</li>
                <li id="1997">1997</li>
                <li id="1998">1998</li>
                <li id="2000">2000</li>
                <li id="2005">2005</li>
                <li id="2006">2006</li>
                <li id="2010">2010</li>
                <li id="2011">2011</li>
                <li id="2012">2012</li>
                <li id="2013">2013</li>
                <li id="2014">2014</li>
                <li id="2015">2015</li>
            </ul>
        </div>
        <div class="history-info">
            <p>J.B. Ebrard Instala un cajón dedicado a la venta de ropa en el centro de la Ciudad de México.</p>
        </div>
    </div>
  </div>
</div>
<?php require_once("../includes/footer.php"); ?>
<script type="text/javascript">
    $(function(){
        $('.ages-selector li').click(function(){
            var age=parseInt($(this).attr('id'));

            $('.ages-selector li').removeClass('active-age');
            switch(age){
                case 1847:
                    var history="J.B. Ebrard Instala un cajón dedicado a la venta de ropa en el centro de la Ciudad de México.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1936:
                    var history="Se inaugura el nuevo edificio de Liverpool Centro en la avenida 20 de noviembre. Instalándose las primeras escaleras eléctricas de la Ciudad de México.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1962:
                    history="Se inaugura Liverpool Insurgentes, primera sucursal de El Puerto de Liverpool.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1965:
                    history="Liverpool empieza a cotizar en la Bolsa Mexicana de Valores.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1980:
                    history="Liverpool inaugura el Centro Comercial Perisur con su almacén, siendo este el primer Centro Comercial del Grupo Liverpool.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1982:
                    history="Se inaugura Liverpool Villahermosa en Tabasco, dentro del Centro Comercial Galerías Tabasco, primer almacén Liverpool en el interior de la Republica Mexicana.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1988:
                    history="Liverpool adquiere los almacenes departamentales Fábricas de Francia.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1997:
                    history="Liverpool realiza la adquisición de Comercial Las Galas.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 1998:
                    history="Liverpool realiza la adquisición de Tiendas Departamentales Salinas y Rocha.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2000:
                    history="Liverpool implementa el sistema integral SAP.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2005:
                    history="Liverpool inaugura el Centro de Distribución automatizado de Huehuetoca, convirtiéndose en el más grande en Latinoamérica. Siguiendo con este proceso de modernización, el centro de distribución Tultitlán fue automatizado.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2006:
                    history="Liverpool modificó su denominación social a la de sociedad anónima bursátil de capital variable (S.A.B. de C.V.), para dar cumplimiento a lo señalado por la Ley de Mercado de Valores.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2010:
                    history="Liverpool realiza la adquisición del 50% de Regal Forest (cadena centroamericana de electrodomésticos y muebles, con presencia en 18 países).";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2011:
                    history="Se inauguran los almacenes de Liverpool en La Paz, BCS, Tlaquepaque, Jal., San Luis Potosí, SLP, Interlomas, Estado de México y un Duty Free en Playa del Carmen, QR. <br> Se lanza a nivel nacional la tarjeta LPC y se introduce la tarjeta Galerías Fashion Card.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2012:
                    history="Se inauguran 9 almacenes: Villahermosa, Guadalajara, San Juan del Río, Veracruz, Playa del Carmen, León, Ciudad Jardín en el Estado de México, Campeche y el Istmo en el estado de Oaxaca, alcanzando un total de 99 en 56 ciudades de la República. <br><br> Tres centros comerciales se sumaron al portafolio: Galerías Acapulco, Zacatecas y Celaya, para terminar el año con 19 unidades.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2013:
                    history="Se inauguran 4 almacenes Liverpool: Cd. del Carmen, Campeche; Mazatlán, Sinaloa; Tuxpan, Veracruz y Mexicali, Baja California Norte. Adicionalmente se inauguraron dos centros comerciales: Galerías Campeche y Galerías Mazatlán Marina; y se adquirió la participación minoritaria en un tercero: San Juan del Río, Qro. <br>La Compañía alcanzó los 3.5 millones de tarjetas de crédito emitidas.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2014:
                    history="Se inauguran 3 almacenes Liverpool: Querétaro Antea, Puebla y Toluca. Asimismo se retomó el formato Fábricas de Francia. Adicionalmente se inauguraron dos centros comerciales: Galerías Serdán y Galerías Toluca. <br><br> Inauguramos el Almacén 100 de la cadena.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;
                case 2015:
                    history="Se inauguran 2 almacenes Liverpool: Coacalco y Tlalnepantla además de 5 Fábricas de Francia: Cuautla, Chimalhuacán, Zumpango, Texcoco y Salamanca. <br><br> Adicionalmente llegaron las boutiques Pottery Barn, West Elm y Williams Sonoma.";
                    $(this).addClass('active-age');
                    $('.history-info p').html(history);
                    break;

                default:
                    history="";
            }

        });
    });
</script>
