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
  <body style="margin:10px;" data-open="click" data-menu="vertical-content-menu" data-col="1-column" class="vertical-layout vertical-content-menu 1-column  fixed-navbar">
    
    <!-- navbar-fixed-top-->
    <div style="position:fixed; top:0px; left:0px; z-index:100; width:100%; height:70px; background-color:#0e0f11; opacity:0.7;" class="hidden" id="navbg"></div>

    <nav id="homepagenavbar" class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark" style="background-color: transparent; padding-bottom:15px;">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left">
              <button class="nav-link menu-toggle hamburger hamburger--arrow js-hamburger"><span class="hamburger-box"></span><span class="hamburger-inner"></span></button>
            </li>
            <li class="nav-item"><a href="<?php echo site_url(); ?>" class="navbar-brand nav-link"><img alt="DUDU-XXX" src="<?php echo base_url();?>static/duduxxxlogo.png" data-expand="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-light.png" data-collapse="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <!-- search bar -->
          </div>
        </div>
      </div>
    </nav>


    <?php
        if (count($product) == 0)
        {
            echo "This product does not exist in our database.";
        }
        else
        {
    ?>
        <div class="content-body" style="margin-top:80px;"><!-- Description -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Order</h4>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-8">
                                <div><?php echo validation_errors(); ?></div>
                                
                                <?php if (isset($proc_result))
                                    {?>
                                        <div style="color:#fefefe; background-color:#228EB6; padding:10px; border-radius:5px; font-weight:bold">
                                        <?php 
                                        if ($proc_result == TRUE)
                                            echo 'Your order has been recieved.';
                                        else
                                            echo 'Unable to process your order. Please try again!';
                                         ?>   
                                        </div>
                                   <?php
                                    }  ?>

                                <p>Please enter your name and phone number so we can respond to your request!</p>

                                <?php echo form_open('video/submit-product-order', array('id' => 'formPlaceProductOrder', 'name' => 'formPlaceProductOrder')); ?>
                                    <input type="hidden" id="txtProductNumber" name="txtProductNumber" value="<?php echo $product['product_number']; ?>" />
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-cart3"></i> <?php echo $product['product_name']; ?></h4>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="txtPersonFullname">Fullname</label>
                                            <div class="col-md-9">
                                                <input type="text" id="txtPersonFullname" class="form-control" placeholder="Your Name" name="txtPersonFullname" value="" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="txtPersonPhone">Phone N<u>o</u></label>
                                            <div class="col-md-9">
                                                <input type="text" id="txtPersonPhone" class="form-control" placeholder="Your Phone Number" name="txtPersonPhone" value="" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="txtOrderQuantity">Quantity</u></label>
                                            <div class="col-md-9">
                                                <input type="text" id="txtOrderQuantity" class="form-control" placeholder="Quantity" name="txtOrderQuantity" value="1" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions right">
                                        <button type="button" class="btn btn-teal" id="btnSubmitPlaceOrder">
                                            <i class="icon-cart2"></i> Place Order
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <div style="margin-bottom:80px;">
                                    <?php 
                                        if ($product['is_video_ad'] == 0)
                                        {
                                    ?>
                                    <img src="<?php echo base_url() . "products/{$product['image_name']}"; ?>" style="width:inherit; height:35%" />
                                    <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="productvideopanel" style="width:100%; height:auto; cursor:none;">
                                                <img src="http://vid.ly/<?php echo trim($product_video['vidly_url']); ?>/poster" alt="" class="image-responsive" style="height:100%; height:auto;"  />
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div style="color:#000;padding:10px;">
                                    <h3><?php echo $product['product_name'];?></h3>
                                    <h5>Price: <?php echo '<b><strike>N</strike>' . number_format($product['current_price']) . '</b>';?></h5>
                                    <p>
                                        <?php echo $product['description']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

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