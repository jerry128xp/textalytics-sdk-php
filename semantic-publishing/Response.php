<?php //Response.php
require_once('Status.php');
require_once('Result.php');
require_once('domain/Dictionary.php');
require_once('domain/Model.php');

/**
 * This class models the response that will be received from the API
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Response{
 
  // Common fields
  public $status;//status of the response

  // Fields of the response for Semantic Tagging and Text Proofreading services
  public $result;//result if there has been any

  // Fields of the response for the User Resources Management service
  public $dictionary;
  public $dictionary_list;

  public $model;
  public $model_list;

  public $entity;
  public $entity_list;

  public $concept;
  public $concept_list;

  public $category;
  public $category_list;

  public $id;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
/**
 * Class constructor
 *
 * @param string response with the reply from the API
 * @return boolean false if the result has not been successful
 */
  public function __construct($response) {
    $decoded = json_decode($response, true);
    if($decoded == null) {
      echo "ERROR: Malformed response\n";
      return false;
    }
    $this->status = new Status ($decoded['status']); 
    if(!$this->status->checkStatus()) {
      return false;
    } else {
      if(isset($decoded['result']))
        $this->result = new Result($decoded['result']); 
      else if(isset($decoded['dictionary'])) {
        $this->dictionary = new Dictionary();
        if(!$this->dictionary->createResourceWithArray($decoded['dictionary']))
          return false;
      } else if(isset($decoded['dictionary_list'])) {
        $this->dictionary_list = array();
        foreach($decoded['dictionary_list'] as $dict) {
          $d = new Dictionary();
          if(!$d->createResourceWithArray($dict))
            return false;
          $this->dictionary_list[] = $d;
        }
      } else if(isset($decoded['model'])) {
        $this->model = new Model();
        if(!$this->model->createResourceWithArray($decoded['model']))
          return false;
      } else if(isset($decoded['model_list'])) {
        $this->model_list = array();
        foreach($decoded['model_list'] as $model) {
          $m = new Model();
          if(!$m->createResourceWithArray($model))
            return false;
          $this->model_list[] = $m;
        }
      } else if(isset($decoded['entity'])) {
        $this->entity = new Entity();
        if(!$this->entity->createResourceWithArray($decoded['entity']))
          return false;
      } else if(isset($decoded['entity_list'])) {
        $this->entity_list = array();
        foreach($decoded['entity_list'] as $entity) {
          $e = new Entity();
          if(!$e->createResourceWithArray($entity)) {
            return false;
          }
          $this->entity_list[] = $e;
        }
      } else if(isset($decoded['concept'])) {
        $this->concept = new Concept();
        if(!$this->concept->createResourceWithArray($decoded['concept']))
          return false;
      } else if(isset($decoded['concept_list'])) {
        $this->concept_list = array();
        foreach($decoded['concept_list'] as $concept) {
          $c = new Concept();
          if(!$c->createResourceWithArray($concept)) {
            return false;
          }
          $this->concept_list[] = $c;
        }
      } else if(isset($decoded['category'])) {
        $this->category = new Category();
        if(!$this->category->createResourceWithArray($decoded['category']))
          return false;
      } else if(isset($decoded['category_list'])) {
        $this->category_list = array();
        foreach($decoded['category_list'] as $cat) {
          $c = new Category();
          if(!$c->createResourceWithArray($cat)) {
            return false;
          }
          $this->category_list[] = $c;
        }
      } else if(isset($decoded['id']))
        $this->id = $decoded['id'];
    }
    return true;
  }//__construct

}//class Response

?>
