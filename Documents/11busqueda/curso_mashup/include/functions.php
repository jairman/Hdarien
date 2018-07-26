<?
function RECOMMENDED_DROPDOWN() {
	$recommended_dd_query="SELECT * 
						   FROM restaurantes;";
	$recommended_dd_result = mysql_query($recommended_dd_query);
	if(!$recommended_dd_result) {echo "Doh!  Error creating dropdown from database."; exit;}
	else {
		$recommended = "<select name='guestmap_recommended'><option value='0'></option>";
		while ($row = mysql_fetch_object($recommended_dd_result)) {
			$recommended .= "<option value='$row->restaurante_ID'>$row->restaurante_nombre</option>";
		}
		$recommended .= "</select>";
	}
return $recommended;
}

function unhtmlspecialchars($string){
	$string = str_replace ( '&amp;', '&', $string );
	$string = str_replace ( '&#039;', '\'', $string );
	$string = str_replace ( '&quot;', '\"', $string );
	$string = str_replace ( '&lt;', '<', $string );
	$string = str_replace ( '&gt;', '>', $string );

return $string;
}
?>



