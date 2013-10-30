<?php

/**
 * This class models the element that will be used to carry out the POST requet
 * to the API
 */

class Post{

  private $params;//parameters of the POST request
  private $service;//url where the request is sent

/**
 * Class constructor
 *
 * @params $params array with the parameters that will be sent in the POST request
 * @params $service string with the url where the request will be sent 
 */
  public function __construct($params, $service){
    $this->params = $params;
    $this->service = $service;
  }//__construct

 /**
   * This function carries out a POST request to the API, sending the required parameters
   * as they are defined in the input parameter tipos de llamadas).
   *
   * @param $params array with the parameters the POST will have
   * @return string with the API response or false if the request failed
   */
  public function sendPost() {
    $context = stream_context_create(
    array('http'=>array(
      'method' =>'POST',
      'header' => (isset($_SERVER['HTTP_USER_AGENT']) ? 'User-Agent: '.$_SERVER['HTTP_USER_AGENT']."\r\n" : '').
                  'Content-type: application/x-www-form-urlencoded'."\r\n",
      'ignore_errors' => 1,
      'content' => http_build_query($this->params))));
    $fp = fopen($this->service, 'r', false, $context);
    if($fp != NULL){
      $response = stream_get_contents($fp);
      fclose($fp);
    }else return false;
    return $response;
  } // sendPost
}//class Post


?>
