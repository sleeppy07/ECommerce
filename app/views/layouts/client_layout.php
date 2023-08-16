<html>
<head>
    <title><?php echo (!empty($page_title))?$page_title:'Ecommerce'; ?></title>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/style.css"/>
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/main.min.css" rel="stylesheet" />
    

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet" type="text/css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/site.html">
    <link rel="mask-icon" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="<?php echo _WEB_ROOT; ?>/end_user/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/bootstrap.min.css">
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/plugins/nouislider/nouislider.css">
    <link href="<?php echo _WEB_ROOT; ?>/end_user/assets/css/plugins/jquery.countdown.css">
</head>
<body>


    <?php
    $this->render('blocks/header', $sub_content);
    $this->render($content, $sub_content);
    $this->render('blocks/footer', $sub_content);
    ?>


    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/main.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/main.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/jquery.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/superfish.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/end_user/assets/js/jquery.magnific-popup.min.js"></script>
</body>
</html>