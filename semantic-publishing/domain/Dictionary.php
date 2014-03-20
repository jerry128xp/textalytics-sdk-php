<?php //Dictionary.php
require_once('auxiliary/Stats.php');

/**
 * The class Dictionary represents a collection that contains entities and concepts; it models 
 * the object used in the user resources management service (endpoints: 
 * /dictionary_list/ and /dictionary_list/{name}).
 * 
 * @author 		Textalytics
 * @version		1.0 -- 02/2014
 * @contact     http://www.textalytics.com (http://www.daedalus.es)
 * @copyright   Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Dictionary{

  public $name;//64 characters max, alphanumeric characters, dashes and underscores  
  public $language;
  public $description;
  public $stats;//read only
  
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the elements of the dictionary obtained in the response of manage
  *
  * @param array dictionary with the dictionary as it appears in manage 
  * @return boolean true if the resource has been created out without errors
  */
  public function createResourceWithArray($dictionary) {
    $this->name = isset($dictionary['name']) ? $dictionary['name'] : '';
    $this->language = isset($dictionary['language']) ? $dictionary['language'] : '';
    if($this->name == '' || $this->language == '')
      return false;
    $this->description = isset($dictionary['description']) ? $dictionary['description'] : '';
    if(isset($dictionary['stats']))
      $this->stats = new Stats($dictionary['stats'], 'dictionary');
    return true; 
  }//createResourceWithArray


 /**
  * Maps the elements of the dictionary resource used in the management service
  * 
  * @param string name unique identifier for the dictionary 
  * @param string language language in which the dictionary will be used (es|en)
  * @param string description textual description of the purpose of the dictionary.
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
   * Returns the value of the attribute that identifies univocally the dictionary
   * 
   */
  public function getObjectIdentifier(){
    return $this->name;
  }//getObjectIdentifier  
  

  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a dictionary 
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
      $output = "Dictionary:\n".$output;
    return $output;
  }//toString


 /**
  * Returns a json string with a dictionary element 
  *
  */
  public function toJsonString(){
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      $doc['dictionary'][$name] = $value;
    return json_encode($doc);
  }//toJsonString

}//class Dictionary 

?>
