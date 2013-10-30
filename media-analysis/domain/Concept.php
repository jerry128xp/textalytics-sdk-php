<?php

/**
 * This class models the concepts in the analysis of the text.
 */
class Concept{

  private $form;
  private $variants;//appearances of the concept in the text
  private $relevance;

 /**
  * Class constructor
  *
  * @param $concept array with the concept
  */
  public function __construct($concept){
    $this->form = $concept['form'];
    $this->relevance = $concept['relevance'];

    if(is_array($concept['variants'])){
      foreach($concept['variants'] as $var)
        $this->variants[] = $var;
    }elseif(!empty($concept['variants']))
      $this->variants[] = $concept['variants'];
    else $this->variants = array ();  
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the concept
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Access the attribute "variants"
  *
  * @return array with the variants (appearances) of the concept in the text
  */
  public function getVariants(){
    return $this->variants;
  }//getVariants

 /**
  * Access the attribute "relevance"
  *
  * @return string with the relevance of the concept
  */
  public function getRelevance(){
    return $this->relevance;
  }//getRelevance

 /**
  * Prints all the attributes of a Concept element
  */
  public function printElem(){
    echo "\t".$this->form."\t[";
    $vs = '';
    foreach($this->variants as $k=>$v){
      if($k == 0) $vs .= $v;
      else $vs .= $v."|";
    }
    echo $vs.", ".$this->relevance."]\n";
  }//printElem


}//class Concept

?>
