<?php //Category.php

/**
 * This class models the categories elements in semantic publishing, both the elements obtained in the 
 * semantic tagging process as well as the resources in user-defined models that are managed through
 * the user resources management service.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Category{

  //common fields
  public $code;//64 characters max, alphanumeric characters, dashes and underscores

  //semantic tagging fields
  public $relevance;
  public $label_list;//textual labels of the category

  //resource fields
  public $label;//general description of the category
  public $positive;//list of positive terms
  public $negative;//list of negative terms
  public $relevant;//list of relevant terms
  public $irrelevant;//list of irrelevant terms
  public $text;//training text

  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the elements of the category obtained in the response of semantic tagging
  * into the corresponding fields of the category object.
  *
  * @param array category with the category as it appears in semantic tagging
  */
  public function loadTaggedElement($category){
    $this->code = $category['code'];
    $this->relevance = $category['relevance'];
    if(is_array($category['label_list'])){
      foreach($category['label_list'] as $lab)
        $this->label_list[] = $lab;
    }elseif(!empty($category['label_list']))
      $this->label_list[] = $category['label_list'];
    else $this->label_list = array ();  
  }//loadTaggedElement

  
 /**
  * Maps the fields of the category resource used in the management service
  *
  * @param string code identifier of the category in the model
  * @param string label general description of the category
  * @param string positive with the list of positive terms
  * @param string negative with the list of negative terms
  * @param string relevant with the list of relevant terms
  * @param string irrelevant with the list of irrelevant terms
  * @param string text training text
  * @return false if any of the mandatory fields are missing
  */
  public function createResourceWithFields($code, $label, $positive, $negative, $relevant, $irrelevant, $text){
    if(isset($code) && $code != '')
      $this->code = $code;
    else return false;
    if(isset($label) && $label != '')
      $this->label = $label;
    else return false;
    $this->positive = $positive;
    $this->negative = $negative;
    $this->relevant = $relevant;
    $this->irrelevant = $irrelevant;
    $this->text = $text;    
    return true;
  }//createResourceWithFields


 /**
  * Maps the array of the category resource used in the management service
  *
  * @param array category with all the fields of the category
  * @return false if any of the mandatory fields are missing
  */
  public function createResourceWithArray($category){
    if(isset($category['code']) && $category['code'] != '')
      $this->code = $category['code'];
    else return false;
    if(isset($category['label']) && $category['label'] != '')
      $this->label = $category['label'];
    else return false;
    if(isset($category['positive'])) $this->positive = $category['positive'];
    if(isset($category['negative'])) $this->negative = $category['negative'];
    if(isset($category['relevant'])) $this->relevant = $category['relevant'];
    if(isset($category['irrelevant'])) $this->irrelevant = $category['irrelevant'];
    if(isset($category['text'])) $this->text = $category['text'];    
    return true;
  }//createResourceWithArray


  //////////////////////// AUXILIARY FUNCTIONS //////////////////////////////////////
  
  /**
   * Returns the value of the attribute that identifies univocally the category in the model
   * 
   */
  public function getObjectIdentifier(){
    return $this->code;
    
  }//getObjectIdentifier

  
 /**
  * Add term to list of positive terms
  *
  * @param string term string with the new term
  */
  public function addPositiveTerm($term){
    if(empty($term))
      return;
    $this->positive .= '|'.$term;
  }//addPositiveTerm

  
 /**
  * Remove term from the list of positive terms
  *
  * @param string term string with the new term
  */
  public function removePositiveTerm($term){
    if(empty($term))
      return;    
    $this->positive = preg_replace('/\|'.trim(preg_quote($term, '\|/')).'\|/', '|', '|'.$this->positive.'|');
    $this->positive = substr($this->positive, 1, strlen($this->positive)-2);// quita los pipes puestos al principio y final
  }//removePositiveTerm  
  
  
 /**
  * Add term to list of negative terms
  *
  * @param string term string with term to remove
  */
  public function addNegativeTerm($term){
    if(empty($term))
      return;
    $this->negative .= '|'.$term;

  }//addNegativeTerm

  
 /**
  * Remove term from the list of negative terms
  *
  * @param string term string with the term to remove
  */
  public function removeNegativeTerm($term){
    if(empty($term))
      return;    
    $this->negative = preg_replace('/\|'.trim(preg_quote($term, '\|/')).'\|/', '|', '|'.$this->negative.'|');
    $this->negative = substr($this->negative, 1, strlen($this->negative)-2);// quita los pipes puestos al principio y final
  }//removeNegativeTerm    
  
  
 /**
  * Add term to list of relevant terms
  *
  * @param string term string with the new term
  */
  public function addRelevantTerm($term){
    if(empty($term))
      return;
    $this->relevant .= '|'.$term;

  }//addRelevantTerm

  
 /**
  * Remove term from the list of relevant terms
  *
  * @param string term string with the term to remove
  */
  public function removeRelevantTerm($term){
    if(empty($term))
      return;    
    $this->relevant= preg_replace('/\|'.trim(preg_quote($term, '\|/')).'\|/', '|', '|'.$this->relevant.'|');
    $this->relevant = substr($this->relevant, 1, strlen($this->relevant)-2);// quita los pipes puestos al principio y final
  }//removeRelevantTerm      
  
  
 /**
  * Add term to list of irrelevant terms
  *
  * @param string term string with the new term
  */
  public function addIrrelevantTerm($term){
    if(empty($term))
      return;
    $this->irrelevant .= '|'.$term;   
  }//addIrrelevantTerm
  
  
 /**
  * Remove term from the list of irrelevant terms
  *
  * @param string term string with the term to remove
  */
  public function removeIrrelevantTerm($term){
    if(empty($term))
      return;    
    $this->irrelevant= preg_replace('/\|'.trim(preg_quote($term, '\|/')).'\|/', '|', '|'.$this->irrelevant.'|');
    $this->irrelevant = substr($this->irrelevant, 1, strlen($this->irrelevant)-2);// quita los pipes puestos al principio y final
  }//removeIrrelevantTerm        
  

 /**
  * Add training text to a category
  *
  * @param string text with the new text to add
  */
  public function addTrainingText($text){
    if(empty($term))
      return;
    $this->text .= $text;
   
  }//addTrainingText


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////  

 /**
  * Returns a string ready to print with all the attributes of a Category of the specified type
  *
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value) {
      if(is_object($value))
        $output .= "\t".$value->toString()."\n";
      else if (is_array($value) && $value != ''){        
        $output .= "\t".$name.":\n";
        $output .= "\t\t";
        foreach($value as $n=>$val){//label_list          
          if($n != 0) $output .= " - ";          
          $output .= $val;                                
        }
        $output .= "\n";
      }else if($value != '')
        $output .= "\t$name: ".$value."\n";
    }
    if(!empty($output))
      $output = "Category:\n".$output;
    return $output;        
  }//toString


 /**
  * Returns a json string with a category element of the specified type
  *
  */
  public function toJsonString(){
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      $obj['category'][$name] = $value;
    return json_encode($obj);
  }//toJsonString

}//class Category

?>
