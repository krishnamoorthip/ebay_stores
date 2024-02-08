<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Login Page - eBay Stores</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="css/libs/bootstrap.min.css" />

        <link rel="icon" href="favicon.png" type="image/x-icon" />

        <!-- text fonts -->
        <link rel="stylesheet" href="css/libs/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="css/libs/ace.min.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="css/libs/ace-rtl.min.css" />

        <link rel="stylesheet" href="css/libs/sweetalert.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="css/libs/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="js/libs/html5shiv.min.js"></script>
        <script src="js/libs/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1 style="color: #ffffff;">
                                    eBay Stores
                                    <!--<img src="images/logo.png" alt="sunbest" style="width: 320px; height: auto;" />-->
                                </h1>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Please Enter Your Information
                                            </h4>
                                            <div class="space-6"></div>
                                            <form id="login_form">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="uname" name="uname" type="text" class="form-control" placeholder="Username" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </div>

                                                    <div class="form-group">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </div>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Login</span>
                                                        </button>
                                                    </div>
                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->
                            </div><!-- /.position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->
        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="js/libs/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="js/libs/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript" src="js/libs/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/libs/jquery.rest.js"></script>
        <script type="text/javascript" src="js/libs/sweetalert.min.js"></script>
        <script type="text/javascript" src="js/validation.js"></script>
        <script type="text/javascript" src="js/script.js?v2.0"></script>
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='js/libs/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function ($) {
                $(document).on('click', '.toolbar a[data-target]', function (e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });
            });



            //you don't need this, just used for changing background
            jQuery(function ($) {
                $('#btn-login-dark').on('click', function (e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function (e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function (e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });
            });
        </script>
    </body>
</html>
