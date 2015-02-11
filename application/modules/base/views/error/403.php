<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>AdminDesigns - A Responsive HTML5 Admin UI Framework</title>
    <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
    <meta name="description" content="AdminDesigns - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="AdminDesigns">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo skin_url() ?>assets/skin/default_skin/css/theme.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo skin_url() ?>assets/img/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body class="error-page alt sb-l-c sb-r-c">

    <!-- Start: Main -->
    <div id="main">

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- Begin: Content -->
            <section id="content" class="pn animated fadeIn">

                <div class="center-block mt50 mw800">
                    <h1 class="error-title"> 403! </h1>
                    <h2 class="error-subtitle">You are not authorized.</h2>
                </div>

                <a href="<?php echo base_url() ?>" id="return-arrow">
                    <i class="fa fa-arrow-left fa-3x text-primary"></i>
                    <span> Return
                        <br> to Application </span>
                </a>

            </section>
            <!-- End: Content -->

        </section>

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo skin_url() ?>vendor/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo skin_url() ?>vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="<?php echo skin_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="<?php echo skin_url() ?>assets/js/utility/utility.js"></script>
    <script type="text/javascript" src="<?php echo skin_url() ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?php echo skin_url() ?>assets/js/demo.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Demo JS    
            Demo.init();  


        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>
