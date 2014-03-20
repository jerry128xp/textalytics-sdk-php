<?php //Geo.php

/**
 * This class models the geo elements in the semantic publishing output 
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved. 
 * */

class Geo{

  //possible fields
  public $continent;
  public $country;
  public $adm1;
  public $adm2;
  public $adm3;
  public $city;
  public $district;

  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Maps the geo fields defined
  * 
  * @param geo array with the geo element as it appears in semantic tagging
  */
  public function __construct($geo){
    $this->continent = isset($geo['continent']) ? $geo['continent'] : '';
    $this->country = isset($geo['country']) ? $geo['country'] : '';
    $this->adm1 = isset($geo['adm1']) ? $geo['adm1'] : '';
    $this->adm2 = isset($geo['adm2']) ? $geo['adm2'] : '';
    $this->adm3 = isset($geo['adm3']) ? $geo['adm3'] : '';
    $this->city = isset($geo['city']) ? $geo['city'] : '';
    $this->district = isset($geo['district']) ? $geo['district'] : '';
       
  }//__construct

  
  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
  /**
   * 
   * Returns the object geo as a string 
   */
  public function toString(){
    $str = '';    
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $str .= "\t\t$name: ".$value."\n";    
    return $str;
  }//toString
  
}//class Geo

?>
