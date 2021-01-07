<?php

/*
The english title

This builds up the title for the english sites
*/
//New title algorithm builds the title from left to right, as you would read it, for simplicity.
//Start by adding "Browse " to the title if no location parameters (city/zip) are set.


if (!(isset($request['zip']) && !empty($request['zip'])) && !(isset($request['city']) && strlen($request['city']) > 0)) {
    $title .= "Browse ";
}

//Next, add Foreclosure or Waterfront to title.
if (isset($request['special']) && !empty($request['special']) && is_array($request['special'])) {
    foreach($request['special'] as $key => $value) {
        if ($value == SPECIAL_Waterfront) {
            $title .= "Waterfront ";
        }
        if ($value == SPECIAL_Foreclosure) {
            $title .= "Foreclosure ";
        }
    }
}
//Handle "luxury Homes" and 'waterfront homes' url result page
if (strpos($_SERVER['REQUEST_URI'],'Premium-Properties') !== false) {
    $title .= "Luxury ";
}
if (strpos($_SERVER['REQUEST_URI'],'Waterfront-Homes') !== false) {
    $title .= "Waterfront ";
}

//Next, add the type of property to title.
if (isset($request['type']) && !(empty($request['type']) || $request['type'] == TYPE_ANY)) {
    $types_to_replace_to=array("Townhomes ","Townhomes ","Townhomes ","Condos and Townhomes ","Condos and Townhomes ","Condos and Townhomes ","Condos ","Condos ","Single Family Homes ","Single Family Homes ");
    //having two replace statements is probably redundant but will keep as a failsafe
    $request['type'] = str_replace($types_orig, $types_to_replace_to,$request['type']);
    $request['type'] = str_replace($types, $types_to_replace_to,$request['type']);
    $title .= $request['type'];
}
else {
    $title .= "Homes ";
}

//Next, add any special conditions to the title.
if (isset($request['special']) && !empty($request['special'])) {
    $specials_to_replace_to=array("in 55+ Communities ", "in Gated Communities ", "near Golf Courses ", "", "in Equestrian Communities ", "with a Pool ", "", "", "");
    $request['special'] = str_replace($SPECIALS_ORIG_ARRAY, $specials_to_replace_to, $request['special']);
    //This iterates through all special conditions selected by user and adds them to the title till the limit of special conditions is reached.
    $times_run = 0;
    if (isset($request['special']) && !empty($request['special']) && is_array($request['special'])) {
        foreach($request['special'] as $key => $value) {
            $times_run = $times_run + 1;
            if ($times_run < 3) { //THIS VALUE-1 IS THE MAX NUMBER OF SPECIAL CONDITIONS THAT WILL BE ADDED TO THE TITLE. Ex: '$times_run < 3' will add up to TWO specials to the title, i.e. "Homes in 55+ Communities with a Pool"
                $title .= $value;
            }
        }    
    }
}

//handle specials when visiting search results via a footer link.
if (strpos($_SERVER['REQUEST_URI'],'55-Communities') !== false && !strpos($title, '55-Communities')   ) {
    $title .= "in 55+ Communities ";
}
if (strpos($_SERVER['REQUEST_URI'],'Golf-Courses') !== false && !strpos($title, 'Golf Courses') )  {
    $title .= "near Golf Courses ";
}
if (strpos($_SERVER['REQUEST_URI'],'Pool') !== false && !strpos($title, 'with a Pool') ) {
    $title .= "with a Pool ";
}
if (strpos($_SERVER['REQUEST_URI'],'Horses') !== false && !strpos($title, 'Equestrian Communities') ) {
    $title .= "in Equestrian Communities ";
}
if (strpos($_SERVER['REQUEST_URI'],'Gated-Community') !== false && !strpos($title, 'Gated Communities') ) {
    $title .= "in Gated Communities ";
}

$title .= "in ";

//Next, add city OR custom area OR zip code to title. Prioritize Zip Code.
if (isset($request['zip']) && !empty($request['zip'])) {
    $title .= "Zip Code ". $request['zip'];
}
else if (isset($request['city']) && strlen($request['city']) > 0) {
    if (strpos($request['city'], 'TONY_CUSTOM_AREA####') !== false) {
        $custom_area_id = ltrim($request['city'],"TONY_CUSTOM_AREA####");
        if ($custom_area_id>0) {
            $result_custom_area = mysqli_query($con,"SELECT * from custom_areas where id = $custom_area_id  ");
            if ($result_custom_area && mysqli_num_rows($result_custom_area) > 0) {
                $rs = mysqli_fetch_assoc($result_custom_area);
                $title .= ucwords($rs['name']);
            }
        }
    }
    else {
        $title .= ucwords(str_replace('-',' ',$request['city']));
    }
}
else if (isset($request['custom_area']) && strlen($request['custom_area']) > 0 ) {
    $title .= ucfirst(str_replace('-',' ',$request['custom_area']));
}
else {
    $title .= DEF_OFFICE_CITY;
}
?>
