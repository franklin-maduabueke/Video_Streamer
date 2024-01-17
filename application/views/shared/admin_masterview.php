<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="loans settlement application from Amplify">
    <meta name="keywords" content="recurring payment solution, online payment solution, online payment solution in Nigeria, recurring payments in Nigeria, loan application, made in Nigeria software">
    <meta name="author" content="AMPLIFY PLUS">

    <title><?php echo $this->config->item('app_name'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>static/robust-assets/ico/favicon-32.png">
    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>static/robust-assets/css/vendors.min.css" />
    <!-- BEGIN VENDOR CSS-->
    <!-- BEGIN Font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <!-- END Font icons-->
    <!-- BEGIN Plugins CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/sliders/slick/slick.css">
    <!-- END Plugins CSS-->

    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/charts/c3.css">
    <!-- END Vendor CSS-->


    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/tables/datatable/dataTables.bootstrap4.min.css">
    <!-- END Vendor CSS-->

    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/toggle/switchery.min.css">
    <!-- END Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/pickers/pickadate/pickadate.css">

    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/extensions/unslider.css">

    <!-- END Vendor CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/components/weather-icons/climacons.min.css">
    <!-- END Page Level CSS-->

    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/icheck/custom.css">
    <!-- END Vendor CSS-->


    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/ui/jquery-ui-slider-pips.min.css">
    <!-- END Vendor CSS-->


    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>static/robust-assets/css/app.min.css" />
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="~/assets/css/style.css">
    <!-- END Custom CSS-->

    <link href="~/css/amplifyplus.css" rel="stylesheet" />

</head>
<body data-open="click" data-menu="vertical-content-menu" data-col="2-columns" class="vertical-layout vertical-content-menu 2-columns fixed-navbar">
    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark" style="background-color:#0e0f11; padding-bottom:15px;">
      <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                <button class="nav-link menu-toggle hamburger hamburger--arrow js-hamburger"><span class="hamburger-box"></span><span class="hamburger-inner"></span></button>
                </li>
                <li class="nav-item"><a href="<?php echo site_url(); ?>" class="navbar-brand nav-link"><img style="width:169px; height: 48px;" alt="DUDU-XXX" src="<?php echo base_url();?>static/duduxxxlogo.png" data-expand="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-light.png" data-collapse="<?php echo base_url();?>static/robust-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="robust-content content container-fluid">
        <div class="content-wrapper">
            <!-- main menu-->
            <div class="main-menu menu-dark menu-fixed menu-bordered menu-shadow">
                <!-- side nav bar-->
                <?php $this->load->view('shared/sidebar.php', $active_page); ?>
                <!-- /side nav bar-->
                <!-- main menu footer-->
                <div class="main-menu-footer footer-close">
                    <div class="header text-xs-center"><a href="#" class="col-xs-12 footer-toggle"><i class="icon-ios-arrow-up"></i></a></div>
                    <div class="content">
                        <div class="insights">
                            <div class="col-xs-12">
                                <p>Product Delivery</p>
                                <progress value="25" max="100" class="progress progress-xs progress-success">25%</progress>
                            </div>
                            <div class="col-xs-12">
                                <p>Targeted Sales</p>
                                <progress value="70" max="100" class="progress progress-xs progress-info">70%</progress>
                            </div>
                        </div>
                        <div class="actions"><a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Settings"><span aria-hidden="true" class="icon-cog3"></span></a><a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock"><span aria-hidden="true" class="icon-lock4"></span></a><a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout"><span aria-hidden="true" class="icon-power3"></span></a></div>
                    </div>
                </div>
                <!-- main menu footer-->
            </div>
            <!-- / main menu-->
            <!--content body goes here-->
            <div class="content-body">
                <!--@RenderBody()-->
                <?php $this->load->view($render_body); ?>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!--@Html.Partial("_pagefooter")-->

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/headroom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/core/libraries/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/prism.min.js"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/jquery.steps.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/tables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/toggle/switchery.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/validation/jquery.validate.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/pickadate/picker.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/pickadate/picker.date.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/pickadate/picker.time.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/pickadate/legacy.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/pickers/daterange/daterangepicker.js" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/app.min.js"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/tables/datatables/datatable-basic.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/forms/switch.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/forms/wizard-steps.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/pickers/dateTime/picker-date-time.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/jquery.knob.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/raphael-min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/chartist.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/chartist-plugin-tooltip.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/chart.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/underscore-min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/clndr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/extensions/unslider-min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/extensions/knob.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/demo-data/jvector/visitor-data.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/pages/dashboard-analytics.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/d3.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/charts/c3.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/line.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/spline.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/area.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/step.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/line-region.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/simple-xy.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/c3/line/multiple-xy.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/components/pages/dashboard-project.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/components/forms/checkbox-radio.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/jquery-ui-slider-pips.min.js" type="text/javascript"></script>


    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/components/pages/dashboard-fitness.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/components/ui/jquery-ui/slider-spinner.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <script src="<?php echo base_url();?>static/robust-assets/js/components/forms/form-repeater.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>static/robust-assets/js/components/charts/morris/line.js" type="text/javascript"></script>

    <script type="text/javascript" src="<?php echo base_url();?>static/js/site.js"></script>
</body>
</html>