<?php
/**
 * This class models the status element that will provide information on the success of
 * the request to the API
 */
class Status{

  private $code;
  private $message;
  private $moreInfo;

 /**
  * Class constructor
  *
  * @param $status array with the status response from the API
  */
  public function __construct($status){
    $this->code = $status['code'];
    $this->message = $status['message'];
    $this->moreInfo = isset($status['moreInfo']) ? $status['moreInfo'] : '';
  }//__construct

 /**
  * Checks if the status received has been successful and prints the error when
  * it is not.
  *
  * @return boolean true if the response has been carried out without errors
  */

  public function checkStatus(){
    if(empty($this->code))
      return true;
    $this->printStatus();
    return false;
  }//checkStatus
  
 /**
  * Prints the values of the attributes
  */
  public function printStatus(){
    $mI = !empty($this->moreInfo) ? (" (".$this->moreInfo.")") : '';
    echo "\n\nERROR: ".$this->code.": ".$this->message.$mI."\n\n";
  }//printStatus
}//class Status

?>
