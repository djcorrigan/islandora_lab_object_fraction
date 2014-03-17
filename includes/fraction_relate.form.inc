<?php

function islandora_bioinformatics_fraction_specimen_form(array $form, array &$form_state){
  
  // connect to the fedora repo. Apparently this function can be called from anywhere and it will
  // work.
  $tuque = new IslandoraTuque();


  // query to get all of the objects with a project content model
  $specimen_query = "SELECT ?pid
                    FROM <#ri>
                    WHERE {
                    ?pid <fedora-model:hasModel> <info:fedora/islandora:specimenCM> .
                    }";
  $result = $tuque->repository->ri->sparqlQuery($specimen_query, 'unlimited');
  
  // now result has an array of some format that will have pids of all specimens
  
  $specimen_array = array();
  foreach ($result as $specimen){
    // label should contain whatever we've selected as a label for these objects?
    $specimen_array[$project["pid"]["value"]] = islandora_object_load($specimen["pid"]["value"])->label;
  }
  
  
  $form['specimens']=array(
      '#type'=>'select',
      '#title' => t('Specimens'),
      '#options' => $specimen_array,
       '#multiple' => true,
       '#attributes'=>array('size'=>4),
       '#weight'=>8,
  );
  
  return $form;

}
