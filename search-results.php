<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP/1.1

header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header('Pragma: no-cache');

ini_set("log_errors", 1);

ini_set("error_log", "queryErr.txt");

// check for registraion

include_once 'check_registration.php';

update_FREE_USER_ALLOWED_SEARCHES ();



$path = '';

$authRequired = false;

//include_once $path.'admin/func/common.php';

include_once 'config.php';

include_once 'func/rewrite_defines.php';

include_once 'func/common.php';



#################

# Search Cookie #

#################

if(@$_POST['action']=='search')

{

 setcookie('search',serialize($_POST),time()+432000);

 header('location: search-results.php');

 die();

}



if(isset($_COOKIE['search']) && !isset($_GET['type']) && !isset($_GET['street']) && !isset($_GET['zip']) && !isset($_GET['special'])&& !isset($_GET['city']) && !isset($_GET['custom_area']))

{

 foreach(unserialize($_COOKIE['search']) as $k => $v)

 {

  $_POST[$k] = $v;

  $_REQUEST[$k] = $v;

 }

}

if(

(@count($_GET)>0 && !isset($_GET['page'])) || 

(@count($_GET)>1 && isset($_GET['page']) && !isset($_GET['sort'])) || 

(@count($_GET)>1 && !isset($_GET['page']) && isset($_GET['sort'])) || 

(@count($_GET)>2 && isset($_GET['page']) && isset($_GET['sort']))

)

{

 //echo "store in cookie";

 setcookie('search',serialize($_GET),time()+432000);

 foreach($_GET as $k => $v)

 {

  $_POST[$k] = $v;

  $_REQUEST[$k] = $v;

 }

 if(isset($_GET['page']) && isset($_GET['sort']))

 {

  $_GET = array('page'=>$_GET['page'],'sort'=>$_GET['sort']);

 }

 elseif(isset($_GET['page']))

 {

  $_GET = array('page'=>$_GET['page']);

 }

 elseif(isset($_GET['sort'])) {

  $_GET = array('sort'=>$_GET['sort']);

 }

 else

 {

  $_GET = array();

 }

}



if (isset($_POST['type'])) {

 $_GET['type'] = $_POST['type'];

}



$title = getSearchTitle($_REQUEST);



#####################

# Search Parameters #

#####################



$where = "";



// Tampa Only Counties

$where .= " AND city_office_id=$office_id and area_id = $global_area_id AND price>=".$website_minimum_price;



// Property Type

if(@$_REQUEST['type']==TYPES_condo_townhomes)

{

 $where .= " AND (`type` LIKE '%condo%' OR `type` LIKE '%townhouse%' OR `type` LIKE '%townhome%')";

}

elseif(@$_REQUEST['type']==TYPES_townhome || @$_REQUEST['type']==TYPES_townhomes || @$_REQUEST['type']==TYPES_townhouse)

{

 $where .= " AND (`type` LIKE '%townhouse%' OR `type` LIKE '%townhome%')";

}

elseif(isset($_REQUEST['type']) && @$_REQUEST['type']!='any')

{

 $where .= " AND `type` LIKE '%".str_replace('-',' ',$_REQUEST['type'])."%'";

}



// This code added by commenting the previous city code

if (@$_REQUEST ['city'] != '') {

  if (strpos($_REQUEST ['city'], 'TONY_CUSTOM_AREA####') !== false) {

        //$ccc_areas = explode(",", $_POST['city']);

        $custom_area_id = ltrim($_POST['city'],"TONY_CUSTOM_AREA####");

        //$custom_area_id = $_REQUEST['custom_area'] ;

	if($custom_area_id>0){

		//echo "SELECT * from custom_areas where id = $custom_area_id where shape='rectangle'";

		$result_custom_area = mysqli_query($con,"SELECT * from custom_areas where id = $custom_area_id  ");

		if($result_custom_area && mysqli_num_rows($result_custom_area)>0){

			//echo "sadasdasd";

			$rs = mysqli_fetch_assoc($result_custom_area);

			$bounds = $rs['bounds'];

                        $polygon_path = $rs['path'];

			$lat_lng_query = $rs['lat_lng_query'] ;

			if(($bounds!='' || $polygon_path!='' ) && $lat_lng_query!=''){

				$where .= " and ".$lat_lng_query ;

			}

			//print_r($rs);

		}

	}



  }else{

      $where .= " AND `city` = '" . str_replace ( '-', ' ', $_REQUEST ['city'] ) . "'";

      $_GET ['city'] = $_REQUEST ['city'];

  }



}



// City

/*if(@$_REQUEST['city']!='') { $where .= " AND `city` = '".str_replace('-',' ',$_REQUEST['city'])."'"; $_GET['city']=$_REQUEST['city']; }*/



// Street

if(isset($_REQUEST['street'])) { $where .= " AND `street` = '".$_REQUEST['street']."'"; $_GET['street']=$_REQUEST['street']; }



// Zip

if(!empty($_REQUEST['zip'])) { $where .= " AND `zipcode` = '".$_REQUEST['zip']."'"; $_GET['zip']=$_REQUEST['zip'];}



// Price

if(preg_replace('/\D/','',@$_REQUEST['min_price'])) { $where .= " AND `price`>=".preg_replace('/\D/','',$_REQUEST['min_price']); $_GET['min_price']=$_REQUEST['min_price']; }

if(preg_replace('/\D/','',@$_REQUEST['max_price'])) { $where .= " AND `price`<=".preg_replace('/\D/','',$_REQUEST['max_price']); $_GET['max_price']=$_REQUEST['max_price']; }



// Beds

if(@$_REQUEST['beds']) { $_REQUEST['beds'] = str_replace('+','',$_REQUEST['beds']); }

if(@$_REQUEST['beds']>0) { $where .= " AND `beds`>=".preg_replace('/[^0-9\.]/','',$_REQUEST['beds']); $_GET['beds']=$_REQUEST['beds']; }



// Baths

if(@$_REQUEST['baths']) { $_REQUEST['baths'] = str_replace('+','',$_REQUEST['baths']); }

if(@$_REQUEST['baths']>0) { $where .= " AND `baths`>=".preg_replace('/[^0-9\.]/','',$_REQUEST['baths']); $_GET['baths']=$_REQUEST['baths']; }



//echo "<pre>";

if( isset($_REQUEST['custom_area']) && $_REQUEST['custom_area']!='' ){

	$custom_area_id = $_REQUEST['custom_area'] ;

	if($custom_area_id!=''){

		//echo "SELECT * from custom_areas where name = '$custom_area_id' ";exit;

                //echo "SELECT * from custom_areas where slug = '$custom_area_id' ";

		$result_custom_area = mysqli_query($con,"SELECT * from custom_areas where slug = '$custom_area_id'  ");

		if($result_custom_area && mysqli_num_rows($result_custom_area)>0){

			//echo "sadasdasd";//exit;

			$rs = mysqli_fetch_assoc($result_custom_area);

			$bounds = $rs['bounds'];

                        $polygon_path = $rs['path'];

			$lat_lng_query = $rs['lat_lng_query'] ;

			if(($bounds!='' || $polygon_path!='' ) && $lat_lng_query!=''){

				$where .= " and ".$lat_lng_query ;

			}

			//print_r($rs);

		}

	}

	//exit;

}



/*

echo "get: ";

print_r($_GET);

echo "<BR>";

*/



// SQFT

if(@$_REQUEST['size']>0)

{

 $where .= " AND `sqft`>=".$_REQUEST['size'];

 $_GET['size']=$_REQUEST['size'];

 if (!isset($_GET['sort'])) $_GET['sort'] = 'price_low';

}



// Premium Properties

if(!is_array(@$_REQUEST['special']))

{

 $specials = array(@$_REQUEST['special']);

 if(@$_REQUEST['special'])

 {

  $_GET['special']=$_REQUEST['special'];

 }

}

else

{

 $specials = @$_REQUEST['special'];

 if($specials)

 {

  $_GET['special']=$specials;

 }

}



foreach($specials as $special)

{

  $special = str_replace($SPECIALS_ARRAY, $SPECIALS_ORIG_ARRAY,$special);



 if(@$special==SPECIAL_ORIG_Premium) { $where .= " AND `price`>=600000"; }

 if(@$special==SPECIAL_ORIG_Golf) { $where .= " AND `community_features` LIKE '%Golf%'"; }

 if(@$special==SPECIAL_ORIG_Waterfront) { $where .= " AND `water_frontage`='Y'"; }

 if(@$special==SPECIAL_ORIG_Gated) { $where .= " AND `community_features` LIKE '%Gated%'"; }

 if(@$special==SPECIAL_ORIG_55_Communities) { $where .= " AND `housing_older_persons`!='' AND `housing_older_persons`!='N/A'"; }

 if(@$special==SPECIAL_ORIG_Pool) { $where .= " AND `pool`='Y'"; }

 if(@$special==SPECIAL_ORIG_Historical) { $where .= " AND `architectural_style` LIKE '%Historical%'"; }

 if(@$special==SPECIAL_ORIG_Horses) { $where .= " AND `community_features` LIKE '%Horse%'"; }

 if(@$special==SPECIAL_ORIG_Foreclosure) { $where .= " AND `special_sale_provision` !='' AND `special_sale_provision` !='None'"; }

 

 //reo

 if(@$special=="reo") { $where .= " AND `special_sale_provision` LIKE '%reo%'"; }

 //short sale

 if(@$special=="short-sale") { $where .= " AND `special_sale_provision` LIKE '%short sale%' "; }

}





// Year Built

if(@$_REQUEST['year_built_from']!='') { $where .= " AND `year_built`>=".preg_replace('/\D/','',$_REQUEST['year_built_from']); }

if(@$_REQUEST['year_built_to']!='') { $where .= " AND `year_built`<=".preg_replace('/\D/','',$_REQUEST['year_built_to']); $_GET['year_built_from']=$_REQUEST['year_built_from']; }



// County

if(@$_REQUEST['county']!='')

{

	$where .= " AND `county` LIKE '%". $_REQUEST['county']."%' ";

}



###################

# Sort Parameters #

###################

$orderby = "price DESC";



//if(@$_GET['sort']) { $_GET['sort']=$_REQUEST['sort']; }

if(@isset($_GET['sort'])) { $_GET['sort']=$_REQUEST['sort']; }

if(@$_GET['sort']=='price_high') { $orderby = "price DESC";  }

if(@$_GET['sort']=='price_low' || @$_GET['sort']=='') { $orderby = "price";  }

if(@$_GET['sort']=='newest') { $orderby = "listing_date DESC";  }

if(@$_GET['sort']=='bed') { $orderby = "beds DESC";  }

if(@$_GET['sort']=='bath') { $orderby = "baths DESC";  }

if(@$_GET['sort']=='sqft') { $orderby = "CONVERT( sqft, UNSIGNED INTEGER ) DESC";  }

if(@$_GET['sort']=='sqft_lo') { $orderby = "CONVERT( sqft, UNSIGNED INTEGER ) ";  }



//echo "sort:.$orderby";





/*

echo "get: ";

print_r($_GET);

echo "<BR>";

echo "<BR>request: ";

print_r($_REQUEST);

echo "<BR>";



print_r($sort);

*/



##############

# Pagination #

##############

$page = ( int ) (! isset ( $_REQUEST["page"] ) ? 1 : $_REQUEST["page"]);

if ($page <= 0)

	$page = 1;

$per_page = DEF_PAGINATION;

$startpoint = ($page * $per_page) - $per_page;





$sql_search = "SELECT * FROM $tbl_listings WHERE active='Y' $where ORDER BY $orderby limit {$startpoint} , {$per_page}";

$results = mysqli_query($con,$sql_search);

//echo $sql_search;

if ($results ===false || mysqli_num_rows($results)==0) {

	error_log('Sql query for false statement '.$sql_search);

	header("HTTP/1.0 404 Not Found");

}







// $sql_count = "SELECT count(id) as `count` FROM $tbl_listings WHERE active='Y' $where"; 

// $results = mysql_query($sql_count);

// $row = @mysql_fetch_assoc($results);

// $count = $row['count'];

// $targetpage = "/search-results.php";

// $pagination = pagination($count, DEF_PAGINATION);

// if ($count == 0) {

// 	header("HTTP/1.0 404 Not Found");

// }



// $sql_search = "SELECT * FROM $tbl_listings WHERE active='Y' $where ORDER BY $orderby LIMIT ".$pagination['limit'];

// $results = mysql_query($sql_search);



// if (mysql_num_rows($results)==0) { 

//     header("HTTP/1.0 404 Not Found");

// }



##################

# Include Header #

##################

$meta_pageno = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

$meta_title = empty($_REQUEST['zip']) ? 'Search Results - '.$title. ' '.$meta_pageno : 'Tampa Homes for Sale in '. $_REQUEST['zip'];

$meta_description = empty($_REQUEST['zip']) ? 'Search Result - '.$title. ', find real estate, new homes for sale, investment and preconstrucion properties, including single family homes, condos and townhomes in Tampa Bay '.$meta_pageno

: 'Homes for sale in Zip Code '.$_REQUEST['zip']. ' , new or existing condos and townhomes in zip code '.$_REQUEST['zip'];



include $path.'header.php';



#################

# Sort Selected #

#################

$href = '';

foreach($_GET as $k => $v)

{

 if($k!='sort')

 {

  if (is_array($v))

  { // this is to handle specials... :P

   foreach($v as $ak => $av)

   {

    $href .= '&'.strip_tags($k).'[]='.strip_tags($av);

   }

  }

  else

  {

   $href .= '&'.strip_tags($k).'='.strip_tags($v);

  }

 }

}

$href = trim($href,'&');

?>
<script>
function checkjQueryBeforeUse(){
	if(window.jQuery){
		jQuery('#sort').change(function()
		{

			var sort = jQuery(this).val();

			//'window.location = \'?'.$href.($href ? '&' : '').'sort=\'+sort;'.

			window.location = "https://<?php echo DEF_DOMAIN ?>/search-results.php?<?php echo $href?> <?php echo $href ? '&' : ''?>sort="+sort;
		});
		
	}

	setTimeout(function(){
		checkjQueryBeforeUse();
	}, 100);
	
}

checkjQueryBeforeUse();

</script>
<?php

########################

# Include Quick Search #

########################

include 'inc.search.php';

?>

<style>

.form-control

{

	height:34px;

}

</style>

<div class="container searchresultspage">

	<div class="row headerSearch">

		<div class="col-md-6">

			<h1 style="margin-bottom:10px;"><?=$title?></h1>

		</div>

		<div class="col-md-6">

			<span class="sortbytext">Sort By</span>

				<select id="sort" name="sort">

					 <option value="price_high"<?=dynField(@$sort,'price_high','option')?>>Price &#9660;</option>

					 <option value="price_low"<?=dynField(@$sort,'price_low','option')?>>Price &#9650;</option>

					 <option value="newest"<?=dynField(@$sort,'newest','option')?>>Newest</option>

					 <option value="bed"<?=dynField(@$sort,'bed','option')?>>Bed</option>

					 <option value="bath"<?=dynField(@$sort,'bath','option')?>>Bath</option>

					 <option value="sqft"<?=dynField(@$sort,'sqft','option')?>>Size &#9660;</option>

					 <option value="sqft_lo"<?=dynField(@$sort,'sqft_lo','option')?>>Size &#9650;</option>

				</select>

		</div>

	</div>

	

	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

			<!--Listing starts -->

			<?php

				####################

				# Display Listings #

				####################

				$are_listings = false;

				$listings= array();

				if ($results === false) {

					error_log('Sql query for boolean result'.$sql_search);

				}

				while($row=mysqli_fetch_assoc($results))

				{

					$href = ($row['manual']!='Y') ? '/'.str_replace(' ','-',$row['city']).'/'.$row['mls']  : '/result_newhome.php?id='.$row['id'];

					$img_file = ($row['manual']!='Y') ? substr($row['mls'],0,1).'/'.substr($row['mls'],1).'/' : 'manual/'.$row['id'].'/';

					$listings[]= '

							<div class="listing">

							    <div>

							        <a href="'.$href.'"><img class="listing_img" src="'.DEF_IMAGE_URL.'images/mls/'.$img_file.'preview.jpg" width="220" height="166" alt=""/></a>

							    </div>

				

							      <div class="listing_info">

					

					

							    	<div class="row">

										<div class="col-md-12">

										        <div class="row"><div class="col-md-12"><div class="listing_amount">$'.number_format($row['price']).'</div></div></div>

					

    											<div class="row">

    												<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

		    											<div class="listing_city">'.$row['city'].', '.$row['state'].'</div>

													</div>

													<div class="col-xs-6 col-sm-12 col-md-2 col-lg-2 text-right visible-lg visible-md visible-sm hidden-xs">

												        <a class="listing_round" href="'.$href.'"><img alt="round" src="/images/listing_round.png"/></a>

													</div>

										        </div>

					

												<div class="row"><div class="col-md-12"><div class="listing_hr visible-inline-lg visible-inline-md visible-inline-sm hidden-xs"></div></div></div>

					

														<div class="row visible-inline-lg visible-inline-md visible-inline-sm hidden-xs">

															<div class="listing_bottom">

																<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">

																		<img alt="bed" class="listing_bottom_imgs" src="/images/listing_bed.png">	

																			'.$row['beds'].' '.translation('beds').'

																			

																</div>

																<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 listings_bottom_noright_padding">

																	<img alt="bath" class="listing_bottom_imgs" src="/images/listing_bath.png">

																	'.($row['baths']*1).' '.translation('baths').'

																				

																</div>

															</div>

														</div>

					

										</div>

									</div>

					

					

							      </div>

							</div>

					';

					$are_listings = true;

				}

				if(count($listings) > 0)

				{

						

					echo "<div class='row'>";

				

					for($j=0; $j < count($listings); $j++)

					{

					echo "<div class='col-xs-6 col-sm-4 col-md-4 col-lg-4 listing_col'>";

							echo $listings[$j];

							echo "</div>";

				

					}

					echo "</div>";

					}				

				

				if(!$are_listings) {

					echo '<div class="b" style="margin-top:15px;">No results found, <a href="/property-search.php">try another search</a>.</div>';

				}

			?>

			<!--Listing ends -->

			<!--Pagination -->

			<div class="text-center">	

				<?php

				if($are_listings)

					echo pagination_new("$tbl_listings WHERE active='Y' $where",$per_page, $page, '/search-results.php?',$con) ?>			

			</div>

			<!--Pagination Ends-->

		</div>

		

		<!--Side bar without form -->

		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

			<?php include "sidebar-without-form.php"?>

		</div>

	</div>

</div>



<?php

include $path.'elongationFix.php';

include $path . 'banner-ad.php';

##################

# Include Footer #

##################

include $path.'footer.php';

?>