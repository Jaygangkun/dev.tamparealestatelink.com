<?php
/*
The title function of the search results.

There are two further title files. One is for english, the other for spanish.
I have put them in different files so they can be easily compared..
if there is a title upgrade, it will be easier to see what to change in the other one if it can be compred a bit easyer. 

*/
function getSearchTitle($request)
{
	require(dirname(__FILE__).'/../config.php');
	global $SPECIALS_ORIG_ARRAY, $SPECIALS_ARRAY,$types_orig, $types;
	$title = "";

	//print_r($request);

	// make sure remove city from 'special' if it is in the 'city' as well.	 
	//if (@$request['special'] == @$request['city']) {
	if (isset($request['special']) && isset($request['city']) && $request['special'] == $request['city']) {
		unset($request['special']);
	}
	//if (empty(@$request['city'])) {
	if (isset($request['city']) && empty($request['city'])) {
		unset($request['city']);
	}
	
	//echo "<br>";
	//print_r($request);
	
	if (DEF_TRANLATION_LANG == "english") {
		// english 
		include 'common.title.en.php';
	}
	else
	{
		// spanish
		include 'common.title.sp.php';
	}

	$search  = array();
	$replace = array();
	
	$search[] = 'Casa ';
	$replace[] = 'Casas ';

	$search[] = 'Apartamento ';
	$replace[] = 'Apartamentos ';

	$search[] = 'Single family en ';
	$replace[] = 'Casas Unifamiliares en ';

	$search[] = 'Single family in ';
	$replace[] = 'Single Family Homes in ';
	
	$search[] = 'home ';
	$replace[] = 'Homes ';
    
    $search[] = 'Condos _Townhomes';
    $replace[] = 'Condos and Townhomes';
	
	$title = str_replace($search,$replace,$title);
 
 return $title;
}

?>
