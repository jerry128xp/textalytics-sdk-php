<?php
/**
 * This class models the phone expressions extracted in the analysis of the text.
 */
class PhoneExpression{

  private $form;

 /**
  * Class constructor
  *
  * @param $phoneExp array with the phone expression
  */
  public function __construct($phoneExp){
    $this->form = $phoneExp['form'];
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the phone expression
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Prints all the attributes of a Phone Expression element
  */
  public function printElem(){
    echo "\t".$this->form."\n";
  }//printElem

}//class PhoneExpression

?>
