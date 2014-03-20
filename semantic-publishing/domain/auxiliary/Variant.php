<?php //Variant.php

/**
 * This class models the variants of aggregated elements in the semantic publishing output 
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved. 
 * */

class Variant{

  //fields
  public $form;
  public $inip;
  public $endp;

  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the variant the defined fields
  *
  * @param variant array with the variant as it appears in semantic tagging
  */
  public function __construct($variant){
    $this->form = $variant['form'];
    $this->inip = $variant['inip'];
    $this->endp = $variant['endp'];           
  }//__construct

  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
  /**
   * 
   * Returns the object variant as a string 
   */
  public function toString(){
    return "\t\t".$this->form.', '.$this->inip.', '.$this->endp."\n";
  }//toString
  
}//class Variant
?>
