<?php //Standard.php

/**
 * This class models the standard elements in the semantic publishing output 
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved. 
 * */

class Standard{

  //possible fields
  public $BCBA;
  public $BCS;
  public $BVL;
  public $BMAD;
  public $Euronext;
  public $ISO3166_1_a2;
  public $ISO3166_1_a3;
  public $ISO4217;
  public $ISO639_1;
  public $ISO639_2;
  public $ISO639_3;
  public $ISO639_5;
  public $ISO8601;
  public $LSE;
  public $LuxSE;
  public $NASDAQ;
  public $NYSE;
  
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the standard fields defined
  * 
  * @param std array with the standard element as it appears in semantic tagging
  */
  public function __construct($std){
    foreach($std as $name=>$val){ 
      $this->BCBA = ($name == 'BCBA') ? $val : '';
      $this->BCS = ($name == 'BCS') ? $val : '';
      $this->BVL = ($name == 'BVL') ? $val : '';
      $this->BMAD = ($name == 'BMAD') ? $val : '';
      $this->Euronext = ($name == 'Euronext') ? $val : '';
      $this->ISO3166_1_a2 = ($name == 'ISO3166-1-a2') ? $val : '';
      $this->ISO3166_1_a3 = ($name == 'ISO3166-1-a3') ? $val : '';
      $this->ISO4217 = ($name == 'ISO4217') ? $val : '';
      $this->ISO639_1 = ($name == 'ISO639-1') ? $val : '';
      $this->ISO639_2 = ($name == 'ISO639-2') ? $val : '';
      $this->ISO639_3 = ($name == 'ISO639-3') ? $val : '';
      $this->ISO639_5 = ($name == 'ISO639-5') ? $val : '';
      $this->ISO8601 = ($name == 'ISO8601') ? $val: '';
      $this->LSE = ($name == 'LSE') ? $val : '';
      $this->LuxSE = ($name == 'LuxSE') ? $val : '';
      $this->NASDAQ = ($name == 'NASDAQ') ? $val : '';
      $this->NYSE = ($name == 'NYSE') ? $val : '';    
    }
  }//__construct
  
  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
    
  /**
   * 
   * Returns the object standard as a string 
   */
  public function toString(){
    $str = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $str .= "\t\t".str_replace('_','-',$name).': '.$value."\n";
    
    return $str;
  }//toString
  
}//class Standard



?>
