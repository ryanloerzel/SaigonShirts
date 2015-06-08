<html> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/main.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/fonts.css" type="text/css" media="screen">
    <link rel="stylesheet" href= "<?php echo BASE_URL; ?>css/style.css" type="text/css" media="screen">

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="wrapper"> <!-- STICKY FOOTER HACK -->
        <header>
            <div class="container">
                <div id="logo">
                    <a href="<?php echo BASE_URL; ?>"> <img src="<?php echo BASE_URL; ?>img/saigon_shirts.svg"></a>           
                </div>
                <nav id="main-nav">                 
                    <a href="<?php echo BASE_URL; ?>shirts/" class="shirts <?php if ($section == "shirts") {echo "on";} ?>"><span class="header_link">SHIRTS</span></a> 
                    <a href="<?php echo BASE_URL; ?>contact/" class="contact <?php if ($section == "contact") {echo "on";}?>"><span class="header_link">CONTACT</span></a> 
                    <a href="<?php echo BASE_URL; ?>search/" class="search <?php if ($section == "search") {echo "on";}?>"><span class="header_link">SEARCH</span></a> 
                    <a target="paypal"  href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&amp;business=MMCUSC3QZPBJC&amp;display=1" class="cart">CART</a>
                </nav>
            </div>
        </header>




