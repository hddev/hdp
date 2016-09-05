<?php
$db = DbController::GetDatabaseInstance ();

$prefix = $GLOBALS ['DB_PREFIX'];
$db_type = $GLOBALS ['DB_TYPE'];

$term = $_REQUEST ['term'];
$term = mb_strtolower ( $term, 'UTF-8' );

/*
 * if ($db_type == "MYSQL") $query = "SELECT DISTINCT 'material' FROM `{$prefix}_completedworks_materials_table` WHERE LOWER(material) LIKE '%$term%'"; if ($db_type == "POSTGRESQL") $query = "SELECT DISTINCT material FROM {$prefix}_completedworks_materials_table WHERE LOWER(material) LIKE '%$term%'";
 */

if ($db_type == "MYSQL")
	$query = "SELECT DISTINCT 'name', 'category' FROM `{$prefix}_materials_table` WHERE LOWER(name) LIKE '%$term%'";
if ($db_type == "POSTGRESQL")
	$query = "SELECT DISTINCT name, category FROM {$prefix}_materials_table WHERE LOWER(name) LIKE '%$term%'";

$result = $db->Query ( $query );
if (! $result)
	return false;

$array = $result->GetAllRows ( MYSQL_ASSOC );
$return = array ();

if (! empty ( $array )) {
	foreach ( $array as $element ) {
		$elar = array ();
		$elar ['term'] = htmlentities ( stripslashes ( $element ['name'] ) );
		$out [] = $elar;
		
		array_push ( $return, array (
				'label' => $element ['name'],
				'value' => $element ['name'] 
		) );
	}
}

/*
 * if (!empty($array)){ foreach ($array as $element) { array_push($return,array('category'=>$element['category'],'label'=>$element['name'],'value'=>$element['material'])); } }
 */

echo json_encode ( $return );

?>