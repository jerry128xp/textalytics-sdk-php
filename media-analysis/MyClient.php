<?php
/***********************************************************************************/
/* This file implements a simple PHP5 client for Daedalus' Media Analysis API      */
/*                                                                                 */
/* It will process the text specified, either as plain text (-txt) or in a file    */
/* (-file); it will be sent to the API through a POST request an the answer will   */
/* be processes, printing the elements that have been requested through a          */
/* parameter (-what). The key to call the API will also have to be passed as       */
/* through the arguments (-key).                                                   */
/*                                                                                 */
/***********************************************************************************/

require_once('SMAClient.php');



//initializes the client and runs it
$myClient = new MyClient($argv);
$myClient->run();



/**
 * This class is an example of how the SMA API is used
 */
class MyClient{

  private $what;//elements to extract
  private $txt;//text to analyze
  private $key;

  /**
   * Class constructor
   *
   * @param $argv arguments passed as parameters to the script
   */
  public function __construct($argv){
    $this->readArguments($argv);
  }//__construct

  
  /**
   * Main function of the class, carries out the functionality defined
   */
  public function run(){

    $smaClient = new SMAClient($this->what, $this->key);
    $result = $smaClient->analyze($smaClient->createDocument($this->txt, 'en', 'myID', 'TWITTER', '', 'txt'));
    if($result)
      $result->printElements();

  }//run

  /**
   * Reads the arguments passed as parameters and checks that they are correct
   *
   * @param $argv array with the parameters
   */
  private function readArguments($argv){
    if(isset($argv) && sizeof($argv) == 4){
      $whatFlag = false;
      $textFlag = false;
      $noKey = false;
      foreach($argv as $a){
        $p = explode('=',$a);
        if($p[0] == '-key'){//reads the key
          $this->key = $p[1];
          $noKey = true;
        }
        if($p[0] == '-txt'){//reads text
          $textFlag = true;
          $this->txt = $p[1];
        }elseif($p[0] == '-file'){//reads file
          $textFlag = true;
          if(!is_file($p[1]))
            exit('The value for \'-file\' is not a file!');
          $content = @file_get_contents($p[1]);
          if(!$content) exit('There was a problem reading the file!');
          else $this->txt = $content;
        }
        if($p[0] == '-what'){//reads elements to extract
          $whatFlag = true;
          $this->what = $p[1];
        }
      }
      if(!$noKey)
        exit("\nMake sure you specify the key to use in the API request using '-key=<key>'\n\n");
      if(!$whatFlag)
        exit("\nMake sure you specify the elements to extract using '-what=<elements>'\n\n");
      if(!$textFlag)
        exit("\nMake sure you specify the text to analyze using either '-txt=<text>' or '-file=<filename>'\n\n");
    }else
      exit("\nSome parameters are missing, make sure you have included with the correct syntaxis:\n
              -key=<key>  --> key to use in the requet\n
              -what=<elements>  --> the elements to extract, separated by '|' and between quotes\n
              -txt=<text> or -file=<filename>  --> the text to analyze\n\n");

  }//readArguments

}//class MyClient


?>
