<?php

/*
*
* @file assay_relate.form.inc
*
* 
*
*/


function islandora_lab_object_assay_specimen_form(array $form, array &$form_state) {
  
  // connect to the fedora repo. Apparently this function can be called from anywhere and it will
  // work.
  $tuque = new IslandoraTuque();


  // query to get all of the objects with a project content model
  $specimen_query = "SELECT ?pid
                    FROM <#ri>
                    WHERE {
                    ?pid <fedora-model:hasModel> <info:fedora/islandora:specimen_cmodel> .
                    }";
  $result = $tuque->repository->ri->sparqlQuery($specimen_query, 'unlimited');
  
  // now result has an array of some format that will have pids of all specimens
  
  $specimen_array = array();
  foreach ($result as $specimen) {
    // label should contain whatever we've selected as a label for these objects?
    $specimen_array[$specimen["pid"]["value"]] = islandora_object_load($specimen["pid"]["value"])->label;
  }
  
  
  $form['specimens']=array(
      '#type' => 'select',
      '#title' => t('Specimens'),
      '#options' => $specimen_array,
       '#multiple' => TRUE,
       '#attributes' => array('size' => 4),
       '#weight' => 8,
  );
  
  return $form;

}


function islandora_lab_object_assay_specimen_submit(array $form, array &$form_state) {
  $tuque = new IslandoraTuque();

  $assay_object = $form_state['islandora']['objects'][0];

  $specimen_ids = array_filter($form_state['values']['specimens']);
  
  
  foreach ($specimen_ids as $id) {
    $assay_object->relationships->add($id, 'isPartOf', 'islandora:specimen_cmodel');
  }
}
