<?php
/**
 * @file
 */
// here's where you can change the $variables array before the page is loaded


function islandora_bioinformatics_fraction_preprocess_islandora_bioinformatics_fraction(array &$variables) {
  
	$islandora_object = $variables['islandora_object'];
	$variables['edit_url'] = 'http://' . $_SERVER['SERVER_NAME'] . '/islandora/edit_form/' . urlencode($islandora_object->id) . '/fraction';

	$ns = "http://www.upeikerrlab.ca";

	$obj = new SimpleXMLElement($islandora_object['fraction']->content);
	$xml_objects = $obj->children($ns);

	$variables['type'] = $xml_objects->type;
	$variables['id'] = $xml_objects->id;
	$variables['lab_id'] = $xml_objects->labid;
	$variables['weight'] = $xml_objects->weight;
	$variables['plate'] = $xml_objects->plate;
	$variables['location'] = $xml_objects->location;
	$variables['notes'] = $xml_objects->notes;

	$variables['inhibitors'] = array();

	foreach ($xml_objects->inhibitor as $key => $value) {
		array_push($variables['inhibitors'], $value);
	}

	$variables['test_var'] = $xml_objects;
}

/**
 * Preprocess hook for fraction table. this will take in an arbitrary number of fraction
 * objects and add them to the variables array. They will then be printed out in the tpl.
 *
 * @param array $variables
 *  The variables array for modification
 */
function islandora_lab_object_fraction_preprocess_islandora_lab_object_fraction_table(array &$variables){
  $i = 0;
  foreach ($variables['islandora_objects'] as $fraction){
    $variables['fractions'][$i]['pid'] = $fraction->id;
    $variables['fractions'][$i] = fraction_object_to_array($fraction);
    $i++;
  }

}