<?php
require_once('config.inc');
require_once('Post.php');
require_once('Document.php');
require_once('Response.php');


/**
 * This class implements the basic behavior of the SMA API
 */

class SMAClient{

  private $url;//url to call the API
  private $key;//password to use the API
  private $what;//elements to extract
  private $post;//post object
  private $response;//response from the API

  /**
   * Class constructor
   *
   * @param $key password to use the API
   * @param $what elements to extract from the text
   */
  public function __construct($what, $key){
    $this->url = SERVICE_URL;
    $this->key = $key;
    $this->what = $what;
  }//__construct


  /**
   * This function analyses the json document passed as a parameter following the 
   * configuration specified in it.
   *
   * @param $document is a string with the document to send in JSON format.
   * @return Result object with the result obtained from the API or false if there was an error
   */

  public function analyze($document){
    //builds the array with the parameters necessary for the POST request
    $params = array('key' => $this->key,
                    'input' => 'json',
                    'output' => 'json',
                    'fields' => $this->what,
                    'doc' => $document);
    $post = new Post($params, $this->url);   
    $response = new Response($post->sendPost());
    if(!$response)
      return false;
    return $response->getResult();
  }//analyze


  /**
   * This function creates a document in the format necessary for the API to analyze it.
   *
   * @param $text string with the text to analyze.
   * @param $language string with the language in which the text will be analyzed.
   * @param $id string with the id of the document.
   * @param $source string with the source value associated to the text.
   * @param $timeref string with the time reference parameter.
   * @param $itf input text format.
   * @return Result object with the result obtained from the API
   */
  public function createDocument($text,  $language, $id, $source, $timeref, $itf){
    $doc = new Document($id, $source, $language, $text, $timeref, $itf);
    return $doc->convertToJSON();    
  }//createDocument



}//class SMAClient

?>
