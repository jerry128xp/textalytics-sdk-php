<?php //Status.php

/**
 * This class models the status element that will provide information on the success of
 * the request to the API
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Status{

  public $code;
  public $message;
  public $moreInfo;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param status array with the status response from the API
  */
  public function __construct($status){
    $this->code = $status['code'];
    $this->message = $status['message'];
    $this->moreInfo = isset($status['moreInfo']) ? $status['moreInfo'] : '';
  }//__construct


  //////////////////////// AUXILIARY FUNCTIONS //////////////////////////////////////  
  
 /**
  * Checks if the status received has been successful and prints the error when
  * it is not.
  *
  * @return boolean true if the response has been carried out without errors
  */
  public function checkStatus(){
    if($this->code == '0')
      return true;
    $this->toString();
    return false;
  }//checkStatus

  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Prints the values of the attributes
  */
  public function toString(){
    $mI = !empty($this->moreInfo) ? (" (".$this->moreInfo.")") : '';
    echo "ERROR: ".$this->code.": ".$this->message.$mI."\n";
  }//toString

}//class Status

?>
