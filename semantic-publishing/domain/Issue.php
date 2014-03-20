<?php //Issue.php
require_once('auxiliary/Suggestion.php');

/**
 * This class models the issues found in the text.
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class Issue{

  public $text;
  public $type;
  public $msg;
  public $sugList;
  public $inip;
  public $endp;

  /////////////////////// CONSTRUCTOR FUNCTIONS /////////////////////////////////////
  
 /**
  * Class constructor
  *
  * @param array issue with the issue detected
  */
  public function __construct($issue){
    $this->text = isset($issue['text']) ? $issue['text'] : '';
    $this->type = isset($issue['type']) ? $issue['type'] : '';
    $this->sugList = array();
    if(isset($issue['sug_list'])) {
      foreach($issue['sug_list'] as $sug) {
        $this->sugList[] = new Suggestion($sug);
      }
    }
    $this->msg = isset($issue['msg']) ? $issue['msg'] : '';
    $this->inip = isset($issue['inip']) ? $issue['inip'] : '';
    $this->endp = isset($issue['endp']) ? $issue['endp'] : '';
  }//__construct


  ////////////////////////// OUTPUT FUNCTIONS ///////////////////////////////////////
  
 /**
  * Returns a string ready to print with all the attributes of a issue 
  * 
  */
  public function toString(){
    $output = '';
    $aFields = get_object_vars($this);
    foreach($aFields as $name => $value) {
      if(is_array($value)) {
        $aux = '';
        foreach($value as $sug => $v) {
          if(!empty($aux))
            $aux .= "\t\t--\n"; 
          $aux .= $v->toString();
        }
        if(!empty($aux))
          $output .= "\tSuggestions:\n".$aux;
      } else if($value != '')
        $output .= "\t$name: ".$value."\n";
    }
    if(!empty($output))
      $output = "Issue:\n".$output;
    return $output;
  }//toString

}//class Issue 

?>
