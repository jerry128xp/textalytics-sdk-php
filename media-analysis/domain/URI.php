<?php
/**
 * This class models the URI expressions extracted in the analysis of the text.
 */
class URI{

  private $form;
  private $type;

 /**
  * Class constructor
  *
  * @param $uri array with the URI expression
  */
  public function __construct($uri){
    $this->form = $uri['form'];
    $this->type = $uri['type'];
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the uri
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Access the attribute "type"
  *
  * @return string with the type of URI expression
  */
  public function getType(){
    return $this->type;
  }//getType

 /**
  * Prints all the attributes of a URI expression
  */
  public function printElem(){
    echo "\t".$this->form."\t[".$this->type."]\n";
  }//printElem


}//class URI

?>
