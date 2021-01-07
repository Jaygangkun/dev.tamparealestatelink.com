<?php
/*
The portuguese title

This builds up the title for the english sites
*/
	   // this is handling for the paging...
		if (isset($request['type']) && ($request['type'] == TYPE_ANY || $request['type'] == TYPES_SFAMILY)) {
			if (!isset($request['city']))
			{
				$request['city'] = "";
			}
		}
		
		// if only the type is set
		// type -    set
		// city -    not set
		// special - not set
		if (isset($request['type']) && !isset($request['city']) && !isset($request['special']))
		{
			$types_to_replace_to=array("Townhouses","Apartamentos","Apartamentos","Casas");
			$request['type'] = str_replace($types_orig, $types_to_replace_to,$request['type']);
			$request['type'] = str_replace($types, $types_to_replace_to,$request['type']);
			$title .= $request['type'];
			$title .= " em ";
		}
		// if only the special is set
		// type -    not set
		// city -    not set
		// special - set
		elseif (!isset($request['type']) && !isset($request['city']) && isset($request['special']))
		{
			$specials_to_replace_to=array("Casas em Comunidade 55+",
										  "Casas em Condom&#237;nio Fechado",
										  "Casas em Campos de Golfe",
										  "Casas Hist&#243;ricas",
										  "Casas Equestres",
										  "Casas com Piscina",
										  "Propriedades Premium",
										  "Casas &#224; Beira-Mar");
			$request['special'] = str_replace($SPECIALS_ORIG_ARRAY, $specials_to_replace_to,$request['special']);
			$title = str_replace('-',' ',$request['special']);
			$title .= " em ";
			
			//return $title;
		}
		// if only the special and the type is set
		// type -    set
		// city -    not set
		// special - set
		elseif (isset($request['type']) && !isset($request['city']) && isset($request['special']))
		{
			$types_to_replace_to=array("Townhouses","Apartamentos","Apartamentos","Casas");
			$request['type'] = str_replace($types_orig, $types_to_replace_to,$request['type']);
			
			if ($request['special'] == "Propiedades-de-Lujo" || $request['special'] == "Premium-Properties") {
				$title = "Propriedades Premium ". ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])));
				//return $title;
			}
			elseif ($request['special'] == "Campo-de-Golf" || $request['special'] == "Golf-Courses") {
				$title = ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])))." em Campo de Golf";
				//return $title;
			}
			elseif ($request['special'] == "Con-Vista-Al-Agua" || $request['special'] == "Waterfront-Homes") {
				$title = ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])))." &#224; Beira-Mar";
				//return $title;
			}
			elseif ($request['special'] == "Con-Pisca" || $request['special'] == "Pool")
			{
				$title = ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])))." com Piscina";
				//return $title;
			} else {
				$title = ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])))." com Vigilancia Privada";
				//return $title;
			}
			$title .= " em ";
		}
		else
		{
			if (isset($request['special']) && (in_array($request['special'],$SPECIALS_ARRAY) || in_array($request['special'],$SPECIALS_ORIG_ARRAY))){
				$request['special'] = str_replace($SPECIALS_ORIG_ARRAY, $SPECIALS_ARRAY,$request['special']);
				$title .= ucfirst(str_replace('-',' ',$request['special']));
			} 
			
			// type is set.... and eventually the city will be....
			if (isset($request['type'])) {

				$request['type'] = str_replace($types_orig, $types,$request['type']);
				//if ((empty($request['type']) || $request['type'] == TYPE_ANY) && (isset($request['special']) && is_array($request['special'])) || (!isset($request['special']) || strlen($request['special']) == 0))
				if (
						(empty($request['type']) || $request['type'] == TYPE_ANY) && 
						(isset($request['special']) && is_array($request['special'])) || 
						(!isset($request['special']) || empty($request['special']))
					)
				{
				  $types_to_replace_to=array("Townhouses","Apartamentos","Apartamentos","Casas");
				  $request['type'] = str_replace($types_orig, $types_to_replace_to,$request['type']);
				  if ($request['type'] == TYPE_ANY) {
					$request['type'] = "Propriedades";
				  }
				}
				$title .= ucfirst(str_replace('_',' ',str_replace('-',' ',$request['type'])));
				
				//if ((isset($request['city']) && strlen($request['city']) > 0) || ( isset($request['special']) && !in_array($request['special'],$SPECIALS_ARRAY)) ){
					$title .= " em ";
				//}
			}
	   }

?>