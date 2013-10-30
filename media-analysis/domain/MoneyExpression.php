<?php
/**
 * This class models the money expressions extracted in the analysis of the text.
 */
class MoneyExpression{

  private $form;//how it appears in the text
  private $amount;//amount of money (numeric value)
  private $currency;//currency (ISO4217)

 /**
  * Class constructor
  *
  * @param $moneyExp array with the money expression
  */
  public function __construct($moneyExp){
    $this->form = $moneyExp['form'];
    $this->amount = $moneyExp['amount'];
    $this->currency = $moneyExp['currency'];
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the money expression
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Access the attribute "amount"
  *
  * @return string with the amount of the money expression (numeric value)
  */
  public function getAmount(){
    return $this->amount;
  }//getAmount

 /**
  * Access the attribute "currency"
  *
  * @return string with the currency of the money expression
  */
  public function getCurrency(){
    return $this->currency;
  }//getCurrency

 /**
  * Prints all the attributes of a Money Expression element
  */
  public function printElem(){
    echo "\t".$this->form."\t[".$this->amount.", ".$this->currency."]\n";
  }//printElem

}//class MoneyExpression

?>
