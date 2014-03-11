<?php
// here's where you can change the $variables array before the page is loaded


function islandora_bioinformatics_fraction_preprocess_islandora_bioinformatics_fraction(array &$variables) {
  
  $islandora_object = $variables['islandora_object'];
  //
  // get some of the EML data
  if (isset($islandora_object['EML'])){
    $eml_data = url("islandora/object/{$islandora_object->id}/datastream/EML/view");
    
    $variables["EML_DATA"] = $eml_data;
  }
}
