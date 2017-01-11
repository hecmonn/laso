<?php require_once("../includes/header_login.php"); ?>
<div class="main-content index">
    <div class="carousel-banner-cont carousel">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="../assets/liverpool-store-1.jpg" style="object-fit: cover" alt="lp-store-1" width="900px" height="500px" class="img-car center-block">
            </div>
            <div class="item">
                <img src="../assets/liverpool-store-4.jpg" alt="lp-store-2" width="900px" height="500px" class="img-car center-block">
            </div>
            <div class="item">
                <img src="../assets/liverpool-store-5.jpg" alt="lp-store-3" width="900px" height="500px" class="img-car center-block">
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
             </a>
             <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
             </a>
          </div>
    </div>
 </div>

<?php require_once("../includes/footer.php"); ?>
