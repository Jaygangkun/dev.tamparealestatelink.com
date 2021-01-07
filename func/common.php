<?php

/*

Common functions used all round the system.

*/

####################

# Translation Func #

####################

function translation($str,$capitalize=false,$fulltext=false)

{

require(dirname(__FILE__).'/../config.php');
 global $tbl_translation;





 //if(!@$_COOKIE['language'] || @$_COOKIE['language']=='english') { return $str; }

 if(!@DEF_TRANLATION_LANG || @DEF_TRANLATION_LANG=='english') { return $str; }

 elseif(!$fulltext)

 {

  $results = mysqli_query($con,"SELECT `".mysqli_real_escape_string($con,DEF_TRANLATION_LANG)."` FROM $tbl_translation WHERE `english`='".mysqli_real_escape_string($con,$str)."' LIMIT 1");

  $row = mysqli_fetch_array($results);

  $word = $row[(mysqli_real_escape_string($con,DEF_TRANLATION_LANG))];

  if(!$word) { return $str; }

  return ($capitalize) ? ucwords($word) : $word;

 }

 else

 {

  /*

  $return_str = '';

  $words = str_word_count(str_replace(',',' commacommacomma ',str_replace('/',' slashslashslash ',str_replace('.',' dotdotdot ',$str))),1);

  //$no_key = 'na';

  foreach($words as $k => $word)

  {

  //echo '<br>'.$no_key.'='.$k;

  //if($no_key!=$k || $k==0)

  //{

  //echo '=----test';

   if($word!='commacommacomma' && $word!='dotdotdot' && $word!='slashslashslash')

   {

    $result_count = 0;

    $result_arr = array();

    $results = mysqli_query($con,"SELECT `english`, `".mysqli_real_escape_string($con,DEF_TRANLATION_LANG)."` FROM $tbl_translation WHERE `english` LIKE '%".mysqli_real_escape_string($con,$word)."%'");

	while($row=mysqli_fetch_array($results))

	{

     $result_arr[] = $row;

     $result_count++;

	}

	$language = mysqli_real_escape_string($con,DEF_TRANLATION_LANG);

	// One Result For Word

	if($result_count==1)

	{

	 $row = $result_arr[0];

	 $return_str .= $row[$language];

	}

	// More Than One Result For Word

	elseif($result_count>1)

	{

	 $fallback = $word;

	 $found_translation = false;

	 $word_translated = '';

	 foreach($result_arr as $k2 => $row)

	 {

	  $wordBefore = @$words[($k-1)];

	  $wordAfter = @$words[($k+1)];

	  if($row['english']==strtolower($wordBefore).' '.strtolower($word) && !$found_translation)

	  {

	   $return_str = str_replace_last($wordBefore_translated,'',$return_str).' '.$row[$language];

	   $word_translated = $row[$language];

	   $found_translation = true;

	  }

	  elseif($row['english']==strtolower($word).' '.strtolower($wordAfter) && !$found_translation)

	  {

	   $return_str .= ' '.$row[$language];

	   $word_translated = $row[$language];

	   //$no_key = $k+1;

	   //if(isset($words[($k+1)])) { @unset($words[($k+1)]); }

	   $found_translation = true;

	  }

	  elseif($row['english']==strtolower($word)) {	$fallback = $row[$language]; }

	 }

	 if(!$found_translation) { $return_str .= ' '.$fallback;  $word_translated = $row[$language]; }

	 $wordBefore_translated = $word_translated;

	}

	// No Results

	else { $return_str .= ' '.$word; $wordBefore_translated = $word; }

   }

   else

   {

    switch($word)

	{

	 case 'commacommacomma':

	  $return_str .= ', ';

	  break;

	 case 'slashslashslash':

	  $return_str .= '/';

	  break;

	 case 'dotdotdot':

	  $return_str .= '. ';

	  break;

	}

   }

  }

  return ltrim($return_str,' ');

  */

  $return_str = '';

  //$words = str_word_count(str_replace(',',' commacommacomma ',str_replace('/',' slashslashslash ',str_replace('.',' dotdotdot ',$str))),1);

  $words = explode(',', $str);



  $result_words = array();

  //print_r($words);

  foreach($words as $k => $word)

  {

     $result_count = 0;

   $result_arr = array();



   $results = mysqli_query($con,"SELECT `english`, `".mysqli_real_escape_string($con,DEF_TRANLATION_LANG)."` FROM $tbl_translation WHERE `english` = '".mysqli_real_escape_string($con,$word)."' limit 0,1;");

   while($row=mysqli_fetch_array($results))

   {

	$result_arr[] = $row;

	$result_count++;

   }



   $language = mysqli_real_escape_string($con,DEF_TRANLATION_LANG);



   // Only one result

   if($result_count==1)

   {

	$row = $result_arr[0];

	$return_str .= $row[$language];

	// print_r("#".$row[$language]."#");

	$return_str .=', ';

	//print_r("+".$return_str."+");

   }



   // More Than One Result For Word

   elseif($result_count>1)

   {

	 foreach($result_arr as $k2 => $row)

	 {

	  if (str_len(trim($row[$language]))==0) {

	   $return_str .= $row['english'];

	  } else {



	   $return_str .= $row[$language];

	  }

	  $return_str .=', ';

	 }

	}

	// No Results (not found on Ttanslation DB

	#Ricardo: I commented out the last 3 lines so if the feature is not in the Translation DB it does not show it

	//else {

	//   $return_str .= $word.', ';

	//   }

   }

   if (strlen($return_str) > 0) {

	$return_str = substr($return_str,0,-2);

   }



   return $return_str; //ltrim($return_str,' ');

  }

 //}

}







###################################

# Translation of hte descriptions #

###################################

function translation_description($str,$capitalize=false,$fulltext=true)

{
require(dirname(__FILE__).'/../config.php');
 global $tbl_translation;



 if(!@DEF_TRANLATION_LANG || @DEF_TRANLATION_LANG=='english')

 {

  return $str;

 }

 else

 {

  $return_str = '';

  //$words = str_word_count(str_replace(',',' commacommacomma ',str_replace('/',' slashslashslash ',str_replace('.',' dotdotdot ',$str))),1);

  $words = explode(',', $str);



  $result_words = array();

  //print_r($words);

  foreach($words as $k => $word)

  {

   $result_count = 0;

   $result_arr = array();



   $results = mysqli_query($con,"SELECT `english`, `".mysqli_real_escape_string($con,DEF_TRANLATION_LANG)."` FROM $tbl_translation WHERE `english` = '".mysqli_real_escape_string($con,$word)."' limit 0,1;");

   while($row=mysqli_fetch_array($results))

   {

	$result_arr[] = $row;

	$result_count++;

   }



   $language = mysqli_real_escape_string($con,DEF_TRANLATION_LANG);



   // Only one result

   if($result_count==1)

   {

	$row = $result_arr[0];

	$return_str .= $row[$language];

	$return_str .=', ';

   }



   // More Than One Result For Word

   elseif($result_count>1)

   {

	 foreach($result_arr as $k2 => $row)

	 {

	  if (str_len(trim($row[$language]))==0) {

	   $return_str .= $row['english'];

	  } else {

	   $return_str .= $row[$language];

	  }

	  $return_str .=', ';

	 }

	}

	// No Results

	else { $return_str .= $word.', ';}

   }

  }



  if (strlen($return_str) > 0) {

   $return_str = substr($return_str,0,-2);

  }

  return $return_str; //ltrim($return_str,' ');

}



###########################

# Replace Last Occurrence #

###########################

    function str_replace_last( $search , $replace , $str ) {

        if( ( $pos = strrpos( $str , $search ) ) !== false ) {

            $search_length  = strlen( $search );

            $str    = substr_replace( $str , $replace , $pos , $search_length );

        }

        return $str;

    }





###################

# Change Language #

###################

/*

if(isset($_REQUEST['language']))

{

 setcookie('language',strip_tags($_REQUEST['language']),time()+2592000);

 $_COOKIE['language']  = $_REQUEST['language'];

}

*/



function getDescription(){

	global $public_remarks_new, $public_remarks_new_esp, $public_remarks_new_por;



	$description = "";

	switch(DEF_TRANLATION_LANG){

	case "english": $description = $public_remarks_new; break;

	case "spanish": $description = $public_remarks_new_esp; break;

	case "portuguese": $description = $public_remarks_new_por; break;

	}



	if($description == "") {

		$description = $public_remarks_new;

	}

	return $description;

}



function getHeadline(){

	global $headline, $headline_esp, $headline_por;

	$headl = "";

	switch(DEF_TRANLATION_LANG){

		case "english": $headl = $headline; break;

		case "spanish": $headl = $headline_esp; break;

		case "portuguese": $headl = $headline_por; break;

		default: $headl = $headline; break;

	}



	if($headl == "") {

		$headl = $headline;

	}

	return $headl;

}





function listImages($img_dir) {



 $imgs = array();

 if(is_dir($img_dir))

 {

  if($dh = opendir($img_dir))

  {

   while(($file=readdir($dh))!==false)

   {

	$file_check = strtolower($file);

	if((substr($file_check,-4)=='.jpg' ||

		substr($file_check,-5)=='.jpeg' ||

		substr($file_check,-4)=='.png')

	   &&

	   $file_check!='preview.jpg'

	   &&

	   $file_check!='1.orig.jpg'

	   )

	{

	 $imgs[$file] = $file;

	}

   }

   closedir($dh);

  }

 }

 $i = 0;

 natsort($imgs);

 return $imgs;

}



function listImagesPreview($img_dir)

{

 $imgs = array();

 if(is_dir($img_dir))

 {

  if($dh = opendir($img_dir))

  {

   while(($file=readdir($dh))!==false)

   {

	if(substr($file,-4)=='.jpg'

	   &&

	   $file!='preview.jpg'

	   &&

	   $file!='1.orig.jpg')

	{

		$imgs[$file] = $file;

	}

   }

   closedir($dh);

  }

 }

 return $imgs;

}



/*

 function getSearchTitle($request)



 This function handles the titles above the seach resuls.

 There are plenty of copies of the system.

 For easier copying, the function was put into a separate file, so if fixed one place

 can be copied to other versions, instead of timely merge procedure.



*/

include 'common.title.php';





function Array_function_xxx($headline, $fields) {

    $field_values = array_values($fields);

    foreach ($field_values as $field_value) {

        if (strpos($headline, $field_value) !== false) {

            return true; // field value found in a string

        }

    }

    return false; // nothing found during the loop

}





###############

# Pageination #

###############

if(!function_exists('pagination'))

{

function pagination($count,$limit=21,$stages=3)

{

 ###############

 # ALTER TABLE `bir_listings` ADD `public_remarks_new_por` TEXT NOT NULL AFTER `public_remarks_new`, ADD `public_remarks_new_esp` TEXT NOT NULL AFTER `public_remarks_new_por`; Vars #

 ###############

 global $appDir,$targetpage;

 if(!@$targetpage) { $targetpage = ''; }

 $page = (!is_numeric(@$_GET['page']) || @$_GET['page']==0) ? 1 : $_GET['page'];

 $start = ($page && $page!=1) ? ($page - 1) * $limit : 0;

 $prev = $page - 1;

 $next = $page + 1;

 $lastpage = ceil($count/$limit);

 $LastPagem1 = $lastpage - 1;

 $more = '';



 #############

 # Get Vars #

 #############

 $get = '';

 foreach($_GET as $k => $v)

 {

  if($k!='page' && $k!='errMess' && $k!='succMess')

  {

  	if (!is_array($v))

  	{

	   $get .= '&'.$k.'='.$v;

  	}

  	else {

		foreach($v as $v_k => $v_v)

		{

			$get .= '&'.$k.'[]='.$v_v;

		}

  	}

  }

 }



 ##############

 # Create Nav #

 ##############

 $paginate = '';

    if($lastpage > 1)

    {



        $paginate .= "<div class='paginate'>";

        // Previous

        if ($page > 1){

            $paginate.= '<a href="'.$targetpage.'?page='.$prev.$get.'"><img class="pagination_lt" src="/images/pagination-arrow-left.png" width="8" height="12" alt="">PREV</a>';

            //$paginate.= '<a href="'.$targetpage.'?page='.$prev.$get.'"><img class="pagination_lt" src="/images/pagination-arrow-left.png" width="8" height="12" alt="">Anterior</a>';

        }else{

            //$paginate.= '<span class="disabled"><img class="pagination_lt" src="images/pagination-arrow-left.png" width="8" height="12" alt=""></span>';

			 }







        // Pages

        if ($lastpage < 7 + ($stages * 2))   // Not enough pages to breaking it up

        {

            for ($counter = 1; $counter <= $lastpage; $counter++)

            {

                if ($counter == $page){

                    $paginate.= " <span class='current'>$counter</span>";

                }else{

                    $paginate.= " <a href='$targetpage?page=$counter$get'>$counter</a>";}

            }

        }

        elseif($lastpage > 5 + ($stages * 2))    // Enough pages to hide a few?

        {

            // Beginning only hide later pages

            if($page < 1 + ($stages * 2))

            {

                for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

                {

                    if ($counter == $page){

                        $paginate.= " <span class='current'>$counter</span>";

                    }else{

                        $paginate.= " <a href='$targetpage?page=$counter$get'>$counter</a>";}

                }

                $paginate.= " <span class='dots'>...</span>";

                $paginate.= " <a href='$targetpage?page=$LastPagem1$get'>$LastPagem1</a>";

                $paginate.= " <a href='$targetpage?page=$lastpage$get'>$lastpage</a>";

            }

            // Middle hide some front and some back

            elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

            {

                $paginate.= " <a href='$targetpage?page=1$get'>1</a>";

                $paginate.= " <a href='$targetpage?page=2$get'>2</a>";

                $paginate.= " <span class='dots'>...</span>";

                for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

                {

                    if ($counter == $page){

                        $paginate.= " <span class='current'>$counter</span>";

                    }else{

                        $paginate.= " <a href='$targetpage?page=$counter$get'>$counter</a>";}

                }

                $paginate.= " <span class='dots'>...</span>";

                $paginate.= " <a href='$targetpage?page=$LastPagem1$get'>$LastPagem1</a>";

                $paginate.= " <a href='$targetpage?page=$lastpage$get'>$lastpage</a>";

            }

            // End only hide early pages

            else

            {

                $paginate.= " <a href='$targetpage?page=1$get'>1</a>";

                $paginate.= " <a href='$targetpage?page=2$get'>2</a>";

                $paginate.= " <span class='dots'>...</span>";

                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

                {

                    if ($counter == $page){

                        $paginate.= " <span class='current'>$counter</span>";

                    }else{

                        $paginate.= " <a href='$targetpage?page=$counter$get'>$counter</a>";}

                }

            }

        }



                // Next

        if ($page < $counter - 1){

            $paginate.= ' <a href="'.$targetpage.'?page='.$next.$get.'">NEXT<img class="pagination_rt" src="/images/pagination-arrow-right.png" width="8" height="12" alt=""></a>';

		    $more = " <a class='more_link' href='$targetpage?page=$next$get'><img class='blue_icon' src='".$appDir."images/icons/blue-more.png' alt=''> More...</a>";

            //$paginate.= ' <a href="'.$targetpage.'?page='.$next.$get.'">Siguiente<img class="pagination_rt" src="/images/pagination-arrow-right.png" width="8" height="12" alt=""></a>';

			//$more = " <a class='more_link' href='$targetpage?page=$next$get'><img class='blue_icon' src='".$appDir."images/icons/blue-more.png' alt=''> More...</a>";

        }else{

            //$paginate.= ' <span class="disabled dots"><img class="pagination_rt" src="images/pagination-arrow-right.png" width="8" height="12" alt=""></span>';

            }



        $paginate.= "</div>";





}



 return array(

  'nav' => $paginate,

  'more' => $more,

  'limit' => $start.','.$limit,

 );

}

}



############################

# Dynamic Form Fields Func #

############################

if(!function_exists('dynField'))

{

 function dynField($option,$value,$type, $ret_string = false)

 {

  if (!$ret_string) {

   if($type=='checkbox' && @in_array($value,$option))

   {

	echo ' CHECKED'; return;

   }

   if($option==$value)

   {

	if($type=='option') { echo ' SELECTED'; }

	if($type=='radio') { echo ' CHECKED'; }

   }

  } else {

   if($type=='checkbox' && @in_array($value,$option))

   {

	return ' CHECKED';

   }

   if($option==$value)

   {

	if($type=='option') { return ' SELECTED'; }

	if($type=='radio') { return ' CHECKED'; }

   }

  }

 }

}





####################

# Capitalize Names #

####################

if(!function_exists('ucwords2'))

{

function ucwords2($string)

{

	$word_splitters = array(' ', '-', "O'", "L'", "D'", 'St.', 'Mc');

	$lowercase_exceptions = array('the', 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'of', 'and', "l'", "d'");

	$uppercase_exceptions = array('III', 'IV', 'VI', 'VII', 'VIII', 'IX');



	$string = strtolower($string);

	foreach ($word_splitters as $delimiter)

	{

		$words = explode($delimiter, $string);

		$newwords = array();

		foreach ($words as $word)

		{

			if (in_array(strtoupper($word), $uppercase_exceptions))

				$word = strtoupper($word);

			else

			if (!in_array($word, $lowercase_exceptions))

				$word = ucfirst($word);



			$newwords[] = $word;

		}



		if (in_array(strtolower($delimiter), $lowercase_exceptions))

			$delimiter = strtolower($delimiter);



		$string = join($delimiter, $newwords);

	}

	return $string;

}

}



######################

# Convert SQFT to M2 #

######################

if(!function_exists('sqft2m2'))

{

function sqft2m2($sqft)

{

 return $sqft / 10.764;

}

}



######################

# New Pagination     #

######################

function pagination_new($query, $per_page = 10, $page = 1, $url = '?',$con) {
require(dirname(__FILE__).'/../config.php');


	#############

	# Get Vars #

	#############

	$get = '';

	foreach($_GET as $k => $v)

	{

		if($k!='page' && $k!='errMess' && $k!='succMess')

		{

			if (!is_array($v))

			{

				$get .= $k.'='.$v.'&';

			}

			else {

				foreach($v as $v_k => $v_v)

				{

					$get .= ''.$k.'[]='.$v_v.'&';

				}

			}

		}

	}



	$url .= $get;



	$query = "SELECT COUNT(*) as `num` FROM {$query}";

	$row = mysqli_fetch_array ( mysqli_query ( $con,$query ) );

	$total = $row ['num'];

	$adjacents = "2";



	$prevlabel = "PREV";

	$nextlabel = "NEXT";

	$lastlabel = "LAST &rsaquo;&rsaquo;";



	$page = ($page == 0 ? 1 : $page);

	$start = ($page - 1) * $per_page;



	$prev = $page - 1;

	$next = $page + 1;



	$lastpage = ceil ( $total / $per_page );



	$lpm1 = $lastpage - 1; // //last page minus 1



	$pagination = "";

	if ($lastpage > 1) {

		$pagination .= "<ul class='paginationnew'>";

		// $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";



		if ($page > 1)

			$pagination .= "<li><a href='{$url}page={$prev}'><img class='pagination_lt' src='/images/pagination-arrow-left.png' width='8' height='12' alt=''>{$prevlabel}</a></li>";



		if ($lastpage < 7 + ($adjacents * 2)) {

			for($counter = 1; $counter <= $lastpage; $counter ++) {

				if ($counter == $page)

					$pagination .= "<li><a class='current'>{$counter}</a></li>";

				else

					$pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";

			}

		} elseif ($lastpage > 5 + ($adjacents * 2)) {



			if ($page < 1 + ($adjacents * 2)) {



				for($counter = 1; $counter < 4 + ($adjacents * 2); $counter ++) {

					if ($counter == $page)

						$pagination .= "<li><a class='current'>{$counter}</a></li>";

					else

						$pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";

				}

				$pagination .= "<li class='dot'>...</li>";

				$pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";

				$pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

			} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {



				$pagination .= "<li><a href='{$url}page=1'>1</a></li>";

				$pagination .= "<li><a href='{$url}page=2'>2</a></li>";

				$pagination .= "<li class='dot'>...</li>";

				for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter ++) {

					if ($counter == $page)

						$pagination .= "<li><a class='current'>{$counter}</a></li>";

					else

						$pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";

				}

				$pagination .= "<li class='dot'>..</li>";

				$pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";

				$pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

			} else {



				$pagination .= "<li><a href='{$url}page=1'>1</a></li>";

				$pagination .= "<li><a href='{$url}page=2'>2</a></li>";

				$pagination .= "<li class='dot'>..</li>";

				for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter ++) {

					if ($counter == $page)

						$pagination .= "<li><a class='current'>{$counter}</a></li>";

					else

						$pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";

				}

			}

		}



		if ($page < $counter - 1) {

			$pagination .= "<li><a href='{$url}page={$next}'>{$nextlabel}<img class='pagination_lt' src='/images/pagination-arrow-right.png' width='8' height='12' alt=''></a></li>";

			// $pagination .= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";

		}



		$pagination .= "</ul>";

	}



	return $pagination;

}

?>
