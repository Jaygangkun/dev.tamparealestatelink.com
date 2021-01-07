<?php
/*
There are different rewrite values that need to be interpreted and used (../rewrite_handler.php).

This file holds the constants for the title building, so it can be done easier.
*/
if(DEF_TRANLATION_LANG == "english"){

 define('TYPES_townhomes', 'townhomes');
 define('TYPES_condo', 'condo');
 define('TYPES_condos', 'condos');
 define('TYPES_single_family', 'single_family_home');

 define('FIELDS_city', 'city');
 define('FIELDS_zip', 'zip');
 define('FIELDS_mls', 'mls');
 define('FIELDS_type', 'type');
 
 define('SPECIAL_55_Communities', '55-Communities');
 define('SPECIAL_Gated', 'Gated-Community');
 define('SPECIAL_Golf', 'Golf-Courses');
 define('SPECIAL_Historical', 'Historical-Homes');
 define('SPECIAL_Horses', 'Horses');
 define('SPECIAL_Pool', 'Pool');
 define('SPECIAL_Premium', 'Premium-Properties');
 define('SPECIAL_Waterfront', 'Waterfront-Homes');

} else {
 
 
 define('TYPES_townhomes', 'townhomes');
 define('TYPES_condo', 'apartamento');
 define('TYPES_condos', 'apartamentos');
 define('TYPES_single_family', 'casas_unifamiliares');

 define('FIELDS_city', 'ciudad');
 define('FIELDS_zip', 'codigo-postal');
 define('FIELDS_mls', 'mls');
 define('FIELDS_type', 'type');
 
 define('SPECIAL_55_Communities', 'para-personas-mayores');
 define('SPECIAL_Gated', 'Con-Vigilancia-Privada');
 define('SPECIAL_Golf', 'Campo-de-Golf');
 define('SPECIAL_Historical', 'Antiguas');
 define('SPECIAL_Horses', 'Ecuestres');
 define('SPECIAL_Pool', 'Con-Piscina');
 define('SPECIAL_Premium', 'Propiedades-de-Lujo');
 define('SPECIAL_Waterfront', 'Con-Vista-Al-Agua');
 
}

 define('SPECIAL_ORIG_55_Communities', '55-Communities');
 define('SPECIAL_ORIG_Gated', 'Gated-Community');
 define('SPECIAL_ORIG_Golf', 'Golf-Courses');
 define('SPECIAL_ORIG_Historical', 'Historical-Homes');
 define('SPECIAL_ORIG_Horses', 'Horses');
 define('SPECIAL_ORIG_Pool', 'Pool');
 define('SPECIAL_ORIG_Premium', 'Premium-Properties');
 define('SPECIAL_ORIG_Waterfront', 'Waterfront-Homes');
 define('SPECIAL_ORIG_Foreclosure', 'Foreclosure');

 define('TYPE_ANY', 'any');
 define('TYPES_SFAMILY', 'single_family');

 
 define('TYPES_townhome', 'townhome');
 define('TYPES_townhouse', 'townhouse');
 define('TYPES_condo_townhomes', 'condo_townhomes');
 define('TYPES_condos_townhomes', 'condos_townhomes');
 define('TYPES_condos__townhomes', 'Condos _Townhomes');


 define('SPECIAL_Foreclosure', 'Foreclosure');

 $types_orig=array("townhomes", "townhome", "townhouse", "condo_townhomes","condos_townhomes","Condos _Townhomes", "condos", "condo", "single_family_home", "single_family");

 $fields_orig=array("city","zip","mls","type");
 $SPECIALS_ORIG_ARRAY=array(
		"55-Communities",
		"Gated-Community",
		"Golf-Courses",
		"Historical-Homes",
		"Horses",
		"Pool",
		"Premium-Properties",
		"Waterfront-Homes",
        "Foreclosure"
	);
 
	$types=array(TYPES_townhomes,TYPES_townhome,TYPES_townhouse,TYPES_condo_townhomes,TYPES_condos_townhomes,TYPES_condos__townhomes,TYPES_condos,TYPES_condo,TYPES_single_family,TYPES_SFAMILY);
	$fields=array(FIELDS_city,FIELDS_zip,FIELDS_mls,FIELDS_type);
	$SPECIALS_ARRAY=array(
		SPECIAL_55_Communities,
		SPECIAL_Gated,
		SPECIAL_Golf,
		SPECIAL_Historical,
		SPECIAL_Horses,
		SPECIAL_Pool,
		SPECIAL_Premium,
		SPECIAL_Waterfront,
        SPECIAL_Foreclosure
	);

?>