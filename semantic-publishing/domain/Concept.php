<?php //Concept.php
require_once('auxiliary/Variant.php');
require_once('auxiliary/Geo.php');
require_once('auxiliary/LinkedData.php');
require_once('auxiliary/Standard.php');

/**
 * This class models the concept elements in semantic publishing, both the elements obtained in the 
 * semantic tagging process as well as the resources in user-defined dictionaries that are managed 
 * through the user resources management service.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 * 
 */

class Concept{

  //common fields
  public $form;
  public $type;
  public $theme_list;
  public $geo_list;
  
  //semantic tagging fields
  public $dictionary; //dictionary from which the concept is detected
  public $variant_list;//appearances of the concept in the text
  public $relevance;//relative relevance
  public $linked_data_list;
  public $standard_list;
  
  //resource fields
  public $id;//64 characters max, alphanumeric characters, dashes and underscores
  public $alias_list;
 
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the elements of the category obtained in the response of semantic tagging
  * into the corresponding fields of the concept object.
  *
  * @param array concept with the concept as it appears in semantic tagging
  */
  public function loadTaggedElement($concept){
    $this->id = (isset($concept['id'])) ? $concept['id'] : '';
    $this->form = (isset($concept['form'])) ? $concept['form'] : '';
    $this->dictionary = (isset($concept['dictionary'])) ? $concept['dictionary'] : '';
    $this->type = (isset($concept['type'])) ? $concept['type'] : '';
    
    //Creates a Variant object for each element in the array
    $this->variant_list = array();
    if(isset($concept['variant_list'])){
      foreach($concept['variant_list'] as $variant){
        $this->variant_list[] = new Variant($variant);
      }
    }
    //Creates a Geo object for each element in the array
    $this->geo_list = array();
    if(isset($concept['geo_list'])){
      foreach($concept['geo_list'] as $geo){
        $this->geo_list[] = new Geo($geo);
      }
    }
    //Creates a LinkedData object for each element in the array
    $this->linked_data_list = array();
    if(isset($concept['linked_data_list'])){
      foreach($concept['linked_data_list'] as $ld){
        $this->linked_data_list[] = new LinkedData($ld);
      }
    }
    
    //Creates a Standard object for each element in the array
    $this->standard_list = array();
    if(isset($concept['standard_list'])){
      foreach($concept['standard_list'] as $std){
        $this->standard_list[] = new Standard($std);
      }
    }                  
    $this->theme_list = array();
    if(isset($entity['theme_list']))
      $this->theme_list = $entity['theme_list'];      
    $this->relevance = (isset($concept['relevance'])) ? $concept['relevance'] : '';       
  }//loadTaggedElement

  
 /**
  * Maps the elements of the concept resource used in the management service
  *
  * @param string id identifier of the concept in the dictionary
  * @param string form textual form that represents the concept
  * @param array alias_list array with the possible alias of the concept
  * @param string type type classification of the concept (odentity in ontodaedalus)
  * @param array theme_list array with the possible thematic classifications (odtheme in ontodaedalus)
  * @return false if any of the mandatory fields are missing
  */
  public function createResourceWithFields($id, $form, $alias_list = array() , $type = '', $theme_list = array()){
    if(isset($form) && $form != '')
      $this->form = $form;
    else return false;
    if(isset($id) && $id != '')
      $this->id = $id;
    elseif($id == '')
      return false;
    //else, if id is not set, we leave it at null
    $this->alias_list = $alias_list;
    $this->type = $type;
    $this->theme_list = $theme_list;    
    return true;
  }//createResourceWithFields
 
 
  /**
  * Maps the array of the concept resource used in the management service
  *
  * @param array concept with all the fields of the entity
  * @return false if any of the mandatory fields are missing
  */
  public function createResourceWithArray($concept){
    if(isset($concept['form']) && $concept['form'] != '')
      $this->form = $concept['form'];
    else return false;
    if(isset($concept['id']) && $concept['id'] != '')
      $this->id = $concept['id'];
    elseif($concept['id'] == '')
      return false;
    //else, if id is not set, we leave it at null
    if(isset($concept['alias_list'])) $this->alias_list = $concept['alias_list'];
    if(isset($concept['type'])) $this->type = $concept['type'];
    if(isset($concept['theme_list'])) $this->theme_list = $concept['theme_list'];  
    return true;
  }//createResourceWithArray



  //////////////////////// AUXILIARY FUNCTIONS //////////////////////////////////////
  
  /**
   * Returns the value of the attribute that identifies univocally the concept in the dictionary
   * 
   */
  public function getObjectIdentifier(){
    return $this->id;
    
  }//getObjectIdentifier
  
  
/**
  * Adds a new alias to the list of the entity
  *
  * @param string newAlias with the new alias to add
  */  
  public function addAlias($newAlias){
    if(empty($newAlias))
      return;
    $this->alias_list[]=$newAlias;
  }//addAlias

  
/**
  * Remove alias from the list of alias
  *
  * @param string alias with the  alias to remove
  */  
  public function removeAlias($alias){
    if(empty($alias))
      return;
    $tmp = array();
    foreach($this->alias_list as $a){
      if($a!=$alias)
        $tmp[] = $a;
    }
    $this->alias_list = $tmp;
  }//removeAlias   

  
 /**
  * Adds a new theme to the list of themes
  *
  * @param string newTheme with the new theme to add
  */  
  public function addTheme($newTheme){
    if(empty($newTheme))
      return;
    $this->theme_list[]=$newTheme;
  }//addTheme

/**
  * Remove theme from the list of themes
  *
  * @param string theme with the new theme to remove
  */  
  public function removeTheme($theme){
    if(empty($theme))
      return;
    $tmp = array();
    foreach($this->theme_list as $t){
      if($t!=$theme)
        $tmp[] = $t;
    }
    $this->theme_list = $tmp;
  }//removeTheme    
  
  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////  

 /**
  * Returns a string ready to print with all the attributes of a Concept of the specified type
  *
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value) {//first level objects 
      if(is_object($value))
        $output .= "\t".$value->toString()."\n";
      else if (is_array($value) && $value != ''){
        if(sizeof($value) != 0)               
          $output .= "\t".$name.":\n";
        foreach($value as $n=>$val){          
          if(is_object($val)){//second level objects, e.g. Geo
            $output .= $val->toString();
          }else if($val != '')
            $output .= "\t\t$n: ".$val."\n";                    
        }
      }else if($value != '')
        $output .= "\t$name: ".$value."\n";
    }
    if(!empty($output))
      $output = "Concept:\n".$output;
    return $output;  
  }//toString


 /**
  * Returns a json string with a concept resource
  *
  */
  public function toJsonString(){    
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      $obj['concept'][$name] = $value;
    return json_encode($obj);
  }//toJsonString  


}//class Concept

?>
