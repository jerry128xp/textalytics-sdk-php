<?php
require_once('domain/Status.php');
require_once('domain/Result.php');

/**
 * This class models the response that will be received from the API
 */
class Response{

  private $status;//status of the response
  private $result;//result if there has been any

/**
 * Class constructor
 *
 * @params $response string with the reply from the API
 * @return boolean false if the result has not been successful
 */
  public function __construct($response){
    $decoded = json_decode($response, true);
    $this->status = new Status ($decoded['status']); 
    if(!$this->status->checkStatus())
      return false;
    else
      $this->result = new Result ($decoded['result']); 
    return true;
  }//__construct


/**
 * Accesses the class attribute "result"
 *
 * @return Result object
 */
  public function getResult(){
    return $this->result;
  }//getResult

}//class Response

?>
