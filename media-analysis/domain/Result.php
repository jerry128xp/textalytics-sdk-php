<?php
require_once('domain/Category.php');
require_once('domain/Entity.php');
require_once('domain/Concept.php');
require_once('domain/TimeExpression.php');
require_once('domain/MoneyExpression.php');
require_once('domain/URI.php');
require_once('domain/PhoneExpression.php');

/**
 * This class models the result element obtained from the API, taking into account all the possible
 * elements it may have, independently of the configuration.
 */
class Result{


  private $id;
  private $sentiment;
  private $categories;
  private $entities;
  private $concepts;
  private $timeExpressions;
  private $moneyExpressions;
  private $uris;
  private $phoneExpressions;


 /**
  * Class constructor
  *
  * @param $result array with the result as it's in the decoded output of the API
  */
  public function __construct($result){
    //initializes all the possible elements
    $this->id = $result['id'];
    $this->sentiment = isset($result['sentiment']) ? $result['sentiment'] : '';
    $this->categories = isset($result['categories']) ? $result['categories'] : array();
    $this->entities = isset($result['entities']) ? $result['entities'] : array();
    $this->concepts = isset($result['concepts']) ? $result['concepts'] : array();
    $this->timeExpressions = isset($result['timeExpressions']) ? $result['timeExpressions'] : array();
    $this->moneyExpressions = isset($result['moneyExpressions']) ? $result['moneyExpressions'] : array();
    $this->uris = isset($result['uris']) ? $result['uris'] : array();
    $this->phoneExpressions = isset($result['phoneExpressions']) ? $result['phoneExpressions'] : array();

    //maps the elements of the arrays into the corresponding objects
    $this->mapElements();
  }//__construct

 /**
  * Access the attribute "id"
  *
  * @return string with the id of the document analyzed
  */
  public function getId(){
    return $this->id;
  }//getId

 /**
  * Access the attribute "sentiment"
  *
  * @return string with the sentiment analysis for the text
  */
  public function getSentiment(){
    return $this->sentiment;
  }//getSentiment

 /**
  * Access the attribute "categories"
  *
  * @return array with all the Category elements in which the text is classified.
  */
  public function getCategories(){
    return $this->categories;
  }//getCategories


 /**
  * Access the attribute "entities"
  *
  * @return array with all the Entity elements found in the text
  */
  public function getEntities(){
    return $this->entities;
  }//getEntities

 /**
  * Access the attribute "concepts"
  *
  * @return array with all the Concept elements found in the text
  */
  public function getConcepts(){
    return $this->concepts;
  }//getConcepts


 /**
  * Access the attribute "timeExpressions"
  *
  * @return array with all the Time Expression elements found in the text
  */
  public function getTimeExpressions(){
    return $this->timeExpressions;
  }//getTimeExpressions

 /**
  * Access the attribute "moneyExpressions"
  *
  * @return array with all the Money Expressions elements found in the text
  */
  public function getMoneyExpressions(){
    return $this->moneyExpressions;
  }//getMoneyExpressions

 /**
  * Access the attribute "uris"
  *
  * @return array with all the URI elements found in the text
  */
  public function getUris(){
    return $this->uris;
  }//getUris

 /**
  * Access the attribute "phoneExpressions"
  *
  * @return array with all the PhoneExpression elements found in the text
  */
  public function getPhoneExpressions(){
    return $this->phoneExpressions;
  }//getPhoneExpressions


 /**
  * Traverses all the different attributes that contain unmapped elements, and 
  * transforms them in the corresponding object, leaving the attributes as arrays
  * of objects instead of just an associative array.
  */
  private function mapElements(){

     $aux = '';
     if(!empty($this->categories)){
       foreach($this->categories as $c)
         $aux[] = new Category($c);       
       $this->categories = $aux;
     }
     $aux = '';
     if(!empty($this->entities)){
       foreach($this->entities as $e)
         $aux[] = new Entity($e);
       $this->entities = $aux;
     }
     $aux = '';
     if(!empty($this->concepts)){
       foreach($this->concepts as $c)
         $aux[] = new Concept($c);
       $this->concepts = $aux;
     }
     $aux = '';
     if(!empty($this->timeExpressions)){
       foreach($this->timeExpressions as $t)
         $aux[] = new TimeExpression($t);
       $this->timeExpressions = $aux;
     }
     $aux = '';
     if(!empty($this->moneyExpressions)){
       foreach($this->moneyExpressions as $m)
         $aux[] = new MoneyExpression($m);
       $this->moneyExpressions = $aux;
     }
     $aux = '';
     if(!empty($this->uris)){
       foreach($this->uris as $u)
         $aux[] = new URI($u);
       $this->uris = $aux;
     }
     $aux = '';
     if(!empty($this->phoneExpressions)){
       foreach($this->phoneExpressions as $p)
         $aux[] = new PhoneExpression($p);
       $this->phoneExpressions = $aux;
     }    
  }//mapElements


 /**
  * Prints the results obtained for a text
  */
  public function printElements(){
     echo "\n\n";
     if(!empty($this->sentiment))
       echo "SENTIMENT: ".$this->sentiment."\n";
     if(!empty($this->categories)){
       echo "CATEGORIES:\n";
       foreach($this->categories as $c)
         $c->printElem();
     }
     if(!empty($this->entities)){
       echo "ENTITIES:\n";
       foreach($this->entities as $e)
         $e->printElem();
     }
     if(!empty($this->concepts)){
       echo "CONCEPTS:\n";
       foreach($this->concepts as $c)
         $c->printElem();
     }
     if(!empty($this->timeExpressions)){
       echo "TIME EXPRESSIONS:\n";
       foreach($this->timeExpressions as $t)
         $t->printElem();
     }
     if(!empty($this->moneyExpressions)){
       echo "MONEY EXPRESSIONS:\n";
       foreach($this->moneyExpressions as $m)
         $m->printElem();
     }
     if(!empty($this->uris)){
       echo "URIS:\n";
       foreach($this->uris as $u)
         $u->printElem();
     }
     if(!empty($this->phoneExpressions)){
       echo "PHONE EXPRESSIONS:\n";
       foreach($this->phoneExpressions as $p)
         $p->printElem();
     }
     echo "\n\n";
  }//printElemElements

}//class Result

?>
