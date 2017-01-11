<?php
$title="About";
require_once("../includes/header_login.php");
?>
<div class="main-content presence">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1 map-holder">
                <div class="map-header">
                    <h3>Geographical presence</h3><hr>
                    <ul>
                        <li class="active-map"><a m="map-liv" class="map-selector">LIVERPOOL</a></li>
                        <li><a m="map-ff"  class="map-selector">FÁBRICAS DE FRANCIA</a></li>
                        <li><a m="map-df" class="map-selector">DUTY FREE</a></li>
                    </ul>
                </div>
                <div class="map-content">
                    <div id="map-liv" class="map-div" style="display:block">
                        <img src="../assets/map-liverpool.png" alt="" class="map" />
                    </div>
                    <div id="map-ff" class="map-div">
                        <img src="../assets/map-fabricas.png" alt="" class="map"/>
                    </div>
                    <div id="map-df" class="map-div">
                        <img src="../assets/map-duty.png" alt="" class="map" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("../includes/footer.php"); ?>
<script type="text/javascript">
    $(function(){
        $('.map-selector').click(function(){
            $('.map-selector').parent().removeClass('active-map');
            $(this).parent().addClass('active-map');
            var toActive=$(this).attr('m');
            console.log(toActive);
            $('.map-div').hide();
            if(toActive=="map-liv"){
                $('#map-liv').show();
            } else if(toActive=="map-ff"){
                $('#map-ff').show();
            } else if(toActive=="map-df"){
                $('#map-df').show();
            }

        });
    });
</script>
