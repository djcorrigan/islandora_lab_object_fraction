<?php
/**
 * @file
 */
// here's where you can change the $variables array before the page is loaded


function islandora_lab_object_fraction_preprocess_islandora_lab_object_fraction(array &$variables) {
  
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

  $variables['assays'] = array();
  $i = 0;
  foreach ($xml_objects->inhibitor as $assay) {
    $variables['assays'][$i]['name'] = (string) $assay->name;
    $variables['assays'][$i]['result'] = (string) $assay->result;
    $variables['assays'][$i]['comment'] = $assay->comment;
    $i++;
  }

  $variables['test_var'] = $xml_objects;

  //get specimen associated with the fraction
  $tuque = new IslandoraTuque();
  $specimen_query = "SELECT ?pid
                    FROM <#ri>
                    WHERE {
                    ?pid <fedora-model:hasModel> <info:fedora/islandora:specimen_cmodel> .
                    }";
  $result = $tuque->repository->ri->sparqlQuery($specimen_query, 'unlimited');

  $related_specimens = array();
  foreach ($result as $specimen) {
    $specimen_object = islandora_object_load($specimen['pid']['value']);
    if ($islandora_object->relationships->get(FEDORA_RELS_EXT_URI, 'isPartOf', $specimen_object->id)) {
      $related_specimens[$specimen_object->id] = $specimen_object->label;
    }
  }

  $variables["related_specimens"] = $related_specimens;
}

/**
 * Preprocess hook for fraction table. this will take in an arbitrary number of fraction
 * objects and add them to the variables array. They will then be printed out in the tpl.
 *
 * @param array $variables
 *  The variables array for modification
 */
function islandora_lab_object_fraction_preprocess_islandora_lab_object_fraction_table(array &$variables) {
  $i = 0;
  foreach ($variables['islandora_objects'] as $fraction) {

    $variables['fractions'][$i] = fraction_object_to_array($fraction);
    $variables['fractions'][$i]['pid'] = $fraction->id;

    $i++;
  }

}