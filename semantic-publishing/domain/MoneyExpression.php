<?php //MoneyExpression.php

/**
 * This class models the money expressions extracted in the analysis of the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class MoneyExpression{

  public $form;//how it appears in the text
  public $amount;//amount of money (numeric value)
  public $currency;//currency (ISO4217)
  public $inip;
  public $endp; 

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array moneyExp array with the money expression
  */
  public function __construct($moneyExp){
    $this->form = isset($moneyExp['form']) ? $moneyExp['form'] : '';
    $this->amount = isset($moneyExp['amount']) ? $moneyExp['amount'] : '';
    $this->currency = isset($moneyExp['currency']) ? $moneyExp['currency'] : '';
    $this->inip = isset($moneyExp['inip']) ? $moneyExp['inip'] : '';
    $this->endp = isset($moneyExp['endp']) ? $moneyExp['endp'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a money expression
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "Money Expression:\n".$output;
    return $output;
  }//toString

}//class MoneyExpression

?>
