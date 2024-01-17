<?php $active_page = NULL; ?>
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

    <div class="content-body" style="padding:0px; margin-top:120px; top:0px;">
        <input type="hidden" id="site-base-url" value="<?php echo base_url();?>" />
        
        <div class="row" id="search_heading">
            <div class="col-md-8">
                <h3><?php 
                if (isset($video_category))
                {
                  if (count($video_category) == 0) 
                    echo 'Search';
                  else
                    echo $video_category[0]['title'];
                }
                else
                  echo 'Search';
                ?>
                </h3>
                <h1 style="color:white">Videos</h1>
            </div>

            <div class="col-md-4">
                <div style="margin-left:55px;">
                    <label for="cbSortBy" style="margin:0px; color:white;">Sort By</label>
                    <select name="cbSortBy" id="cbSortBy" style="width:65%; margin-left:10px; border:1px solid white; background-color:black; color:white;">
                        <option value="asc">A-Z</option>
                        <option value="desc">Z-A</option>
                    </select>
                </div>
            </div>
        </div>

      <?php

        $counter = 0;
        for ($vcount = 0; $vcount < count($videos);)
        {
            ++$counter;
      ?>
      <div class="card-and-details-container">
        <div class="card" style="border:none; box-shadow: none; margin:0px; background-color:transparent;">
            <div class="card-body collapse in" style="padding-top:0px; height:auto; margin-left: 0px; padding-left: 20px;">
                <div class="card-block" style="padding-top:0px;">
                    <div id="netflixcarouselContainer">
                    <!-- start caurosel -->
                    <div class="contain">
                        <div class="row">
                        
                        <button class="btn btn-lg btn-teal hidden carouselLCtrl"><i class="icon-ei-chevron-left"></i></button>
                        <button class="btn btn-lg btn-teal hidden carouselRCtrl"><i class="icon-ei-chevron-right"></i></button>

                        <div class="row__inner">
                        <?php
                            while(($counter % 6) != 0 && $vcount < count($videos))
                            {
                                ++$counter;
                        ?>
                            <div class="tile">
                                <input type="hidden" value="<?php echo trim($videos[$vcount]['actors']); ?>" class="video-actors" />
                                <input type="hidden" value="<?php echo trim($videos[$vcount]['directors']); ?>" class="video-directors" />
                                <input type="hidden" value="<?php echo trim($videos[$vcount]['creators']); ?>" class="video-creators" />
                                <input type="hidden" 
                                       value="<?php 
                                                    foreach ($video_category as $category) {
                                                        if (strcasecmp($category['appid'], $videos[$vcount]['category']) == 0)
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
                                      if (strlen($videos[$vcount]['cover_image']) > 2)
                                      {
                                    ?>
                                    <img class="tile__img" src="<?php echo base_url() . 'media_source/video_cover/' . $videos[$vcount]['cover_image']; ?>" alt=""  />
                                    <?php
                                      }
                                    ?>

                                    <img class="tile__img" <?php if (strlen($videos[$vcount]['cover_image'] > 2)) echo 'style="opacity:0;"';?> src="http://vid.ly/<?php echo trim($videos[$vcount]['vidly_url']); ?>/poster" alt=""  />
                                    <img class="tile__img" style="opacity:0;" src="http://vid.ly/<?php echo trim($videos[$vcount]['vidly_url']); ?>/poster2" alt=""  />
                                    <img class="tile__img" style="opacity:0;" src="http://vid.ly/<?php echo trim($videos[$vcount]['vidly_url']); ?>/poster3" alt=""  />
                                </div>

                                <div class="tile__details">
                                    <div class="tile__title">
                                      <a href="<?php echo site_url() . "/video/watch/{$videos[$vcount]['appid']}"; ?>" style="font-weight:bold;"><?php echo trim($videos[$vcount]['title']); ?></a>
                                      
                                      <div class="title_description"><?php echo wordwrap(trim($videos[$vcount]['description']), 65, '<br/>'); ?></div>
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
      </div>
      <!--/ CSS Classes -->
      <?php
        }
        
        ?>
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