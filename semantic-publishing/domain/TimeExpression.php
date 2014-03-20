<?php //TimeExpression.php

/**
 * This class models the time expressions extracted in the analysis of the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class TimeExpression{

  public $form;//hoy it appears in the text
  public $date;//date equivalent (YYYY-MM-DD)
  public $time;//time equivalent (HH:MM:SS GMT±HH:MM)
  public $inip;
  public $endp;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array timeExp array with the time expression
  */
  public function __construct($timeExp){
    $this->form = isset($timeExp['form']) ? $timeExp['form'] : '';
    $this->date = isset($timeExp['date']) ? $timeExp['date'] : '';
    $this->time = isset($timeExp['time']) ? $timeExp['time'] : '';
    $this->inip = isset($timeExp['inip']) ? $timeExp['inip'] : '';
    $this->endp = isset($timeExp['endp']) ? $timeExp['endp'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a time expression
  *
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "Time Expression:\n".$output;
    return $output;
  }//toString

}//class TimeExpression

?>
