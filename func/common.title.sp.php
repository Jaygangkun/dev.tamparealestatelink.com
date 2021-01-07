<?php
/*
The spanish title

This builds up the title for the spanish sites
*/
//New title logic builds the title from left to right, as you would read it, for simplicity.
//Start by adding "Browse " to the title if no location parameters (city/zip) are set.
if (!(isset($request['zip']) && !empty($request['zip'])) && !(isset($request['city']) && strlen($request['city']) > 0)) {
    $title .= "Buscar ";
}

//Next, add the type of property to title.
if (isset($request['type']) && !(empty($request['type']) || $request['type'] == TYPE_ANY)) {
    $types_to_replace_to=array("Townhome ","Townhome ","Townhome ","Townhome y Apartamentos ","Townhome y Apartamentos ","Townhome y Apartamentos ","Apartamentos ","Apartamentos ","Casas Unifamiliares ","Casas Unifamiliares ");
    //having two replace statements is probably redundant but will keep as a failsafe
    $request['type'] = str_replace($types_orig, $types_to_replace_to,$request['type']);
    $request['type'] = str_replace($types, $types_to_replace_to,$request['type']);
    $title .= $request['type'];
}
else {
    $title .= "Casas ";
}

//add single family homes by URL
/*if (strpos($_SERVER['REQUEST_URI'],'casas_unifamiliares') !== false) {
    $title .= "Unifamiliares ";
}*/

$specials_added = 0;
//Handle "luxury Homes", "antique homes" and "waterfront homes" url result page
if (strpos($_SERVER['REQUEST_URI'],'Propiedades-de-Lujo') !== false) {
    $title .= "Lujosas ";
}
else if (strpos($_SERVER['REQUEST_URI'],'Antiguas') !== false) {
    $title .= "Antiguas ";
}
else if (strpos($_SERVER['REQUEST_URI'],'Con-Vista-Al-Agua') !== false) {
    $title .= "con Vista al Agua ";
}
//Next, add Foreclosure or Waterfront to title.
else if (isset($request['special']) && !empty($request['special'])) {
    foreach($request['special'] as $key => $value) {
        if ($value == SPECIAL_Waterfront || $value == "Waterfront-Homes") {
            $title .= "con Vista al Agua ";
            $specials_added = $specials_added + 1;
        }
        if ($value == SPECIAL_Foreclosure) {
            $title .= "en Remate ";
            $specials_added = $specials_added + 1;
        }
    } 
}

//Next, add any other special conditions to the title. 
if (isset($request['special']) && !empty($request['special'])) {
    $specials_to_replace_to=array("para Mayores de Edad ", "en Comunidades Privadas ", "cerca de Campos de Golf ", "", "en Comunidades Ecuestres ", "con Piscina ", "", "", "");
    $request['special'] = str_replace($SPECIALS_ORIG_ARRAY, $specials_to_replace_to, $request['special']);
    //This iterates through all special conditions selected by user and adds them to the title till the limit of special conditions is reached.
    foreach($request['special'] as $key => $value) {
        $specials_added = $specials_added + 1;
        if ($specials_added < 3) { //THIS VALUE-1 IS THE MAX NUMBER OF SPECIAL CONDITIONS THAT WILL BE ADDED TO THE TITLE. Ex: '$times_run < 3' will add up to TWO specials to the title, i.e. "Homes in 55+ Communities with a Pool"
            $title .= $value;
        }
    }
}

//handle specials when visiting search results via a footer link.
if (strpos($_SERVER['REQUEST_URI'],'Campo-de-Golf') !== false) {
    $title .= "cerca de Campos de Golf ";
}
if (strpos($_SERVER['REQUEST_URI'],'Con-Piscina') !== false) {
    $title .= "con Piscina ";
}
if (strpos($_SERVER['REQUEST_URI'],'Ecuestres') !== false) {
    $title .= "en Comunidades Ecuestres ";
}
if (strpos($_SERVER['REQUEST_URI'],'Con-Vigilancia-Privada') !== false) {
    $title .= "en Comunidades Privadas ";
}
if (strpos($_SERVER['REQUEST_URI'],'para-personas-mayores') !== false) {
    $title .= "para Mayores de Edad ";
}

$title .= "en ";

//Next, add city OR zip code to title. Prioritize Zip Code.
if (isset($request['zip']) && !empty($request['zip'])) {
    $title .= "el Código Postal ". $request['zip'];
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