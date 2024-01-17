<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">

<!-- Mirrored from demo.pixinvent.com/robust-admin/ltr/vertical-content-menu-template/login-with-bg.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Feb 2017 19:36:33 GMT -->
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/robust-assets/css/plugins/forms/icheck/custom.css">
    <!-- END Vendor CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>static/robust-assets/css/app.min.css" />
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END Custom CSS-->
    <script type="text/javascript" src="~/lib/jquery/dist/jquery.min.js"></script>
</head>
<body style="background-color:rgb(203, 11, 87)" data-open="click" data-menu="vertical-content-menu" data-col="1-column" class="vertical-layout vertical-content-menu 1-column bg-grey bg-lighten-2 blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="robust-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" style="background-color:rgb(203, 11, 87)">
                <section class="flexbox-container">
                    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header no-border">
                                <div class="card-title text-xs-center">
                                    <div class="p-1" style="padding:20px; background-color:#4f4f4f;">
                                        <a href="<?php echo site_url(); ?>"><img style="width:169px; height: 48px; " src="<?php echo base_url();?>static/duduxxxlogo.png" alt="Amplify Plus logo" class="img-responsive" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2"><span>Login to Account</span></p>
                                <div class="card-block pt-0">

                                    <?php if (isset($proc_result))
                                    {?>
                                    <div class="bg-danger" style="font-size:14px; color:#c00; border-radius:5px; padding:10px; margin-bottom:10px;">
                                        <i style="color:#eee"> Username or Password is incorrect!</i>
                                    </div>
                                    <?php
                                    }?>

                                    <?php echo form_open('admin/login', array('class'=>'form-horizontal' , 'name'=>'formLoginPost', 'id'=>'formLoginPost')); ?>
                                        <input type="hidden" value="@Model.RedirectUrl" name="RedirectUrl" />
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="user-name">Enter Username</label>
                                            <input type="text" autocomplete="off" class="form-control teal-lighten-2" id="username" name="username" placeholder="Your Username">
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label for="user-password">Enter Password</label>
                                            <input type="password" class="form-control teal-lighten-2" id="userpassword" name="userpassword" placeholder="Your Password">
                                        </fieldset>
                                        <fieldset class="form-group row">
                                            <div class="col-md-6 col-xs-12 text-xs-center">
                                                <fieldset>
                                                    <input type="checkbox" id="RememberMe" class="chk-remember" name="RememberMe">
                                                    <label for="RememberMe"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            <!--<div class="col-md-6 col-xs-12 float-sm-left text-xs-center">
                                                <a asp-controller="register" asp-action="passwordrecovery" class="card-link teal">Forgot Password?</a>
                                            </div>-->
                                        </fieldset>
                                        <button type="button" id="btnLogin" class="btn btn-outline-teal btn-outline-lighten-2 btn-block"><i class="icon-unlock2"></i> Login</button>
                                    </form>
                                </div>
                                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1 hidden"><span>Don&rsquo;t have an account ?</span></p>
                                <div class="card-block">
                                    <a asp-controller="register" asp-action="index" class="btn btn-outline-teal hidden btn-outline-lighten-2 btn-block"><i class="icon-head"></i> Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/ui/headroom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>static/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/app.min.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>static/robust-assets/js/components/forms/form-login-register.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script type="text/javascript">
        $().ready(function () {
            $("button#btnLogin").click(function () {
                var username = $.trim($("input#username").val());
                var password = $.trim($("input#userpassword").val());

                if (username != "" && password != "")
                    $("form#formLoginPost").submit();
                else
                    alert("Please enter your username and password to login.");
            });

            $("input#userpassword").keyup(function (a) {
                if (a.keyCode == 13)
                    $("button#btnLogin").click();
            });
        })
    </script>
</body>
</html>