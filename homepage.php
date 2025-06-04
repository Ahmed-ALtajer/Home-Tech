<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <title>Store Website</title>
    <style>
    </style>
    <?php
    require_once('includes/dbConn.inc.php');
    require_once('includes/functions.inc.php');
    ?>
</head>
<body>
        <?php 
        include "header.php";
        ?>       
    <br />
    <section class="sec">
    <div class="slideshow-container">
        <div class="slides">

            <div class="slide">
                <img src="/project/images/slider2fixed.png" alt="First Image">
            </div>

            <div class="slide">
                <img src="/project/images/slider3w.jpg" alt="Second Image">
            </div>
            <div class="slide">
                <img src="/project/images/newslidepng.png" alt="thrid Image">
            </div>
        </div>
    </div>
    <br />
    <section>
        <div class="swiper-wrapper">
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href="/project/productlist.php"><img src="/project/images/tev.png" alt="Television" title="Television" width="100%" style="border:solid" /></a>
                <span><center class="sp">Television</center></span>
            </div>
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href=""><img src="/project/images/oven.png" alt="Cookers" title="Cookers" width="100%" style="border:solid" /></a>
                <span><center class="sp">Cookers</center></span>
            </div>
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href=""><img src="/project/images/dry.png" alt="Dryers" title="Dryers" width="100%" style="border:solid" /></a>
                <span><center class="sp">Dryers</center></span>
            </div>
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href=""><img src="/project/images/fridgeim.png" alt="Refrigerators" title="Refrigerators" width="100%" style="border:solid" /></a>
                <span><center class="sp">Refrigerators</center></span>
            </div>
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href=""><img src="/project/images/wm.png" alt="Washing Machines" title="Washing Machines" width="100%" style="border:solid" /></a>
                <span><center class="sp">Washing Machines</center></span>
            </div>
            <div class="swiper-backface-hidden" style="width: 246px; margin-right: auto;">
                <a href=""><img src="/project/images/jc.png" alt="Coffee Makers & Kettles" title="Coffee Makers & Kettles" width="100%" style="border:solid" /></a>
                <span><center class="sp">Coffee Makers & Kettles & air fryers</center></span>
            </div>
        </div>
    </section>
    <br />
    <section>
        <div class="slideshow-container2">
            <div class="slides2">

                <div class="slide2"><img src="/project/images/craft.jpeg" alt="craft"></div>
                <div class="slide2"><img src="/project/images/generalsuperme.jpeg" alt="generlsuperme"></div>
                <div class="slide2"><img src="/project/images/glemgas.jpeg" alt="glemgas"></div>
                <div class="slide2"><img src="/project/images/gree.jpeg" alt="gree"></div>
                <div class="slide2"><img src="/project/images/Hitachi.jpeg" alt="hitachi"></div>
                <div class="slide2"><img src="/project/images/LG.jpeg" alt="LG"></div>
                <div class="slide"><img src="/project/images/panasonic.jpeg" alt="panasonic"></div>
                <div class="slide"><img src="/project/images/philips.jpeg" alt="philips"></div>
                <div class="slide"><img src="/project/images/samsung.jpeg" alt="samsung"></div>
                <div class="slide"><img src="/project/images/TCL.jpeg" alt="tcl"></div>
                <div class="slide"><img src="/project/images/zamil.jpeg" alt="zamil"></div>

            </div>
        </div>
    </section class="bc">
    <br />
    <p class="pp">Selling Out Fast</p>
    <div class="product-container">          
    <?php
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    retrieveProducts($conn, $search = '');
    ?>
    </div>


    </section>
    
    <footer>
        <?php 
        include "footer.php";
        ?>
    </footer>
</body>
</html>
