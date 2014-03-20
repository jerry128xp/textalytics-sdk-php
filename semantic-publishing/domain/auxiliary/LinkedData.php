<?php //LinkedData.php

/**
 * This class models the linked data elements in the semantic publishing output 
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved. 
 * */

class LinkedData{

  //fields
  public $href;
  public $source;
  
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the linked data fields defined
  * 
  * @param linkedData array with the geo element as it appears in semantic tagging
  */
  public function __construct($linkedData){
    $this->href = isset($linkedData['href']) ? $linkedData['href'] : '';
    $this->source = isset($linkedData['source']) ? $linkedData['source'] : '';
  }//__construct
  
  
  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
  /**
   * 
   * Returns the object linked data as a string 
   */
  public function toString(){
    $str = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $str .= "\t\t$name: ".$value."\n";
    return $str;
  }//toString
  
}//class LinkedData

?>
