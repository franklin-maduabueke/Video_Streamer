
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/static/css/netflixcarousel.css">

    <style>
        @media all and (max-width:768px) and (orientation: landscape)
        {
            nav.vp-pagenavbar, div.vp-navbg, div.vp-content-header,  div.vp-card-header, div.productpanel, div#desktop-related-videos-view
            {
                display: none;
            }
        }
    </style>
  </head>
  <body style="background-color:#141619; padding-top:0px;" data-open="click" data-menu="vertical-content-menu" data-col="1-column" class="vertical-layout vertical-content-menu 1-column  fixed-navbar">

    <!-- navbar-fixed-top-->
    <div style="position:fixed; top:0px; left:0px; z-index:100; width:100%; height:70px; background-color:#141619; opacity:0.7;" class="hidden vp-navbg" id="navbg"></div>
    
    <nav id="homepagenavbar" class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark vp-pagenavbar" style="background-color: transparent; padding:0px 30px 15px 30px;">
        <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                <button class="nav-link menu-toggle hamburger hamburger--arrow js-hamburger"><span class="hamburger-box"></span><span class="hamburger-inner"></span></button>
            </li>
            <li class="nav-item"><a href="<?php echo site_url();?>" class="navbar-brand nav-link"><img alt="DUDU-XXX" src="<?php echo base_url();?>static/duduxxxlogo.png" data-expand="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-light.png" data-collapse="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right" style="display:none;"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>

        <div class="navbar-container content container-fluid" style="width:80%; margin-left:200px;">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
                <li class="dropdown nav-item mega-dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link" style="font-size:16px; font-weight:bold; color:#cc135c; text-shadow:1px 1px black; font-family:Helvetica, Verdana;">Browse</a>
                <ul class="mega-dropdown-menu dropdown-menu row"  style="opacity:0.9; border:none; border-top:2px solid white;">
                    <li class="col-md-2">
                    <ul class="drilldown-menu">
                        <li class="menu-list">
                        <ul>
                            <li><a href="<?php echo site_url();?>" class="dropdown-item" style="color:white;">Home</a></li>
                        </ul>
                        </li>
                    </ul>
                    </li>

                    <li class="col-md-10" style="border-left:1px solid grey;">
                    <ul class="drilldown-menu">
                        <li class="menu-list">
                        <ul>
                        <?php
                        foreach ($video_category as $category)
                        {
                        ?>
                            <li class="mydropdownlinks" style="float:left; margin-right:10px; overflow:hidden; max-width:130px; width:130px;"><a href="<?php echo site_url() . '/video/search/' . $category['appid'];?>" class="dropdown-item" style="color:white; font-weight:normal;"><?php echo $category['title']; ?></a></li>
                        <?php
                        }
                        ?>
                        </ul>
                        </li>
                    </ul>
                    </li>

                </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav float-xs-right">
              <?php
                if (isset($this->session->display_name)  && ! isset($hide_right_links)) 
                {
              ?>
              <li class="dropdown dropdown-language nav-item" style="font-size:16px;">
                <a href="<?php echo site_url() . '/video/search'; ?>" class="nav-link" style="color:white; text-shadow:1px 1px black;"><i class="icon-search"></i> Search</a>
              </li>

              <li class="dropdown dropdown-user nav-item">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="<?php echo base_url();?>static/avatar.png" alt="avatar"><i></i></span><span class="user-name" style="font-size:12px; font-weight:bold;"><?php echo ucwords($this->session->display_name); ?></span></a>
                <div class="dropdown-menu dropdown-menu-right" style="background-color:black; border:none; border-radius:0px; border-top:2px solid white;">
                  <a href="#" class="dropdown-item white" style="font-weight:bold; font-size:12px;">Account</a>
                  <a href="#" class="dropdown-item white" style="font-weight:bold; font-size:12px;">Help Center</a>
                  <div class="dropdown-divider" style="background-color:white;"></div>
                  <a href="<?php echo site_url() . '/subscriber/logout' ?>" class="dropdown-item white" style="font-weight:bold; font-size:12px;">Sign out</a>
                </div>
              </li>
              <?php
                }
              ?>

              <li class="dropdown dropdown-language nav-item hidden"><a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                <div aria-labelledby="dropdown-flag" class="dropdown-menu"><a href="#" class="dropdown-item"><i class="flag-icon flag-icon-us"></i> English</a><a href="#" class="dropdown-item"><i class="flag-icon flag-icon-es"></i> Spanish</a><a href="#" class="dropdown-item"><i class="flag-icon flag-icon-pt"></i> Portuguese</a><a href="#" class="dropdown-item"><i class="flag-icon flag-icon-fr"></i> French</a></div>
              </li>
              <li class="dropdown dropdown-notification nav-item hidden"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">5 New</span></h6>
                  </li>
                  <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-cart3 icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">You have new order!</h6>
                          <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">30 minutes ago</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-monitor3 icon-bg-circle bg-red bg-darken-1"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading red darken-1">99% Server load</h6>
                          <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Five hour ago</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-server2 icon-bg-circle bg-yellow bg-darken-3"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                          <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-check2 icon-bg-circle bg-green bg-accent-3"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Complete the task</h6><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last week</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-bar-graph-2 icon-bg-circle bg-teal"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Generate monthly report</h6><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all notifications</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-notification nav-item hidden"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-mail6"></i><span class="tag tag-pill tag-default tag-info tag-default tag-up">8</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span><span class="notification-tag tag tag-default tag-info float-xs-right m-0">4 New</span></h6>
                  </li>
                  <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="robust-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Margaret Govan</h6>
                          <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start the project.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="robust-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Bret Lezama</h6>
                          <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Tuesday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="robust-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Carie Berra</h6>
                          <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Friday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="robust-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Eric Alsobrook</h6>
                          <p class="notification-text font-small-3 text-muted">We have project party this saturday night.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all messages</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-user nav-item hidden"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="robust-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name">John Doe</span></a>
                <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a><a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a><a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a><a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a>
                  <div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                </div>
              </li>
            </ul>

            </div>
        </div>
        </div>
    </nav>

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

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="robust-content content container-fluid vp-content-fluid" style="padding:0px; margin:0px;">
      <div class="content-wrapper vp-content-wrapper" style="padding:0px; margin:0px;">
        <div class="content-header row vp-content-header" style="padding:15px; color:#efefef; font-weight:bold; font-family:Helvetica, Verdana; font-size:15px;">
        </div>
        
        <div class="content-body vp-content-body"><!-- Description -->
            <section id="description" class="card vp-mainvideoarea" style="background-color:#141619;">
                <div class="card-header vp-card-header">
                    <h4 class="card-title" style="color:#efefef"><?php echo $video['title']; ?></h4>
                </div>

                <div class="card-body collapse in">
                    <div class="card-block vp-cardblock">
                        <div class="row">
                            <div class="col-md-8 vp-col-md-8">
                                <div id="alt-watch-video-container">
                                    <!-- video player goes here from script -->
                                    <div id="video-player-embed">
                                        <?php
                                            //advert 1
                                            if (isset($adverts) && count($adverts) > 0)
                                            {
                                                $videoplayer = $adverts[0]['product_video']['embedjs'];
                                                echo htmlspecialchars_decode($videoplayer);
                                                ?>
                                                <input type="hidden" id="orderproductAds1ProductNumber" value="<?php echo $adverts[0]['product_details']['product_number']; ?>" />
                                                <input type="hidden" id="orderproductAds1ProductName" value="<?php echo $adverts[0]['product_details']['product_name']; ?>" />
                                                <input type="hidden" id="orderproductAds1CurrentPrice" value="<?php echo number_format($adverts[0]['product_details']['current_price'], 2); ?>" />
                                                <?php
                                            }
                                        ?>

                                        <?php
                                            //main video
                                            if (isset($video))
                                            {
                                                $videoplayer = $video['embedjs'];
                                                echo htmlspecialchars_decode($videoplayer);
                                            }
                                        ?>

                                        <?php
                                            //advert 2
                                            if (isset($adverts) && count($adverts) > 1)
                                            {
                                                $videoplayer = $adverts[1]['product_video']['embedjs'];
                                                echo htmlspecialchars_decode($videoplayer);
                                                ?>
                                                <input type="hidden" id="orderproductAds2ProductNumber" value="<?php echo $adverts[1]['product_details']['product_number']; ?>" />
                                                <input type="hidden" id="orderproductAds2ProductName" value="<?php echo $adverts[1]['product_details']['product_name']; ?>" />
                                                <input type="hidden" id="orderproductAds2CurrentPrice" value="<?php echo number_format($adverts[1]['product_details']['current_price'], 2); ?>" />
                                                <?php
                                            }
                                            else if (isset($adverts) && count($adverts) > 0)
                                            {
                                                //repeat advert 1
                                                $videoplayer = $adverts[0]['product_video']['embedjs'];
                                                echo htmlspecialchars_decode($videoplayer);
                                                ?>
                                                <input type="hidden" id="orderproductAds2ProductNumber" value="<?php echo $adverts[0]['product_details']['product_number']; ?>" />
                                                <input type="hidden" id="orderproductAds2ProductName" value="<?php echo $adverts[0]['product_details']['product_name']; ?>" />
                                                <input type="hidden" id="orderproductAds2CurrentPrice" value="<?php echo number_format($adverts[0]['product_details']['current_price'], 2); ?>" />
                                                <?php
                                            }
                                        ?>
                                    </div>

                                    <div class="order-ads-product-now">
                                        <div id="sponsored-ads-overlay" class="hidden">sponsored advert</div>
                                        <div class="order-product-now-overlay">
                                            <div id="order-product">ORDER NOW</div>
                                        </div>

                                        <div style="clear:both;"></div>

                                        <div class="order-product-now-overlay">
                                            <div id="advert-countdown" style="text-align:center; font-size:10px; font-weight:bold;">800s</div>
                                        </div>

                                        <div style="clear:both;"></div>
                                    </div>

                                    <div class="mobile-view-menus-overlay hidden">
                                        <a href="<?php echo site_url(); ?>" style="color:white; border:none;"><div id="homepage-btn-overlay"><i class="icon-android-home"></i></div></a>
                                        <a href="<?php echo site_url() . '/video/search'; ?>" style="color:white; border:none;"><div id="searchpage-btn-overlay"><i class="icon-search"></i></div></a>
                                    </div>
                                </div>

                                <?php
                                    if (count($adverts) > 0)
                                    {
                                        //get one image ad
                                        $first_ad = $adverts[0];
                                ?>
                                <div id="vp-mobile-advert-area">
                                    <!-- mobile image advert -->
                                    <div id="vp-mini-ad-thumbnail">
                                        <?php
                                            $productImagePath = $this->config->item('ads_products_banner_path') . $first_ad['product_details']['image_name'];
                                            
                                            if ( ! empty($first_ad['product_details']['image_name']) && file_exists($productImagePath))
                                            {
                                        ?>
                                            <img src="<?php echo base_url() . substr($productImagePath, 2);?>" alt="" class="image-responsive" style="height:100%; height:auto;"  />
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    
                                    <div id="vp-mini-ad-details">
                                       <a href="#" style="color:#efefef; font-size:13px; font-weight:bold;"><?php echo $first_ad['product_details']['product_name']; ?></a>
                                       <br/>
                                       <span style="font-size:11px; font-weight:bold; color:#efefef;">Price: N<?php echo number_format($first_ad['product_details']['current_price'], 2); ?></span>
                                       <br/>
                                       <span style="font-size:10px; color:#efefef;"><?php echo $first_ad['product_details']['description']; ?></span>
                                    </div>
                                    
                                    <div id="vp-mini-ad-actionbtn" data-toggle="modal" data-target="#bounce">
                                        <i class="icon-cart3" style="color:white;"></i> <label>ORDER</label>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>

                                <!-- Modal -->
                                <div class="modal animated bounce text-xs-left" id="bounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel36" aria-hidden="true" id="order-form-modal-widget">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel36">Place Order Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                <span style="font-size:15px; font-weight:bold; color:#141619;" id="ordered-item-product-name"><?php echo $first_ad['product_details']['product_name']; ?></span>
                                                <br/>
                                                <span class="success darken-2" style="font-size:15px; font-weight:bold; color:#141619;" id="ordered-item-price">Price: N<?php echo number_format($first_ad['product_details']['current_price'], 2); ?></span>
                                                </p>
                                                <input type="hidden" id="txtProductNumber" value="<?php echo $first_ad['product_details']['product_number']; ?>" />
                                                
                                                <div id="orderPostProcessing" class="hidden" style="text-align:center;">
                                                    <span id="processMessage" style="font-weight:bold; font-size:20px; color:#cc135c"></span>
                                                    <br/>
                                                    <i id="iconCompleteStatus" class="icon-circle-check success hidden" style="font-size:80px;"></i>
                                                    <i id="iconErrorStatus" class="icon-circle-cross danger hidden" style="font-size:80px;"></i>
                                                </div>

                                                <div id="orderFormControlsContainer">
                                                    <label>Fullname: </label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" placeholder="Your Fullname" class="form-control" id="txtPersonFullname">
                                                        <div class="form-control-position">
                                                            <i class="icon-person text-muted"></i>
                                                        </div>
                                                    </div>

                                                    <label>Quantity: </label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" placeholder="Quantity" class="form-control" value="1" id="txtOrderQuantity">
                                                        <div class="form-control-position">
                                                            <i class="icon-bag text-muted"></i>
                                                        </div>
                                                    </div>

                                                    <label>Phone Number: </label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" placeholder="Your Phone Number" class="form-control" id="txtPersonPhone">
                                                        <div class="form-control-position">
                                                            <i class="icon-phone text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btnClosePlaceorderForm" class="btn btn-grey btn-lighten-1" data-dismiss="modal">Close</button>
                                                <button type="button" id="btnPlaceorderAjaxSubmit" class="btn" style="background-color:#cc135c; color:#efefef;">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>

                            <div class="col-md-4">
                                <div style="width:100%; background-color:white;" class="dropdown-form-order-product">
                                    <div>
                                        <p>
                                        <span style="font-size:15px; font-weight:bold; color:#141619;" id="productDropName"><?php echo $first_ad['product_details']['product_name']; ?></span>
                                        <br/>
                                        <span class="success darken-2" style="font-size:15px; font-weight:bold; color:#141619;" id="productDropPrice">Price: N<?php echo number_format($first_ad['product_details']['current_price'], 2); ?></span>
                                        </p>
                                        <input type="hidden" id="txtDropProductNumber" />
                                        
                                        <div id="orderDropPostProcessing" class="hidden" style="text-align:center;">
                                            <span id="processDropMessage" style="font-weight:bold; font-size:20px; color:#cc135c"></span>
                                            <br/>
                                            <i id="iconDropCompleteStatus" class="icon-circle-check success hidden" style="font-size:80px;"></i>
                                            <i id="iconDropErrorStatus" class="icon-circle-cross danger hidden" style="font-size:80px;"></i>
                                        </div>

                                        <div id="orderFormDropControlsContainer">
                                            <label>Fullname: </label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" placeholder="Your Fullname" class="form-control" id="txtDropPersonFullname">
                                                <div class="form-control-position">
                                                    <i class="icon-person text-muted"></i>
                                                </div>
                                            </div>

                                            <label>Quantity: </label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" placeholder="Quantity" class="form-control" value="1" id="txtDropOrderQuantity">
                                                <div class="form-control-position">
                                                    <i class="icon-bag text-muted"></i>
                                                </div>
                                            </div>

                                            <label>Phone Number: </label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" placeholder="Your Phone Number" class="form-control" id="txtDropPersonPhone">
                                                <div class="form-control-position">
                                                    <i class="icon-phone text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" id="btnDropClosePlaceorderForm" class="btn btn-grey btn-lighten-1" data-dismiss="modal">Close</button>
                                            <button type="button" id="btnDropPlaceorderAjaxSubmit" class="btn" style="background-color:#cc135c; color:#efefef;">Place Order</button>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    foreach ($adverts as $video_ad)
                                    {
                                ?>
                                <div class="productpanel row">
                                    <div class="col-sm-6 col-md-7 productvideopanel">
                                        <img src="http://vid.ly/<?php echo trim($video_ad['product_video']['vidly_url']); ?>/poster" alt="" class="image-responsive" style="width:100%; height:auto;"  />
                                    </div>

                                    <div class="col-sm-6 col-md-5 productdetailspanel">
                                        <div class="text-content">
                                            <?php echo $video_ad['product_details']['product_name'] ?>
                                        </div>
                                        <div class="text-content">
                                            <?php echo 'N'. number_format($video_ad['product_details']['current_price']); ?>
                                        </div>

                                        <input type="hidden" id="watch-link" value="<?php echo site_url() . "/video/watch/{$video_ad['product_video']['appid']}"; ?>" />
                                        
                                        <input type="hidden" id="productNumber" value="<?php echo $video_ad['product_details']['product_number'];?>" />
                                        <input type="hidden" id="productName" value="<?php echo $video_ad['product_details']['product_name'];?>" />
                                        <input type="hidden" id="productCurrentPrice" value="<?php echo number_format($video_ad['product_details']['current_price'], 2);?>" />

                                        <button class="btn mr-1 btnProductOrderFormLaunch" 
                                            style="font-weight:bold; background-color:#cc135c; color:white;">
                                            <i class="icon-cart2"></i> Order Now!
                                        </button>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div style="height:auto; padding:0px; margin:0px;">
                <div style="padding:0px;">
                    <div id="mobile-related-videos-title">
                        <span>Related Videos</span>
                        <i class="change-view icon-android-list"></i>

                        <div style="clear:both;"></div>
                    </div>
                    <div id="mobile-related-videos-view">
                        <?php
                        for ($vcount = 0; $vcount < count($related_videos); $vcount++)
                        {
                        ?>
                        <div class="mobile-related-video-item">
                            <a href="<?php echo site_url() . "/video/watch/{$related_videos[$vcount]['appid']}"; ?>" style="color:transparent; text-decoration:none;">
                            <div class="mvr-thumbnail">
                                <?php
                                    if (strlen(trim($related_videos[$vcount]['cover_image'])) > 0)
                                    {
                                    ?>
                                    <img class="tile__img" src="<?php echo base_url() . 'media_source/video_cover/' . $related_videos[$vcount]['cover_image']; ?>" alt=""  />
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                <img class="tile__img image-fluid" src="http://vid.ly/<?php echo trim($related_videos[$vcount]['vidly_url']); ?>/poster" alt=""  />
                                <?php
                                    }
                                ?>
                            </div>
                            </a>

                            <div class="mvr-details">
                                <div style="color:white; font-size:15px; font-weight:bold; margin-bottom:5px;"><a href="<?php echo site_url() . "/video/watch/{$related_videos[$vcount]['appid']}"; ?>" style="color:white; text-decoration:none;"><?php echo trim($related_videos[$vcount]['title']); ?></a></div>
                                <div style="color:white; font-size:13px;"><?php echo trim($related_videos[$vcount]['description']); ?></div>
                            </div>

                            <div style="clear:both"></div>
                        </div>
                        <?php
                        }
                        ?>

                        <div style="clear:both"></div>

                        <?php echo $footer ?>;
                    </div>

                    <div id="desktop-related-videos-view">
                        <div style="color:grey; padding-left:50px; font-weight:bold;">Related Videos</div>
                        <?php
                        
                            $counter = 0;
                            for ($vcount = 0; $vcount < count($related_videos);)
                            {
                                ++$counter;
                        ?>
                            <div class="card" style="border:none; box-shadow: none; margin:0px; background-color:transparent; padding-left:33px;">
                                <div class="card-body collapse in" style="padding-top:0px; height:auto; margin-left: 0px; padding-left: 0px;">
                                    <div class="card-block" style="padding-top:0px;">
                                        <div id="netflixcarouselContainer">
                                        <!-- start caurosel -->
                                        <div class="contain">
                                            <div class="row">
                                            
                                            <button class="btn btn-lg btn-teal hidden carouselLCtrl"><i class="icon-ei-chevron-left"></i></button>
                                            <button class="btn btn-lg btn-teal hidden carouselRCtrl"><i class="icon-ei-chevron-right"></i></button>

                                            <div class="row__inner">
                                            <?php
                                                while(($counter % 6) != 0 && $vcount < count($related_videos))
                                                {
                                                    ++$counter;
                                            ?>
                                                <div class="tile">
                                                    <input type="hidden" value="<?php echo trim($related_videos[$vcount]['actors']); ?>" class="video-actors" />
                                                    <input type="hidden" value="<?php echo trim($related_videos[$vcount]['directors']); ?>" class="video-directors" />
                                                    <input type="hidden" value="<?php echo trim($related_videos[$vcount]['creators']); ?>" class="video-creators" />
                                                    <input type="hidden" 
                                                        value="<?php 
                                                                        foreach ($video_category as $category) {
                                                                            if (strcasecmp($category['appid'], $related_videos[$vcount]['category']) == 0)
                                                                            {
                                                                                echo $category['title'];
                                                                                break;
                                                                            }
                                                                        }
                                                                    ?>" 
                                                            class="video-genres" />

                                                    <div class="tile__media">
                                                        <!-- add cover image -->
                                                        <?php
                                                            if (strlen($related_videos[$vcount]['cover_image']) > 2)
                                                            {
                                                        ?>
                                                        <img class="tile__img" src="<?php echo base_url() . 'media_source/video_cover/' . $related_videos[$vcount]['cover_image']; ?>" alt=""  />
                                                        <?php
                                                            }
                                                        ?>
                                                        <img class="tile__img" <?php if (strlen($related_videos[$vcount]['cover_image'] > 2)) echo 'style="opacity:0;"';?> src="http://vid.ly/<?php echo trim($related_videos[$vcount]['vidly_url']); ?>/poster" alt=""  />
                                                        <img class="tile__img" style="opacity:0;" src="http://vid.ly/<?php echo trim($related_videos[$vcount]['vidly_url']); ?>/poster2" alt=""  />
                                                        <img class="tile__img" style="opacity:0;" src="http://vid.ly/<?php echo trim($related_videos[$vcount]['vidly_url']); ?>/poster3" alt=""  />
                                                    </div>

                                                    <div class="tile__details">
                                                        <div class="tile__title">
                                                        <a href="<?php echo site_url() . "/video/watch/{$related_videos[$vcount]['appid']}"; ?>" style="font-weight:bold;"><?php echo trim($related_videos[$vcount]['title']); ?></a>
                                                        
                                                        <div class="title_description"><?php echo wordwrap(trim($related_videos[$vcount]['description']), 65, '<br/>'); ?></div>
                                                        </div>
                                                        
                                                        <div class="title_details_panel_show_arrow"><i class="icon-chevron-down"></i></div>
                                                    </div>

                                                    <div class="tilepointertodetails hidden"><i class="icon-arrow-down-b"></i></div>
                                                </div>

                                            <?php
                                                    $vcount++;
                                                }
                                            ?>
                                            </div>
                                            </div>

                                        </div>
                                        <!-- end caurosel -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="title_full_details_container">
                                <div class="gradient-overlay">
                                <div style="clear:both"></div>
                        
                                <div class="full_details_left_col">
                                    <div class="fd_movie_title_name" style="width:auto;"><a href="#"></a></div>
                                    
                                    <div class="fd_movie_description"></div>
                                    
                                    <div class="fd_movie_starring">
                                    Starring: <span class="vid-actors">Genevieve Nnaji, Oris Erhuero, Majid Michel</span><br/>
                                    Director: <span class="vid-directors">Ishaya Bako</span><br/>
                                    Creator: <span class="vid-creators">Genevieve Nnaji</span><br/>
                                    Genres: <span class="vid-genres">Drama</span><br/>
                                    </div>
                                </div>
                                
                                <div class="full_details_right_col">
                                    <i class="icon-cross close-details-btn"></i>
                                    <div style="clear:both;"></div>
                                </div>
                                
                                <i class="icon-youtube-play full_detail_playbtn"></i>
                        
                                <div style="clear:both"></div>
                                </div>
                            </div>

                            <div style="margin-bottom:25px;"></div>
                        <!--/ CSS Classes -->
                        <?php
                            }
                            
                            ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>


    <!-- move this to shared folder and include -->
    <div id="desktop-footer-wrapper">
    <?php echo $footer ?>
    </div>


    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/headroom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/prism.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/app.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>static/js/site.js"></script>
    
  </body>

<!-- Mirrored from demo.pixinvent.com/robust-admin/ltr/vertical-content-menu-template/layout-2-columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Feb 2017 19:32:00 GMT -->
</html>