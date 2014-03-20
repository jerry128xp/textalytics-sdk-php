<?php //Stats.php

/**
 * Stats class represents the stats object field in a dictionary/model when reading the 
 * User Resources Management service response.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Stats{

  public $entries;
  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
    
 /**
  * Class constructor
  *
  * @param stats array with the stats
  * @param resource type of the resource (dictionary / model)
  */
  public function __construct($stats, $resource){
    if($resource == 'dictionary')
      $this->entries = $stats['entries'];
    else // model
      $this->entries = $stats['categories'];
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a model 
  *
  */
  public function toString() {
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value)
      if($value != '')
        $output .= "\t\t$name: ".$value."\n";
    if(!empty($output))
      $output = "\tStats:\n".$output;
    return $output;
  }//toString


}//class Stats 

?>
