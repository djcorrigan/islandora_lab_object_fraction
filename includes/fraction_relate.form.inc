<?php

function islandora_bioinformatics_fraction_specimen_form(array $form, array &$form_state){
  
  // connect to the fedora repo. Apparently this function can be called from anywhere and it will
  // work.
  $tuque = new IslandoraTuque();


  // query to get all of the objects with a project content model
  $project_query = "SELECT ?pid
                    FROM <#ri>
                    WHERE {
                    ?pid <fedora-model:hasModel> <info:fedora/islandora:specimenCM> .
                    }";
  $result = $tuque->repository->ri->sparqlQuery($project_query, 'unlimited');
  
  // now result has an array of some format that will have pids of all projects
  
  // build an key->value array to pass to the drupal form api
  $project_array = array();
  foreach ($result as $project){
    $project_array[$project["pid"]["value"]] = $project["pid"]["value"];
  }
  
  
  $form['projects']=array(
      '#type'=>'select',
      '#title' => t('Specimens'),
      '#options' => $project_array,
       '#multiple' => true,
       '#attributes'=>array('size'=>4),
       '#weight'=>8,
  );
  
  return $form;

}
