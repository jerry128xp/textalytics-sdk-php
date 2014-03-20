<?php //Result.php
require_once('domain/Category.php');
require_once('domain/Entity.php');
require_once('domain/Concept.php');
require_once('domain/TimeExpression.php');
require_once('domain/PhoneExpression.php');
require_once('domain/MoneyExpression.php');
require_once('domain/URI.php');
require_once('domain/Quotation.php');
require_once('domain/Issue.php');

/**
 * This class models the result element obtained from the API, taking into account all the possible
 * elements it may have, independently of the configuration.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class Result{

  public $id;//sent document id
  public $category_list;
  public $user_category_list;
  public $entity_list;
  public $concept_list;
  public $time_expression_list;
  public $money_expression_list;
  public $uri_list;
  public $phone_expression_list;
  public $quotation_list;
  public $issue_list;

  
  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param result array with the result as it's in the decoded output of the API
  */
  public function __construct($result){
    //initializes all the possible elements
    $this->id = $result['id'];
    $this->category_list = array();
    $this->user_category_list = array();
    $this->entity_list = array();
    $this->concept_list = array();
    $this->time_expression_list = array();
    $this->money_expression_list = array();
    $this->uri_list = array();
    $this->quotation_list = array();
    $this->phone_expression_list = array();
    $this->issue_list = array(); 
    foreach($result as $key=>$value) {
      if($key == 'category_list') $this->category_list = $value;
      else if($key == 'entity_list') $this->entity_list = $value;
      else if($key == 'concept_list') $this->concept_list = $value;
      else if($key == 'time_expression_list') $this->time_expression_list = $value;
      else if($key == 'money_expression_list') $this->money_expression_list = $value;
      else if($key == 'uri_list') $this->uri_list = $value;
      else if($key == 'quotation_list') $this->quotation_list = $value;
      else if($key == 'phone_expression_list') $this->phone_expression_list = $value;
      else if($key == 'issue_list') $this->issue_list = $value;
      else if($key == 'id') $this->id = $value;
      else $this->user_category_list = $value;
    }
    //maps the elements of the arrays into the corresponding objects
    $this->mapElements();  
  }//__construct


  //////////////////////// AUXILIARY FUNCTIONS //////////////////////////////////////  
  
 /**
  * Traverses all the different attributes that contain unmapped elements, and 
  * transforms them in the corresponding object, leaving the attributes as arrays
  * of objects instead of just an associative array.
  */
  private function mapElements(){
     $aux = '';
     if(!empty($this->category_list)){
       foreach($this->category_list as $c) {
         $category = new Category();
         $category->loadTaggedElement($c);
         $aux[] = $category;       
       }
       $this->category_list = $aux;
     }
     $aux = '';
     if(!empty($this->user_category_list)) {
       foreach($this->user_category_list as $u) {
         $user_category = new Category();
         $user_category->loadTaggedElement($u);
         $aux[] = $user_category;
       }
       $this->user_category_list = $aux;
     } 
     $aux = '';
     if(!empty($this->entity_list)){
       foreach($this->entity_list as $e) {
         $entity = new Entity();
         $entity->loadTaggedElement($e);
         $aux[] = $entity;
       }
       $this->entity_list = $aux;
     }
     $aux = '';
     if(!empty($this->concept_list)){
       foreach($this->concept_list as $c) {
         $concept = new Concept();
         $concept->loadTaggedElement($c);
         $aux[] = $concept;
       }
       $this->concept_list = $aux;
     }
     $aux = '';
     if(!empty($this->time_expression_list)){
       foreach($this->time_expression_list as $t)
         $aux[] = new TimeExpression($t);
       $this->time_expression_list = $aux;
     }
     $aux = '';
     if(!empty($this->money_expression_list)){
       foreach($this->money_expression_list as $m)
         $aux[] = new MoneyExpression($m);
       $this->money_expression_list = $aux;
     }
     $aux = '';
     if(!empty($this->uri_list)){
       foreach($this->uri_list as $u)
         $aux[] = new URI($u);
       $this->uri_list = $aux;
     }
     $aux = '';
     if(!empty($this->phone_expression_list)){
       foreach($this->phone_expression_list as $p)
         $aux[] = new PhoneExpression($p);
       $this->phone_expression_list = $aux;
     }    
     $aux = '';
     if(!empty($this->quotation_list)){
       foreach($this->quotation_list as $p)
         $aux[] = new Quotation($p);
       $this->quotation_list = $aux;
     }    
     $aux = '';
     if(!empty($this->issue_list)) {
       foreach($this->issue_list as $i)
         $aux[] = new Issue($i);
       $this->issue_list = $aux;
     }
  }//mapElements


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a result
  * 
  */
  public function toString(){
    $output = '';
    if(!empty($this->category_list)){
      $output .= "------------------\nCATEGORIES\n------------------\n";
      foreach($this->category_list as $c)
        $output .= $c->toString();
    }
    if(!empty($this->user_category_list)){
      $output .= "------------------\nUSER'S CATEGORIES\n------------------\n";
      foreach($this->user_category_list as $u)
        $output .= $u->toString();
    }
    if(!empty($this->entity_list)){
      $output .= "------------------\nENTITIES\n------------------\n";
      foreach($this->entity_list as $e)
        $output .= $e->toString();
    }
    if(!empty($this->concept_list)){
      $output .= "------------------\nCONCEPTS\n------------------\n";
      foreach($this->concept_list as $c)
        $output .= $c->toString();
    }
    if(!empty($this->time_expression_list)){
      $output .= "------------------\nTIME EXPRESSIONS\n------------------\n";
      foreach($this->time_expression_list as $t)
        $output .= $t->toString();
    }
    if(!empty($this->money_expression_list)){
      $output .= "------------------\nMONEY EXPRESSIONS\n------------------\n";
      foreach($this->money_expression_list as $m)
        $output .= $m->toString();
    }
    if(!empty($this->uri_list)){
      $output .= "------------------\nURIs\n------------------\n";
      foreach($this->uri_list as $u)
        $output .= $u->toString();
    }
    if(!empty($this->phone_expression_list)){
      $output .= "------------------\nPHONE EXPRESSIONS\n------------------\n";
      foreach($this->phone_expression_list as $p)
        $output .= $p->toString();
    }
    if(!empty($this->quotation_list)){
      $output .= "------------------\nQUOTATIONS\n------------------\n";
      foreach($this->quotation_list as $q)
        $output .= $q->toString();
    }
    if(!empty($this->issue_list)) {
      $output .= "------------------\nISSUES\n------------------\n";
      foreach($this->issue_list as $i)
        $output .= $i->toString();
    }
    return $output;
  }//toString

}//class Result

?>
