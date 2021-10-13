<?php

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP/1.1

header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header('Pragma: no-cache');

include_once 'check_registration.php';

update_FREE_USER_ALLOWED_RESULTS_LOOKUPS ();



##################

# Include Header #

##################

$path = '';

$authRequired = false;

include_once 'admin/config.php';

include_once $path.'admin/func/common.php';

include_once 'config.php';

include_once $path.'func/rewrite_defines.php';

include_once 'func/common.php';

$bahia_folder = (substr($_SERVER['REQUEST_URI'],0,6)=='/bahia') ? '/bahia' : '';

$_SERVER['HTTP_HOST'] = (substr($_SERVER['REQUEST_URI'],0,6)=='/bahia') ? $_SERVER['HTTP_HOST'].'/bahia' : $_SERVER['HTTP_HOST'];



###################

# Listing Details #

###################

if(isset($_GET['mls']))

{

	$mls = $_GET['mls'];

	$results = mysqli_query($con,"SELECT * FROM $tbl_listings WHERE mls='".mysqli_real_escape_string($con,$mls)."' and area_id = $global_area_id LIMIT 1");

	if (is_numeric($mls)){

		//echo "this is numeric";

		$id = $mls;

		unset($mls);

		$_GET['id'] = $id;

		unset($_GET['mls']);

	}

}

elseif(isset($_GET['id']) && is_numeric($_GET['id']))

{

	$id = $_GET['id'];

	$results = mysqli_query($con,"SELECT * FROM $tbl_listings WHERE id='".mysqli_real_escape_string($con,$id)."' LIMIT 1");

}

$row = mysqli_fetch_assoc($results);



####################

# Validate Listing #

####################

if((@$row['mls']!=@$_GET['mls'] && @$_GET['mls']) || @!$row['mls'] && isset($_GET['id']))

{

	header('HTTP/1.1 404 Not Found');

	

	$meta_title = 'Listing Not Available - Bahia International Realty';

	$meta_description = '';

	include $path.'header.php';

	 echo '

		<div class="container">

		<div class="row">

		 		<div class="col-md-9">

					<h1>Error - MLS Listing Doesn\'t Exist!</h1>

					<p>Sorry that MLS listing doesn\'t seem to exist. Please choose another listing. <a href="property-search.php">Search listings.</a></p>

				</div>

	 		<div class="col-md-3">';

	 include $path.'email_raul.php';

	 echo '</div>

		</div>

	</div>';

	include $path.'footer.php';

	die();

}



##########

# Images #

##########

foreach($row as $k => $v)

{

	$$k = $v;

	if($k=='baths') { $baths = $v*1; }

}



$manual = is_numeric(substr($mls,0,1));



$img_dir = DEF_IMAGE_FOLDER.'images/mls/';

$img_dir .= (!isset($_GET['id'])) ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/' : 'manual/'.$row['id'].'/';



$img_base_url = DEF_IMAGE_URL.'images/mls/';

$img_base_url .= (!isset($_GET['id'])) ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/' : 'manual/'.$row['id'].'/';

$img_file = (!$manual) ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/preview.jpg' : 'manual/'.$row['id'].'/preview.jpg';



switch(strtolower($property_style))

{

	case 'condo':

		$type4URL = TYPES_condo;

		break;

	case 'townhome':

	case 'townhouse':

		$type4URL = TYPES_townhomes;

		break;

	default:

		{

			$type4URL = strtolower(str_replace(' ','_',$property_style));

			if (DEF_TRANLATION_LANG != "english")

			{

				$type4URL = str_replace($types_orig,$types,$type4URL);

			}

		}

}



$homeWordage = (strtolower(trim($row['type'],' '))=='condo') ? 'Condo' : 'Home';

$meta_title = $homeWordage.' for sale at '.$address.', '.$city.', '.$state.' '.$zipcode;

$meta_description = $homeWordage.' for sale at '.$address.', '.$city.', '.$state.' '.$zipcode;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$imgs = listImages($img_dir);

$i = 0;

foreach($imgs as $k => $img)
{
	$fb_img = $img_base_url.$img;
	break;
}

$header_fb = '<meta property="og:title" content="Home For Sale: '.$beds.' beds '.$baths.' bath in '.$city.', '.$state.'"/>

<meta property="og:type" content="article"/>

<meta property="og:url" content="'.$actual_link.'"/>

<meta property="og:image" content="'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].$fb_img.'"/>

<meta property="og:site_name" content="Bahia International Realty"/>
<meta property="fb:app_id" content="257161318600965" />
<meta property="og:description" content="'.$public_remarks_new.'"/>';

include $path.'header.php';



?>

<link rel="stylesheet" href="/css/slider-pro.min.css" type="text/css">
<script async src="/js/jquery.sliderPro.min.js"></script>


<script> 

function toGallery() {

    window.location.href = "/photo-gallery.php?mls=<?=$mls?>";

}

</script> 



<!-- result page -->

<div class="container result">

	<div class="row" style="margin-bottom: 10px;">

		<div class="col-md-4">

			<span class="result-top-title"> <?=(@$manual) ? $city.', '.$state : $city.', '.$state?></span>

		</div>

		<div class="col-md-4"></div>

		<div class="col-md-4">

			<span class="result-top-title">$<?=number_format($price)?></span>

		</div>

	</div>



	<div class="row">

		





		<div class="col-md-9 col-md-push-3">



			<!-- advanced slider and req info box -->

			<div class="row">

				<div class="col-md-8">

				

				<?php 

					$banner = '<!-- banner -->

					<div class="prop_banner" 

						 style="z-index:1000;

						 		position:absolute;

						 		width:95%;

						 		height:42px;

						 		border:2px solid #D50F25;

						 		background-color:#D50F25;

						 		margin-top:28%;

								color:white;

						 		font-size:30px;

						 		font-family:arial,verdana;

						 		font-weight:bold;

						 		text-align:center;

								">

					'.strtoupper($status).'

					</div>';

					

					if($status != 'Active')

					{

						echo $banner;

					}

				?>
					<style>
					.sp-thumbnail {
						width: 100%;
						height: 100%;
						background-size: cover;
						background-position: center;
						background-repeat: no-repeat;
					}

					#slider_img {
						margin-bottom: 20px;
					}
					</style>
					<div id="slider_img" class="slider-pro">
						<div class="sp-slides">
						<?php

							$imgs = listImages($img_dir);

							$i = 0;

							foreach($imgs as $k => $img)

							{

								$i++;

								?>
								<div class="sp-slide">
									<img class="sp-image" src="<?php echo $img_base_url.$img?>"
										data-src="<?php echo $img_base_url.$img?>"
										data-retina="<?php echo $img_base_url.$img?>"/>
								</div>
								<?php

							}
						?>
						</div>

						<div class="sp-thumbnails">
							<?php

								$imgs = listImages($img_dir);

								$i = 0;

								foreach($imgs as $k => $img)

								{

									$i++;

									?>
									<div class="sp-thumbnail" style="background-image:url(<?php echo $img_base_url.$img?>)">
									</div>
									<?php

								}

							?>
						</div>
					</div>

					<div class="gallery-bottom">
						<a class="gallery-bottom__more-link" href="/photo-gallery.php?mls=<?=$mls?>">More photos...</a>
						<div class="gallery-bottom__share">
							<!-- Load Facebook SDK for JavaScript -->
							<div id="fb-root"></div>
							<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=257161318600965&autoLogAppEvents=1"></script>

							<style>
							.gallery-bottom__share{
								display: flex;
								align-items: center;
							}

							.fb_iframe_widget{
								height: 22px;
							}

							.fb_iframe_widget > span{
								vertical-align: initial !important;
								margin: 0px 5px;
							}
							</style>
							<?php
							$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							?>
							<!-- Your like button code -->
							<!-- <div class="fb-like" data-href="<?php echo $actual_link?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div> -->
							<div class="fb-like" data-href="<?php echo $actual_link?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="false"></div>
							<div class="fb-share-button" data-href="<?php echo $actual_link?>" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
						</div>
						<?php
						$fb_share_btn = true;
						?>
					</div>

				</div>

				<div class="col-md-4">

					<div style="margin-bottom:2em;">

						<?php include 'view-brochure-small.php' ?>

					</div>

				</div>

			</div>





			<!-- property details -->

			<div class="row">

				<div class="col-md-12">

					<div class="prop-details-header">Details</div>

					<!--1-->

					<div class="row">

						<div class="col-md-6">

							<span class="prop-details-key"><?=translation('List Price',true)?></span><span

								class="prop-details-value">$<?=number_format($price)?></span>

						</div>

						<div class="col-md-6">

							<span class="prop-details-key">Property ID</span><span

								class="prop-details-value"><?=$mls?></span>

						</div>

					</div>

					<!--2-->

					<div class="row">

						<div class="col-md-6">

							<span class="prop-details-key"><?=translation('Bedrooms',true)?></span><span

								class="prop-details-value"><?=$beds?></span>

						</div>

						<div class="col-md-6">

							<span class="prop-details-key"><?=translation('Property Type',true)?></span><span

								class="prop-details-value"><a href="/<?=str_replace(' ','-',str_replace('  ',' ',str_replace('/','',$city)))?>/<?=$type4URL?>"><?=translation($type,true)?></a></span>

						</div>

					</div>

					<!--3-->

					<div class="row">

						<div class="col-md-6">

							<span class="prop-details-key"><?=translation('Full Bathrooms',true)?></span><span

								class="prop-details-value"><?=$baths?></span>

						</div>

						<div class="col-md-6">

							<span class="prop-details-key"><?=translation('Square Feet/m2',true)?></span>

							<span class="prop-details-value">

							<?

							if($sqft != null)

							{

								echo number_format($sqft).' '.translation('sq.ft.',true).' ('.number_format(sqft2m2($sqft)).' '.translation('m2',true).')';

							}

							?>

							</span>

						</div>

					</div>

					<!--4-->

					<div class="row">

						<div class="col-md-6">

							<span class="prop-details-key">Status</span><span

								class="prop-details-value"><?=$status?></span>

						</div>

						

					</div>

				</div>

			</div>

			<!-- property Desc -->

			<div class="row">

				<div class="col-md-12">

					<div class="prop-details-header">Description</div>

					<div class="prop-desc"><?php echo  html_entity_decode( getDescription(), ENT_QUOTES ); ?></div>



					<div class="prop-note prop-not--desktop">This listing is courtesy of <?=($office_name) ? ucwords2(strtolower($office_name)) : 'Bahia International Realty'?>. Property Listing Data contained within this site is the property of My Florida Regional MLS and is provided for consumers looking to purchase real estate. Any other use is prohibited. We are not responsible for errors and omissions on this web site. All information contained herein should be deemed reliable but not guaranteed, all representations are approximate, and individual verification is recommended.</div>



				</div>

			</div>



		</div>

		<div class="col-md-3 col-md-pull-9">

			<div class="result-nav">

				<div class="result-title">Quick Links</div>

				<ul>

					<li><a href="/virtual-tour.php?mls=<?=$mls?>"><img

							src="/images/icons/tour.gif"

							width="28" height="28" alt="Virtual Tour" />Virtual Tour</a></li>

					<li><a

						href="/mortgage-calculator-listing.php?mls=<?=$mls?>&price=<?=number_format($price)?>"><img

							src="/images/icons/mortgage.gif"

							width="21" height="22" alt="Mortgage Calculator">Mortgage

							Calculator</a></li>

					<li><a href="/show-map.php?mls=<?=$mls?>"><img

							src="/images/icons/map.gif"

							width="22" height="22" alt="Show Map">Show Map</a></li>

					<li><a href="/email-listing.php?mls=<?=$mls?>"><img

							src="/images/icons/email-listing.gif"

							width="21" height="22" alt="Email Listing">Email to a Friend</a></li>

				</ul>

			</div>



			<div class="result-nav">

				<div class="result-title">Contact Us</div>

				<ul>

					<li><a href="/request-more-info.php?mls=<?=$mls?>"><img

							src="/images/icons/request-info.gif"

							width="28" height="18" alt="Request Info" />Request More Information</a></li>

				</ul>

			</div>

			<div class="prop-note prop-not--mobile">This listing is courtesy of <?=($office_name) ? ucwords2(strtolower($office_name)) : 'Bahia International Realty'?>. Property Listing Data contained within this site is the property of My Florida Regional MLS and is provided for consumers looking to purchase real estate. Any other use is prohibited. We are not responsible for errors and omissions on this web site. All information contained herein should be deemed reliable but not guaranteed, all representations are approximate, and individual verification is recommended.</div>

		</div>

	</div>



</div>

<script>

	function checkjQuery(){

		if(window.jQuery){

			console.log('jQuery loaded');

			callbackjQuery();

			return true;

		}

		setTimeout(function(){

			checkjQuery();

		}, 100);

		return false;

	}

	checkjQuery();

	function callbackjQuery() {
		jQuery(document).ready(function($){
			function checkSlierProLoaded() {
				if(jQuery.fn.sliderPro){
					cbSliderProLoaded();
					return true;
				}

				setTimeout(function(){
					checkSlierProLoaded();
				}, 100);
			}

			checkSlierProLoaded();

			function cbSliderProLoaded() {
				$( '#slider_img' ).sliderPro({
					width: 960,
					height: 500,
					arrows: true,
					buttons: false,
					waitForLayers: true,
					thumbnailWidth: 200,
					thumbnailHeight: 100,
					thumbnailPointer: true,
					autoplay: false,
					autoScaleLayers: false,
					breakpoints: {
						500: {
							thumbnailWidth: 120,
							thumbnailHeight: 50
						}
					}
				});
			}
			
		});
	}

  	
</script>

<?php

include $path . 'banner-ad.php';

##################

# Include Footer #

##################

include $path.'footer.php';

?>