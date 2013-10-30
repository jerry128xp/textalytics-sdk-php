<?php

/**
 * This class models the categories elements obtained in the classification of the text.
 */

class Category{

  private $code;//IPTC category code
  private $labels;//textual labels of the IPTC category
  private $relevance;

 /**
  * Class constructor
  *
  * @param $cat array with the category
  */
  public function __construct($cat){
    $this->code = $cat['code'];
    $this->relevance = $cat['relevance'];
    if(is_array($cat['labels'])){
      foreach($cat['labels'] as $lab)
        $this->labels[] = $lab;
    }elseif(!empty($cat['labels']))
      $this->labels[] = $cat['labels'];
    else $this->labels = array ();  
  }//__construct

 /**
  * Access the attribute "code"
  *
  * @return string with the IPTC category code
  */
  public function getCode(){
    return $this->code;
  }//getCode

 /**
  * Access the attribute "labels"
  *
  * @return array with the labels that describe the IPTC category
  */
  public function getLabels(){
    return $this->labels;
  }//getLabels

 /**
  * Access the attribute "relevance"
  *
  * @return string with the relevance of the category
  */
  public function getRelevance(){
    return $this->relevance;
  }//getRelevance

 /**
  * Prints all the attributes of a Category element
  */
  public function printElem(){
    echo "\t".$this->code."\t[";
    $vs = '';
    foreach($this->labels as $k=>$v){
      if($k == 0) $vs .= $v;
      else $vs .= $v."|";
    }
    echo $vs.", ".$this->relevance."]\n";
  }//printElem


}//class Category

?>
