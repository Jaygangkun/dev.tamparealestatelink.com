<?php

###############

# Define Vars #

###############

$path = '';

include_once $path.'admin/func/common.php';

include_once $path.'config.php';

require_once $path.'func/common.php';

$mls = strip_tags($_GET['mls']);

$bahia_folder = (substr($_SERVER['REQUEST_URI'],0,6)=='/bahia') ? '/bahia' : '';

$_SERVER['HTTP_HOST'] = (substr($_SERVER['REQUEST_URI'],0,6)=='/bahia') ? $_SERVER['HTTP_HOST'].'/bahia' : $_SERVER['HTTP_HOST'];



###################

# Listing Details #

###################

if (is_numeric($mls)) {

    // override $global_area_id to 2 Tampa for manual listings.

    $global_area_id = 2;

}



$results = mysqli_query($con,"SELECT * FROM $tbl_listings WHERE mls='".mysqli_real_escape_string($con,$mls)."' LIMIT 1");

$row = mysqli_fetch_assoc($results);



################

# Validate MLS #

################

if(!$mls || $mls!=$row['mls'])

{

 header('HTTP/1.1 404 Not Found');



 $meta_title = 'Virtual Tour for '.$address.', '.$city.', '.$state.' '.$zipcode.'';

 $meta_description = 'Virtual Tour for '.$address.', '.$city.', '.$state.' '.$zipcode.'';

 include $path.'header-virtual-tour.php';

echo '

			<div class="container">

				<div class="row">

				 		<div class="col-md-12">

							<h1>Error - MLS Listing Doesn\'t Exist!</h1>

							<p>Sorry that MLS listing doesn\'t seem to exist. Please choose another listing. <a href="property-search.php">Search listings.</a></p>

						</div>

				</div>

			</div>';

 include $path.'footer.php';

 die();

}





foreach($row as $k => $v)

{

 $$k = $v;

 if($k=='baths') { $baths = $v*1; }

}



$img_base_folder = 'images/mls/';

//$img_dir .= ($mls!='') ? substr($mls,0,1).'/'.substr($mls,1).'/' : 'manual/'.$id.'/';

//echo "mls: $mls<br>";

if (!is_numeric(substr(trim($mls),0,1))) {

	// this is an MLS numbr

	$img_base_folder .= substr($mls,0,1).'/'.substr($mls,1).'/';

} else {

	// this is a manual listing

	$img_base_folder .= 'manual/'.$mls.'/';

} 



$img_dir = DEF_IMAGE_FOLDER.$img_base_folder;



$imgs = listImages($img_dir);



$manual = is_numeric(substr($mls,0,1));

$img_file = (!$manual) ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/preview.jpg' : 'manual/'.$row['id'].'/preview.jpg';



##################

# Include Header #

##################

 $meta_title = 'Virtual tour for '.$address.', '.$city.', '.$state.' '.$zipcode.'';

 $meta_description = 'Virtual tour for '.$address.', '.$city.', '.$state.' '.$zipcode.'';

 $robots="noindex";



include $path.'header-virtual-tour.php';

?>

<script src="js/responsiveslides.min.js"></script>

<script src="js/audio.min.js"></script>

<script src="js/jquery.browser.min.js"></script>



<style>

.centered-btns_nav {

  z-index: 3;

  position: absolute;

  top: 50%;

  left: 0;

  opacity: 0.7;

  text-indent: -9999px;

  overflow: hidden;

  text-decoration: none;

  height: 61px;

  width: 38px;

  background: transparent url("/images/themes.gif") no-repeat left top;

  margin-top: -45px;

  }



.centered-btns_nav:active {

  opacity: 1.0;

  }



.centered-btns_nav.next {

  left: auto;

  background-position: right top;

  right: 0;

  }



.transparent-btns_nav {

  z-index: 3;

  position: absolute;

  top: 0;

  left: 0;

  display: block;

  background: #fff; /* Fix for IE6-9 */

  opacity: 0;

  filter: alpha(opacity=1);

  width: 48%;

  text-indent: -9999px;

  overflow: hidden;

  height: 91%;

  }



.transparent-btns_nav.next {

  left: auto;

  right: 0;

  }



.large-btns_nav {

  z-index: 3;

  position: absolute;

  opacity: 0.6;

  text-indent: -9999px;

  overflow: hidden;

  top: 0;

  bottom: 0;

  left: 0;

  background: #000 url("/images/themes.gif") no-repeat left 50%;

  width: 38px;

  }



.large-btns_nav:active {

  opacity: 1.0;

  }



.large-btns_nav.next {

  left: auto;

  background-position: right 50%;

  right: 0;

  }



.centered-btns_nav:focus,

.transparent-btns_nav:focus,

.large-btns_nav:focus {

  outline: none;

  }



.centered-btns_tabs,

.transparent-btns_tabs,

.large-btns_tabs {

  margin-top: 10px;

  text-align: center;

  }



.centered-btns_tabs li,

.transparent-btns_tabs li,

.large-btns_tabs li {

  display: inline;

  float: none;

  *float: left;

  margin-right: 5px;

  }



.centered-btns_tabs a,

.transparent-btns_tabs a,

.large-btns_tabs a {

  text-indent: -9999px;

  overflow: hidden;

  -webkit-border-radius: 15px;

  -moz-border-radius: 15px;

  border-radius: 15px;

  background: #ccc;

  background: rgba(0,0,0, .2);

  display: inline-block;

  *display: block;

  -webkit-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);

  -moz-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);

  box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);

  width: 9px;

  height: 9px;

  }



.centered-btns_here a,

.transparent-btns_here a,

.large-btns_here a {

  background: #222;

  background: rgba(0,0,0, .8);

  }

</style>

<script>

    $(function () {



      // Slideshow 1

      $("#slider1").responsiveSlides({

        auto: true,

        pager: true,

        nav: true,

        speed: 500,

        namespace: "centered-btns"

      });



      $.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()); 

      //if(!$.browser.chrome){ audiojs.events.ready(function() { var as = audiojs.createAll(); }); }

      audiojs.events.ready(function() { var as = audiojs.createAll(); }); 

    });

  </script>

  

<div class="container">

	<div class="row">

		<div class="col-md-12">

			<h1>Virtual Tour</h1>

		</div>

	</div>

	

	<div class="row">

		<div class="col-md-9">

				<div class="rslides_container">

			      <ul class="rslides" id="slider1">



			        <?php 

			        foreach($imgs as $k => $img)

			        {

			        	$i++;

			        	echo '<li><img src="'.DEF_IMAGE_URL.$img_base_folder.$img.'" alt=""></li>';

			        }

			        ?>

			      </ul>

			    </div>

		</div>

		<div class="col-md-3">

            <div style="margin-bottom:2em;">

                <?php include 'view-brochure-small.php' ?>

            </div>

        </div>

	</div>

	

	<div class="row">

		<div class="col-md-9">

			<div class="centerme" style="display: table;margin: 0 auto;margin-top:10px;margin-bottom:10px;">

				<audio class="centerme" src="https://<?=$_SERVER['HTTP_HOST']?>/mp3/Safe_And_Secure_full_mix_mp3.mp3" preload="auto" loop="loop">

				<!--[if gt IE 8]><audio src="https://<?=$_SERVER['HTTP_HOST']?>/mp3/Safe_And_Secure_full_mix_mp3.mp3" preload="auto" loop="loop"><![endif]-->

				<!--[if lt IE 9]>

				<object type="application/x-shockwave-flash" data="https://flash-mp3-player.net/medias/player_mp3_multi.swf" width="200" height="20">

				    <param name="movie" value="https://flash-mp3-player.net/medias/player_mp3_multi.swf">

				    <param name="bgcolor" value="#ffffff">

				    <param name="FlashVars" value="mp3=https%3A//<?=$_SERVER['HTTP_HOST']?>/mp3/Safe_And_Secure_full_mix_mp3.mp3&amp;height=20&amp;autoplay=1">

				</object>

				<![endif]-->

                </audio>

			</div>

		</div>

        <div class="col-md-3"></div>

	</div>

	

</div>



<?php

##################

# Include Footer #

##################

include $path.'footer.php';

?>