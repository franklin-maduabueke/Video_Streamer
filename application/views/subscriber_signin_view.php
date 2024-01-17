<?php $active_page = 'sign_in_view'; ?>
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
  
<!-- Mirrored from demo.pixinvent.com/robust-admin/ltr/vertical-content-menu-template/layout-1-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Feb 2017 19:34:04 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="DUDU-XXX">
    <meta name="keywords" content="DUDU-XXX">
    <meta name="author" content="DUDU-XXX">
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
  <body style="background-color:#141619; padding-top:0px; overflow-x:hidden; overflow-y:scroll;" id="homebody" 
    data-open="click" data-menu="vertical-content-menu" data-col="1-column" class="vertical-layout vertical-content-menu 1-column  fixed-navbar">
    
    <!-- navbar-fixed-top-->
    <?php $this->load->view('shared/navbar.php'); ?>

    <div style="background-image:url(http://localhost/xxxstreamweb/static/dudubanner.png); background-repeat:no-repeat; padding-top:10%;">
    <!-- main menu-->
    <div class="main-menu menu-light menu-border menu-shadow menu-accordion" id="mobile-view-side-bar">
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="navigation-header" style="background-color:#141619; font-weight:bold; color:#efefef;"><span data-i18n="nav.category.layouts">Categories</span><i data-toggle="tooltip" data-placement="right" data-original-title="Layouts" class="icon-ellipsis icon-ellipsis"></i>
          </li>
          <?php
          if (isset($video_category))
          {
            foreach ($video_category as $vcat)
            {
          ?>
          <li><a href="<?php echo site_url() . '/video/search/' . $vcat['appid']; ?>" class="menu-item"><?php echo $vcat['title'];?></a></li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
      <!-- /main menu content-->
    </div>
    <!-- / main menu-->
    
    <!-- main menu-->
    <div class="main-menu menu-light menu-border menu-shadow menu-accordion" id="mobile-view-side-bar">
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="navigation-header" style="background-color:#141619; font-weight:bold; color:#efefef;"><span data-i18n="nav.category.layouts">Categories</span><i data-toggle="tooltip" data-placement="right" data-original-title="Layouts" class="icon-ellipsis icon-ellipsis"></i>
          </li>
          <?php
          if (isset($video_category))
          {
            foreach ($video_category as $vcat)
            {
          ?>
          <li><a href="<?php echo site_url() . '/video/search/' . $vcat['appid']; ?>" class="menu-item"><?php echo $vcat['title'];?></a></li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
      <!-- /main menu content-->
    </div>
    <!-- / main menu-->

    <div style="height:20%;"></div>
    <div class="robust-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-md-5 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0"  style="background-color:#efefef;">
                            <div class="card-header no-border hidden">
                                <div class="card-title text-xs-center">
                                    <div class="p-1">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 hidden"><span>Login to Account</span></p>
                                <h1 style="padding:20px 0px 10px 20px;">Sign In</h1>
                                <div class="card-block pt-0" style="padding:20px;">
                                    <?php 
                                        if (isset($proc_result) && $proc_result == 1)
                                        {
                                    ?>
                                    <div class="bg-danger" style="font-size:14px; color:#c00; border-radius:5px; padding:10px; margin-bottom:10px;">
                                        <i style="color:#eee"> Email or Password is incorrect!</i>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div style="margin-top:30px;"></div>
                                    <form class="form-horizontal" method="post" action="<?php echo site_url() . '/subscriber/proc-signin'; ?>" id="formSignIn">
                                        <input type="hidden" value="<?php echo $redirect_url; ?>" name="RedirectUrl" />
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="username">Email</label>
                                            <input type="text" autocomplete="off" style="height:50px;" class="form-control teal-lighten-2" id="username" name="Email" placeholder="Your Email">
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label for="userpassword">Password</label>
                                            <input type="password" style="height:50px;" class="form-control teal-lighten-2" id="userpassword" name="Password" placeholder="Enter Password">
                                        </fieldset>
                                        <fieldset class="form-group row">
                                            <div class="col-md-6 col-xs-12 text-xs-center">
                                                <fieldset>
                                                    <input type="checkbox" id="RememberMe" class="chk-remember" name="RememberMe">
                                                    <label for="RememberMe"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-xs-12 float-sm-left text-xs-center">
                                                <a asp-controller="register" asp-action="passwordrecovery" class="card-link pink">Forgot Password?</a>
                                            </div>
                                        </fieldset>
                                        <button type="button" style="height:50px; background-color:#cc135c; color:white; font-weight:bold;" id="btnLogin" class="btn btn-block"><i class="icon-check"></i> Sign In</button>
                                    </form>
                                </div>
                                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1 pink"><span style="background-color:#efefef;">Click below to Sign Up!</span></p>
                                <div class="card-block">
                                    <a href="<?php echo site_url() . "/subscriber/register"; ?>" style="height:50px; background-color:#cc135c; color:white; font-weight:bold;" class="btn bg-pink btn-outline-lighten-2 btn-block"><i class="icon-key3"></i> Sign Up!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    </div>

    <?php echo $footer ?>

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