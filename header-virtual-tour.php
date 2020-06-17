<?php

header("Cache-Control: must-revalidate");

$offset = 60 * 60 * 24 * 3; //3days

$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";

header($ExpStr);



error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

/*

 * This file is the general hader for all pages.

 * holds the css-es, js references and the top menu.

 */

// ##############

// Define Vars #

// ##############

$meta_title = (@$meta_title != '') ? $meta_title : 'Bahia International Realty - ' . end ( explode ( '/', $_SERVER ['REQUEST_URI'] ) );

$errMess = (isset ( $errMess )) ? $errMess : '';

include_once 'config.php';

include_once 'func/common.php';

/*

 * $getPram = '';

 * foreach($_GET as $k => $v)

 * {

 * if($k!='language') { $getPram .= '&'.$k.'='.$v; }

 * }

 */

$sort = @$_GET ['sort'];



$h1="";

$h2="";



if(basename($_SERVER["REQUEST_URI"], ".php") == "index" | basename($_SERVER["REQUEST_URI"], ".php") == "")

{

	$h1 = '<h1 style="font-family: Oswald;" class="headerTexth1">Tampa Real Estate</h1>';

	$h2 = '<h2 class="headerTexth2" style="font-family: Oswald;margin-top:0px !important;">Our Services are <a href="/free.php" style="color:red; text-decoration: underline;">FREE</a> to Buyers!</h2>';

	

	

}

else

{

	$h1 = '<div style="font-family: Oswald;" class="h11 headerTexth1">Tampa Real Estate</div>';

	$h2 = '<div class="h22 headerTexth2" style="font-family: Oswald;margin-top:0px !important;">Our Services are <a href="/free.php" style="color:red; text-decoration: underline;">FREE</a> to Buyers!</div>';

}



?>

<!doctype html>

<html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:og="https://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" style="overflow-x:hidden;">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-19069298-11"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-19069298-11');
</script>




<!-- Lucky Orange -->

<script type='text/javascript'>

window.__lo_site_id = 176329;



	(function() {

		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;

		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';

		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);

	  })();

	</script>

<!-- End - Lucky Orange -->





<link rel="icon" type="image/x-icon" href="/images/favicon.png" />

<title><?=$meta_title?></title>

<meta name="description"

	content="<?=(@$meta_description!='') ? $meta_description : 'Bahia International Realty , experts in Homes for Sale in Tampa, FL.'?>">



<meta name="robots" content="<?=(@$robots!='') ? $robots : 'all'?>">

<!-- facebook open graph protocol -->
<?php
if(@$header_fb != ''){
    ?>
    <?=@$header_fb?>
    <?php
}
else{
    ?>
    <meta property="og:title" content="<?=$meta_title?>" />
    <meta property="og:type" content="website" />
    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $fb_img = "http://dev.tamparealestatelink.com/data1/images/new_tampa_homes.jpg";

    ?>
    <meta property="og:url" content="<?php echo $actual_link?>" />
    <meta property="og:image" content="<?php echo $fb_img?>" />
    <meta property="fb:admins" content="522672294534775" />
    <meta property="fb:app_id" content="257161318600965" />
    <meta property="og:site_name" content="Tempa Real Estate" />
    <meta property="og:description" content="<?=(@$meta_description!='') ? $meta_description : 'Bahia International Realty , experts in Homes for Sale in Tampa, FL.'?>" />
    <?php
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap-theme.min.css">

<link rel="stylesheet" type="text/css" href="/css/style.mb.css">

<link rel="stylesheet" type="text/css" href="/library/jquerySelectBox/jquery.selectBox.css">



<script src="/js/jquery-2.1.4.min.js"></script>

<script src="/js/jquery.selectbox-0.2.min.js"></script>

<script src="/js/simple-slider.min.js"></script>

<!-- <script src="/js/common.js"></script>  -->

<script src="/js/bootstrap.min.js"></script>

<!-- <script async src="/library/jquerySelectBox/jquery.selectBox.min.js"></script> -->





<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

<?=@$header_extra?>

<script >

var normalSelect = false;

</script>

<style>

.menu-link {

    margin-top: inherit;

    margin-bottom: inherit;

}  

@media only screen and (max-width: 991px) {

    .menu-link {

        margin-bottom: 8px;

        margin-top: 8px;

        box-shadow: none;

        -webkit-box-shadow: none;

    }

    .submenu-link {

		position:relative;

        background-color: #8c7b4f;

        border-radius: 4px;

        width:	300px;

        left:50%;

		margin-left:-150px;

        color: black;

		text-align:center;

		margin-top: 0px;

		margin-bottom:4px;

	}

}

</style>

</head>

<body style="overflow-x:hidden;">
	<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K96SS72"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->



	<!-- Generic -->

	<div class="container">

		<div class="row">

			<!-- Flags -->

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<div class="text-right flags" style="float: right; display: inline-block;">

					<a href="/spanish.php"><img alt="" height="14" src="/images/icons/spanish.png" width="18"></a> 

	                <a href="/portuguese.php"><img alt="" height="14" src="/images/icons/portuguese.png" width="18"></a> 

	                <a href="/"><img alt="" height="14" src="/images/icons/english.png" width="18"></a>

				</div>

			</div>

		</div>

		

		<div class="row">

			<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 text-center">

				<a href="/"><img alt="logo" class="img-responsive small-logo" src="/images/birsqsm.png"></a>

							

            </div>



	  <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5 text-center paddingforcenter">

				<?php echo $h1;?>

				<?php echo $h2;?>

			</div>



			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right hidden-xs hidden-sm visible-md visible-lg">

				<div style="height:100px;padding-top:75px;">

					<strong>(813) 402-1324</strong>

				</div>

			</div>

			<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 text-right" style="padding-left: 0px;">

				<a href="/contact.php"><img alt="jennifer-cook-raul-aleman img-responsive" src="/images/jennifer-cook-raul-aleman.png" style="max-width: 100%;height: auto;"></a>

		  </div>

		</div>





	</div>



	<nav class="navbar navbar-default">

        <div class="container-fluid">

			<div class="container">

				<div class="navbar-collapse collapse" id="navbar">

                <ul class="nav navbar-nav">

                <?php 

                $active_home ="";

                $active_newhome="";

                $active_propsearch="";

                $active_foreclosure="";

                $active_intbuyer="";

                $active_notification="";

                $active_contact="";

                

                ?>

                    <li <?php echo $active_home; ?>>

                        <a href="/">HOME</a>

                    </li>

                    

					

                    <li <?php echo $active_newhome; ?>>

                        <a class="menu-link" href="/new-homes.php">NEW HOMES</a>

                    </li>



                    <li <?php echo $active_propsearch; ?>>

                        <a class="menu-link" href="/property-search.php">FULL SEARCH</a>

                    </li>

                    

                    <!-- <li class="dropdown">

                       <a class="menu-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INVESTORS<span class="caret"></span></a>

			    	<ul class="dropdown-menu">

		    			<li><a class="menu-link submenu-link" href="/investment.php">VACATION HOMES</a></li>

                        <li><a class="menu-link submenu-link" href="/management.php">PROPERTY MANAGEMENT</a></li>

                      </ul>

                    </li>

                    -->

				

                    <li>

                        <a class="menu-link" href="/waterfront.php">WATERFRONT HOMES</a>

                    </li>

                    

                    <li <?php echo $active_foreclosure; ?>>

                        <a class="menu-link" href="/foreclosure.php">FORECLOSURES</a>

                    </li>

                    

					<li <?php echo $active_notification; ?>>

                        <a href="/listing-notification.php">FREE MLS LISTING NOTIFICATION</a>

                    </li>

                    

                    <li class="dropdown">

                        <a class="menu-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RESOURCES<span class="caret"></span></a>

						 <ul class="dropdown-menu">

                            <!--<li><a class="menu-link submenu-link" href="/listing-notification.php">FREE MLS NOTIFIER</a></li>-->

                            <li><a class="menu-link submenu-link" href="/mortgage-calculator.php">MORTGAGE CALCULATOR</a></li>

                            <li><a class="menu-link submenu-link" href="/management.php">PROPERTY MANAGEMENT</a></li>

							<li><a class="menu-link submenu-link" href="/relocation-package.php">RELOCATING TO TAMPA</a></li>

 							<li><a class="menu-link submenu-link" href="/international-buyers.php">INTERNATIONAL BUYERS</a></li>

                            <li><a class="menu-link submenu-link" href="/investment.php">VACATION HOMES</a></li>

                        </ul>

                  </li>

                    <li>

                        <a class="menu-link" href="/contact.php">CONTACT US</a>

                    </li>

                    

                 <!--   <li>

                        <a href="/contact.php">CONTACT US</a>

                    </li>

          		-->

                                

                    

                    <!--<li <?php# echo @$active_intbuyer; ?>>

                        <a href="/international-buyers.php">INTERNATIONAL BUYERS</a>

                    </li>-->

                    

                </ul>

                

            

            </div><!--/.nav-collapse -->

			</div>

		</div><!--/.container-fluid -->

    </nav>