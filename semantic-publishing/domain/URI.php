<?php //URI.php
/**
 * This class models the URI expressions extracted in the analysis of the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class URI{

  //fields
  public $form;
  public $type;
  public $inip;
  public $endp;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array uri array with the URI expression
  */
  public function __construct($uri) {
    $this->form = isset($uri['form']) ? $uri['form'] : '';
    $this->type = isset($uri['type']) ? $uri['type'] : '';
    $this->inip = isset($uri['inip']) ? $uri['inip'] : '';
    $this->endp = isset($uri['endp']) ? $uri['endp'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a URI expression 
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t$name: ".$value."\n";
    if(!empty($output))
      $output = "URI:\n".$output;
    return $output;
  }//toString


}//class URI

?>
