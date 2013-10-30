<?php
/**
 * This class models the time expressions extracted in the analysis of the text.
 */
class TimeExpression{

  private $form;//hoy it appears in the text
  private $date;//date equivalent (YYYY-MM-DD)
  private $time;//time equivalent (HH:MM:SS GMT±HH:MM)

 /**
  * Class constructor
  *
  * @param $timeExp array with the time expression
  */
  public function __construct($timeExp){
    $this->form = $timeExp['form'];
    $this->date = $timeExp['date'];
    $this->time = $timeExp['time'];
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the time expression
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Access the attribute "date"
  *
  * @return string with the date (YYYY-MM-DD)
  */
  public function getDate(){
    return $this->date;
  }//getDate

 /**
  * Access the attribute "time"
  *
  * @return string with the time (HH:MM:SS GMT±HH:MM)
  */
  public function getTime(){
    return $this->time;
  }//getTime

 /**
  * Prints all the attributes of a Time Expression element
  */
  public function printElem(){
    echo "\t".$this->form."\t[".$this->date.", ".$this->time."]\n";
  }//printElem

}//class TimeExpression

?>
