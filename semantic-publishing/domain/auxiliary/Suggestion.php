<?php //Suggestion.php

/**
 * This class models the suggestions of a issue
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Suggestion{

  //fields
  public $form;
  public $confidence;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param sug array with the suggestion
  */
  public function __construct($sug){
    $this->form = isset($sug['form']) ? $sug['form'] : '';
    $this->confidence = isset($sug['confidence']) ? $sug['confidence'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a suggestion
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value) {
      if($value != '')
        $output .= "\t\t$name: ".$value."\n";
    }
    return $output;
  }//toString

}//class Suggestion

?>
