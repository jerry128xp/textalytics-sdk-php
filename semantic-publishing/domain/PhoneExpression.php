<?php //PhoneExpression.php

/**
 * This class models the phone expressions extracted in the analysis of the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class PhoneExpression{

  //fields of the object
  public $form;
  public $inip;
  public $endp;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array phoneExp array with the phone expression
  */
  public function __construct($phoneExp){
    $this->form = isset($phoneExp['form']) ? $phoneExp['form'] : '';
    $this->inip = isset($phoneExp['inip']) ? $phoneExp['inip'] : '';
    $this->endp = isset($phoneExp['endp']) ? $phoneExp['endp'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a phone expression
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "Phone Expression:\n".$output;
    return $output;
  }//toString

}//class PhoneExpression

?>
