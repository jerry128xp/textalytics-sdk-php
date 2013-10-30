<?php

/**
 * This class models the document that will be sent to the API including the text to
 * analyze and some other operating options.
 */

class Document{

  private $id;//id of the document
  private $source;
  private $text;
  private $itf;//format of the input text
  private $language;
  private $timeref;//time reference for the time expressions


 /**
  * Class constructor
  *
  * @param $id id of the document (64 characters max)
  * @param $source source of the text (64 characters max)
  * @param $language language in which the text will be analyzed (es|en)
  * @param $text text in the document
  * @param $timeref time reference (format: YYYY-MM-DD hh:mm:ss GMT±HH:MM)
  * @param $itf format of the input text (txt|html, by default txt)
  */
  public function __construct($id, $source, $language, $text, $timeref, $itf = 'txt'){
    $this->id = $id;
    $this->source = $source;
    $this->language = $language;
    $this->text = $text;
    $this->timeref = $timeref;
    $this->itf = $itf;
  }//__construct


 /**
  * This function creates the JSON document that will be sent to the API
  *
  * @param $id id that will be assigned to the document
  * @param $txt text that's going to be analyzed
  * @param $itf format of the input text
  * @param $lang language of the text (english by default)
  * @param $source source of the text (empty by default)
  * @param $url timeref time reference for the time expressions (empty by default)
  * @return string with the json document
  */
  public function convertToJSON(){
    $doc = array('document' => array('id' => $this->id,
                                     'txt' => $this->text,
                                     'itf' => $this->itf,
                                     'language' => $this->language,
                                     'source' => $this->source,
                                     'timeref' => $this->timeref));
    return json_encode($doc);
  }//convertToJSON

}//class Document


?>
