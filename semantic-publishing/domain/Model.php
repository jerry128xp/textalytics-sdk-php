<?php //Model.php
require_once('auxiliary/Stats.php');

/**
 * The class Model represents a collection that contains categories; it models
 * the object used in the user resources management service (endpoints: 
 * '/model_list/' and '/model_list/{name}').
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Model{

  public $name;//64 characters max, alphanumeric characters, dashes and underscores
  public $language;
  public $description;
  public $stats; //read only
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the elements of the model obtained in the response of manage
  *
  * @param array model with the model as it appears in manage 
  * @return boolean true if the resource has been created out without errors
  */
  public function createResourceWithArray($model){
    $this->name = isset($model['name']) ? $model['name'] : '';
    $this->language = isset($model['language']) ? $model['language'] : '';
    if($this->name == '' || $this->language == '')
      return false;
    $this->description = isset($model['description']) ? $model['description'] : '';
    if(isset($model['stats']))
      $this->stats = new Stats($model['stats'], 'model'); 
    return true;
  }//createResourceWithArray


 /**
  * Maps the elements of the model resource used in the management service
  *
  * @param string name unique identifier for the model
  * @param string language language in which the model will be used (es|en)
  * @param string description textual description of the purpose of the model.
  * @return boolean true if the resource has been created out without errors
  */
  public function createResourceWithFields($name, $language, $description){
    if($name == '' || $language == '')
      return false;
    $this->name = $name;
    $this->language = $language;
    $this->description = $description;
    return true;
  }//createResourceWithFields

  
  //////////////////////// AUXILIARY FUNCTIONS //////////////////////////////////////
  
  /**
   * 
   * Returns the value of the attribute that identifies univocally the model
   * 
   */
  public function getObjectIdentifier(){
    return $this->name;
    
  }//getObjectIdentifier  

  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a model 
  *
  */
  public function toString() {
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value) {
      if(is_object($value))
        $output .= $value->toString();
      else if($value != '')
        $output .= "\t$name: ".$value."\n";
    }
    if(!empty($output))
      $output = "Model:\n".$output;
    return $output;
  }//toString


 /**
  * Returns a json string with a model element 
  *
  */
  public function toJsonString(){
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      $doc['model'][$name] = $value;
    return json_encode($doc);
  }//toJsonString

}//class Model 

?>
