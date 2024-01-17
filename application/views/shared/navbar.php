<div style="position:fixed; top:0px; left:0px; z-index:100; width:100%; height:70px; background-color:#0e0f11; opacity:0.8;" class="hidden" id="navbg"></div>

<nav id="homepagenavbar" class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark" style="background-color: transparent; padding:0px 30px 15px 30px;">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left">
              <button class="nav-link menu-toggle hamburger hamburger--arrow js-hamburger"><span class="hamburger-box"></span><span class="hamburger-inner"></span></button>
            </li>
            <li class="nav-item"><a href="<?php if (! isset($active_page) || $active_page != "home-page") echo site_url(); else echo "#"; ?>" class="navbar-brand nav-link"><img alt="DUDU-XXX" src="<?php echo base_url();?>static/duduxxxlogo.png" data-expand="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-light.png" data-collapse="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
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
                          <li><a href="#" class="dropdown-item" style="color:white;">Home</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <li class="col-md-10" style="border-left:1px solid grey;">
                    <ul class="drilldown-menu">
                      <li class="menu-list">
                        <ul>
                        <?php
						if (is_array($video_category)) {
							foreach ($video_category as $category)
							{
							?>
							  <li class="mydropdownlinks" style="float:left; margin-right:10px; overflow:hidden; max-width:130px; width:130px;"><a href="<?php echo site_url() . '/video/search/' . $category['appid'] . '';?>" class="dropdown-item" style="color:white; font-weight:normal;"><?php echo $category['title']; ?></a></li>
							<?php
							}
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
              <li class="dropdown dropdown-language nav-item" style="font-size:16px;">
                <input type="hidden" id="api-video-search-endpoint" value="<?php echo site_url() . '/api/video-search/' ?>" />
                <div class="form-group position-relative has-icon-left hidden" id="search-query-input-container">
                    <input type="text" placeholder="Titles, people, genres" class="form-control txtSearchQuery" style="background-color:black; border:1px solid white;">
                    <div class="form-control-position">
                        <i class="icon-cross text-muted" style="color:white"></i>
                    </div>
                </div>

                <?php
                if (! isset($hide_right_links)) 
                {
                ?>
                <a href="#" class="nav-link" style="color:white; text-shadow:1px 1px black;" id="ajaxsearchlink"><i class="icon-search"></i> Search</a>
                <?php 
                }
                ?>
              </li>

              <?php
                if (! isset($this->session->display_name) || isset($hide_right_signin_link)) 
                {
              ?>
              <li class="dropdown dropdown-language nav-item" style="font-size:16px;">
                <a href="<?php echo site_url() . '/subscriber/signin' ?>" class="nav-link" style="color:white; text-shadow:1px 1px black;"><i class="icon-person hidden"></i> Sign In</a>
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

              <?php
                if (isset($this->session->display_name) && ! isset($hide_right_links)) 
                {
              ?>
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
            </ul>
            
          </div>
        </div>
      </div>
    </nav>