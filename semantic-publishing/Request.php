<?php  //Request.php

/**
 * This class models the element that will be used to carry out the requests
 * to the API
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 * */

class Request{

  private $params;//array with the parameters of the request
  private $url;//url where the request is sent

/**
 * Class constructor
 *
 * @param string url with the url where the request will be sent 
 * @param array params with the parameters that will be sent in the POST request
 */
  public function __construct($url, $params){
    $this->params = $params;
    $this->url = $url;
  }//__construct

 /**
   * This function carries out a POST request to the API, sending the required parameters
   * as they are defined in the input parameter.
   *
   * @return array with two elements, the API response and the HTTP response 
   */
  public function sendPOST() {
    $context = stream_context_create(
    array('http'=>array(
      'method' =>'POST',
      'header' => (isset($_SERVER['HTTP_USER_AGENT']) ? 'User-Agent: '.$_SERVER['HTTP_USER_AGENT']."\r\n" : '').
                  'Content-type: application/x-www-form-urlencoded'."\r\n",
      'ignore_errors' => 1,
      'content' => http_build_query($this->params))));
    $fp = fopen($this->url, 'r', false, $context);
    if($fp != NULL){
      $response = array('http-response' => $http_response_header, 'api-response' => stream_get_contents($fp));
      fclose($fp);
    }else $response = array('http-response' => $http_response_header);
    return $response;
  } // sendPOST

  
  /**
   * This function carries out a GET request to the API
   *
   * @return array with two elements, the API response and the HTTP response 
   */
  
  function sendGET(){
    //builds the string with the parameters to send    
    $content = '';
    foreach($this->params as $k=>$val)
      $content .= '&'.$k.'='.rawurlencode($val);    
    $content = substr($content, 1, strlen($content));//removes the first &
    $context = stream_context_create(array('http'=>array('ignore_errors' => 1)));
    $r = @file_get_contents($this->url.'?'.$content, false, $context);
    if($r !== false)
      $response = array('http-response' => $http_response_header, 'api-response' => $r);
    else $response = array('http-response' => $http_response_header);
    return $response;
  }//sendGET
  
  /**
   * This function carries out a DELETE request to the API
   *
   * @return array with two elements, the API response and the HTTP response 
   */
  
  function sendDELETE(){
    //builds the string with the parameters to send
    $content = '';
    foreach($this->params as $k=>$val)
        $content .= '&'.$k.'='.rawurlencode($val);
    $content = substr($content, 1, strlen($content));//removes the first &
    $context = stream_context_create(array('http'=>array('method' =>'DELETE', 'ignore_errors' => 1)));
    $r = @file_get_contents($this->url.'?'.$content, false, $context);
    if($r !== false)
      $response = array('http-response' => $http_response_header, 'api-response' => $r);
    else $response = array('http-response' => $http_response_header);
    return $response;
  }//sendDELETE
  
  /**
   * This function carries out a PUT request to the API
   *
   * @return array with two elements, the API response and the HTTP response 
   */
  
  function sendPUT(){
    $context = stream_context_create(
    array('http'=>array(
      'method' =>'PUT',
      'header' => (isset($_SERVER['HTTP_USER_AGENT']) ? 'User-Agent: '.$_SERVER['HTTP_USER_AGENT']."\r\n" : '').
                  'Content-type: application/x-www-form-urlencoded'."\r\n",
      'ignore_errors' => 1,
      'content' => http_build_query($this->params))));
    $fp = @fopen($this->url, 'r', false, $context);
    if($fp != NULL){
      $response = array('http-response' => $http_response_header, 'api-response' => stream_get_contents($fp));
      fclose($fp);
    }else $response = array('http-response' => $http_response_header);
    return $response;
  }//sendPUT

}//class Request


?>
