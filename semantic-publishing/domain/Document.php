<?php //Document.php

/**
 * This class models the document that will be sent to the API including the text to
 * analyze and some other operating options.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Document{

  private $id;//id of the document
  private $source;
  private $txt;
  private $itf;//format of the input text
  private $language;
  private $timeref;//time reference for the time expressions

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param string id of the document (64 characters max, alphanumeric characters, dashes and underscores)
  * @param string source where the text comes from (64 characters max)
  * @param string text with the text in the document
  * @param string timeref time reference (format: YYYY-MM-DD hh:mm:ss GMT±HH:MM)
  * @param string language language in which the text will be analyzed (es|en)
  * @param string itf format of the input text (plain|markup, by default plain)
  */
  public function __construct($id, $source, $txt, $timeref, $language = 'es', $itf = 'plain'){
    $this->id = $id;
    $this->source = $source;
    $this->language = $language;
    $this->txt = $txt;
    $this->timeref = $timeref;
    $this->itf = $itf;
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a json string with a document element 
  *
  */
  public function toJsonString(){
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      $doc['document'][$name] = $value;
    return json_encode($doc);
  }//toJsonString


 /**
  * Returns a string ready to print with all the attributes of a document  
  *
  */
  public function toString() {
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "Document:\n".$output;
    return $output;
  }//toString

}//class Document

?>
