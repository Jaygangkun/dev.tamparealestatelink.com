<?php
// ##############
// Define Vars #
// ##############
$path = '';
include_once $path.'admin/func/common.php';
include_once $path . 'config.php';
include_once 'func/common.php';
$mls = strip_tags ( $_GET ['mls'] );
$bahia_folder = (substr ( $_SERVER ['REQUEST_URI'], 0, 6 ) == '/bahia') ? '/bahia' : '';
$_SERVER ['HTTP_HOST'] = (substr ( $_SERVER ['REQUEST_URI'], 0, 6 ) == '/bahia') ? $_SERVER ['HTTP_HOST'] . '/bahia' : $_SERVER ['HTTP_HOST'];

// ##################
// Listing Details #
// ##################
if (isset($_GET['id'])) {
    $mls = $_GET['id'];
}
if (is_numeric($mls)) {
    // override $global_area_id to 2 Tampa for manual listings.
    $global_area_id = 2;
}
if(!isset($_GET['id']) || is_numeric($mls))
{
	$results = mysqli_query($con,"SELECT * FROM $tbl_listings WHERE mls='".mysqli_real_escape_string($con,$mls)."' and area_id = $global_area_id LIMIT 1");
}
else
{
	$results = mysqli_query($con,"SELECT * FROM $tbl_listings WHERE id='".mysqli_real_escape_string($con,strip_tags($_GET['id']))."' LIMIT 1");
}
$row = mysqli_fetch_assoc($results);

// ###############
// Validate MLS #
// ###############
if ((! $mls || $mls != $row ['mls']) && (! isset ( $_GET ['id'] ))) {
	header ( 'HTTP/1.1 404 Not Found' );
	$meta_title = 'Photo Gallery ' . $address . ', ' . $city . ', ' . $state . ' ' . $zipcode . ' - Bahia International Realty';
	
	include $path . 'header.php';
	echo '
	 		<div class="container">
				<div class="row">
				 		<div class="col-md-9">
							<h1>Error - MLS Listing Doesn\'t Exist!</h1>
							<p>Sorry that MLS listing doesn\'t seem to exist. Please choose another listing. <a href="property-search.php">Search listings.</a></p>
						</div>
						<div class="col-md-3">';
	include $path . 'footer.php';
	echo '</div>
				</div>
			</div>
		  ';
	include $path . 'footer.php';
	die ();
}

if (!empty($row) && is_array($row)) {
	foreach ( $row as $k => $v ) {
		$$k = $v;
		if ($k == 'baths') {
			$baths = $v * 1;
		}
	}

}

$img_base = 'images/mls/';
$img_base .= (! isset ( $_GET ['id'] )) ? substr ( $row ['mls'], 0, 1 ) . '/' . substr ( $row ['mls'], 1 ) . '/' : 'manual/' . $row ['id'] . '/';

$img_dir = DEF_IMAGE_FOLDER . $img_base;
$img_file = ($row ['mls'] != '') ? substr ( $row ['mls'], 0, 1 ) . '/' . substr ( $row ['mls'], 1 ) . '/preview.jpg' : 'manual/' . $row ['id'] . '/preview.jpg';

$img_base_url = DEF_IMAGE_URL . $img_base;

$imgs = listImages ( $img_dir );
$i = 0;

$manual = is_numeric(substr($mls,0,1));
$img_file = (!$manual) ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/preview.jpg' : 'manual/'.$row['id'].'/preview.jpg';


// #################
// Include Header #
// #################
$meta_title = 'Photo Gallery ' . $address . ', ' . $city . ', ' . $state . ' ' . $zipcode;
$meta_description = 'Photo Gallery ' . $address . ', ' . $city . ', ' . $state . ' ' . $zipcode . ' - Tampa Homes for Sale Now';
$robots = 'noindex';
include $path . 'header.php';
?>
<link rel="stylesheet" href="css/photo-gallery.css" type="text/css">
<link rel="stylesheet" type="text/css"
	href="css/glossy-square/gray/glossy-square-gray.css">
<script  src="js/jquery.easing.1.3.min.js"></script>
<!--[if IE]><script  src="js/excanvas.compiled.js"></script><![endif]-->
<script  src="js/jquery.advancedSlider.min.js"></script>
<script  src="js/jquery.touchSwipe.min.js"></script>
<script>

/////////////////////
// FADDING IMAGES //
////////////////////
function cycleImages()
{
 var $active = $('.result_photocycler .active');
 var $next = ($active.next().length > 0) ? $active.next() : $('.result_photocycler img:first');
 $next.css('z-index',2); //move the next image up the pile
 $active.fadeOut(1500,function()
 {
  //fade out the top image
  $active.css('z-index',1).show().removeClass('active'); //reset the z-index and unhide the image
  $next.css('z-index',3).addClass('active'); //make the next image the top one
 });
}
$(document).ready(function(){ setInterval('cycleImages()', 4000); });
jQuery(document).ready(function($){
		$('#my-slider').advancedSlider({width: 800,
												height: 740,
												responsive: true,
												skin: 'glossy-square-gray',
												shadow: false,
												effectType: 'swipe',
												slideshow: false,
												pauseSlideshowOnHover: true,
												swipeThreshold: 30,
												swipeDuration: 400,
												slideButtons: false,
												slideArrows: true,
												slideArrowsToggle: false,												
												thumbnailType: 'scroller',
												thumbnailWidth: 80,
												thumbnailHeight: 50,
												thumbnailSlideDuration: 80,
												thumbnailScrollDuration:270,
												thumbnailButtons: true,
												thumbnailSwipe: true,
												thumbnailScrollerResponsive: true,
												minimumVisibleThumbnails: 2,
												maximumVisibleThumbnails: 8,
												keyboardNavigation: true
		});
		
	});
</script>

<div class="container brownlinks" style="overflow:hidden;">
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6">
					<h1>Photo Gallery</h1>
				</div>
				<div class="col-md-6">
					<div class="text-right" style="padding-right: 35px;">
						<a
							href="/<?=($manual!='Y') ? $city.'/'.$mls : 'result_newhome.php?id='.$id?>"
							style="text-decoration: none;"><img src="images/icons/back.png"
							alt="" style="padding-right: 3px;"> <span
							style="text-decoration: underline;">Back to Listing</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-9" style="margin-bottom: 2em;">
			<div class="advanced-slider" id="my-slider">
				<div class="slides">
						<?php
						foreach ( $imgs as $k => $img ) {
							echo '
						<div class="slide">
							<img class="image" src="' . DEF_IMAGE_URL . $img_base . $img . '" alt=""/>
							<img class="thumbnail" src="' . DEF_IMAGE_URL . 'images/image.php?width=140&height=80&image=/' . $img_base . $img . '" alt=""/>
						</div>';
						}
						?>
					</div>
			</div>

		</div>

		<!--sidebar -->
		<div class="col-md-3">
            <div style="margin-bottom:2em;">
                <?php include 'view-brochure-small.php' ?>
            </div>
        </div>
	</div>
</div>

<?php
// #################
// Include Footer #
// #################
include $path . 'footer.php';
?>