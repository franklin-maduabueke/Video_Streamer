<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
  
<!-- Mirrored from demo.pixinvent.com/robust-admin/ltr/vertical-content-menu-template/layout-1-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Feb 2017 19:34:04 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="XXX-Porn">
    <meta name="keywords" content="XXX-Porn">
    <meta name="author" content="XXX-Porn">
    <title><?php echo $this->config->item('app_name'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>static/robust-assets/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>static/robust-assets/css/vendors.min.css"/>
    <!-- BEGIN VENDOR CSS-->
    <!-- BEGIN Font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <!-- END Font icons-->
    <!-- BEGIN Plugins CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/sliders/slick/slick.css">
    <!-- END Plugins CSS-->
    
    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/ui/prism.min.css">
    <!-- END Vendor CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>static/robust-assets/css/app.min.css"/>
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/static/css/netflixcarousel.css">
    <!-- END Custom CSS-->
  </head>
  <body style="background-color:#000; margin:0px; padding:0px; width:100%; height:100%"   data-open="click" data-menu="vertical-content-menu" data-col="1-column" class="vertical-layout vertical-content-menu 1-column  fixed-navbar">
    
    <div id="watch-video-container">
        <!-- video player goes here from script -->
        <div id="video-player-embed" class="hidden">
            <?php
                if (isset($video))
                {
            ?>
            
                <?php 
                    $videoplayer = $video['embedjs'];
                    echo htmlspecialchars_decode($videoplayer);
                ?>
                
            <?php
                }
            ?>
        </div>

        <?php
            if (isset($adverts) && count($adverts) > 0)
            {
                $main_advert = $adverts[0];
                array_shift($adverts);
                $other_ads = $adverts;
        ?>
        <div id="products-adverts-container" class="hidden">
            <div class="row">
                <div class="col-md-9 advertLefttCol">
                    <div id="main-advert">
                        <button class="btn btn-lg btn-blue btn-darken-4 btn-darken-1 hidden" id="btnCloseAdvert" style="top:70px; position:relative; z-index:1000">
                            <i class="icon-cross"></i> <b>Close Ad</b>
                        </button>

                        <img src="<?php echo base_url() . "products/{$main_advert['image_name']}"; ?>" alt=""  />
                        <a href="<?php echo site_url() . '/video/place-order/'. $main_advert['product_number']; ?>" class="btn btn-block btn-deep-orange btn-accent-3 btn-darken-1" id="btnOrderItem" style="margin-top:-100px; position:relative; z-index:1000">
                            <i class="icon-cart3"></i> <b>Click To Order @ <?php echo '<strike>N</strike>' . number_format($main_advert['current_price']); ?></b>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-2 advertRightCol" style="margin-top:20px;">
                    <?php 
                    foreach($other_ads as $ads)
                    {?>
                    <div class="other-advert">
                        <img src="<?php echo base_url() . "products/{$ads['image_name']}"; ?>" alt=""  />
                        <a href="#" class="btn btn-block btn-deep-orange btn-accent-3 btn-darken-1" id="btnOrderItem" style="margin-top:-10px; position:relative; z-index:1000">
                            <i class="icon-cart3"></i> <b>N25000</b>
                        </a>
                    </div>
                    <?php
                    }?>
                </div>

                <div class="col-md-1"></div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

    <footer>
      
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/headroom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/prism.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/app.min.js"></script>
    <!-- END ROBUST JS-->
    <script type="text/javascript" src="<?php echo base_url();?>static/js/site.js"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>

<!-- Mirrored from demo.pixinvent.com/robust-admin/ltr/vertical-content-menu-template/layout-1-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Feb 2017 19:34:04 GMT -->
</html>