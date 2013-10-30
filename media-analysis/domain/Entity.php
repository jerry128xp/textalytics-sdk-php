<?php
/**
 * This class models the entities extracted in the analysis of the text.
 */
class Entity{

  private $form;
  private $type;
  private $variants;//appearances of the entity in the text
  private $relevance;


 /**
  * Class constructor
  *
  * @param $ent array with the entity
  */
  public function __construct($ent){
    $this->form = $ent['form'];
    $this->type = $ent['type'];
    $this->relevance = $ent['relevance'];

    if(is_array($ent['variants'])){
      foreach($ent['variants'] as $var)
        $this->variants[] = $var;
    }elseif(!empty($ent['variants']))
      $this->variants[] = $ent['variants'];
    else $this->variants = array ();  
  }//__construct

 /**
  * Access the attribute "form"
  *
  * @return string with the form associated to the entity
  */
  public function getForm(){
    return $this->form;
  }//getForm

 /**
  * Access the attribute "type"
  *
  * @return string with the type of entity
  */
  public function getType(){
    return $this->form;
  }//getType

 /**
  * Access the attribute "variants"
  *
  * @return array with the variants (appearances) of the entity in the text
  */  
  public function getVariants(){
    return $this->variants;
  }//getVariants

 /**
  * Access the attribute "relevance"
  *
  * @return string with the relevance of the entity
  */
  public function getRelevance(){
    return $this->relevance;
  }//getRelevance


 /**
  * Prints all the attributes of an entity
  */
  public function printElem(){
    echo "\t".$this->form."\t[".$this->type.", ";
    $vs = '';
    foreach($this->variants as $k=>$v){
      if($k == 0) $vs .= $v;
      else $vs .= $v."|";
    }
    echo $vs.", ".$this->relevance."]\n";
  }//printElem 

}//class Entity

?>
