<?php //Quotation.php

/**
 * This class models the quotations extracted in the analysis of the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Quotation{

  //possible fields
  public $form;
  public $who;
  public $who_lemma;
  public $verb;
  public $verb_lemma;
  public $inip;
  public $endp;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array quotation array with the quotation
  */
  public function __construct($quotation){
    $this->form = isset($quotation['form']) ? $quotation['form'] : '';
    $this->who = isset($quotation['who']) ? $quotation['who'] : '';
    $this->who_lemma = isset($quotation['who_lemma']) ? $quotation['who_lemma'] : '';
    $this->verb = isset($quotation['verb']) ? $quotation['verb'] : '';
    $this->verb_lemma = isset($quotation['verb_lemma']) ? $quotation['verb_lemma'] : '';
    $this->inip = isset($quotation['inip']) ? $quotation['inip'] : '';
    $this->endp = isset($quotation['endp']) ? $quotation['endp'] : '';
  }//__construct

  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a quotation 
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "Quotation:\n".$output;
    return $output;
  }//toString

}//class Quotation 

?>
