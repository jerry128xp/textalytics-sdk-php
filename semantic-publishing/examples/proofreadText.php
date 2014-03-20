<?//proofreadingText.php
require_once('../SempubClient.php');

/**
 * This script runs an instance of SemPubClient in order to use Textalytics Proofreading API service to
 * proofread a text. There are two ways of proofreading a text, either by sending a json Document object
 * (option 1) or just sending the text to analyze (option 2).
 *
 * In order to run this example, the license key obtained for the Semantic Publishing API must be included
 * in the KEY variable  in 'config.inc' file. If you don't know your key, check your personal area at 
 * Textalytics (https://textalytics.com/personal_area)
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

// Creates SempubClient object
$textalytics = new SempubClient(KEY);

// This is the text that's going to be proofread
$text = "On Tuesday, author George R.R. Martin stated that his novels take place in an universe meant to be a completely alternate and separate world not linked to our own in any way . It's easy to tell the difference when the plot concerns direwolves or dragons, but the power games that take place in King's Landing could very well be taken from any of the European royal families in Middle Ages, down to the abundance — and associated taint — of children conceived out of marriage, as we see with Ned Stark's Bastard.";


////////////////// Option 1 //////////////////
// Creates a Document object
$document = new Document('1', 
                          'UNKNOWN', 
                          $text, 
                          '2013-02-05 16:08:00 GMT+01:00', 
                          'en', 
                          'plain');
// Obtains the json of the document
$doc = $document->toJsonString();

// Analyzes with a document
$response = $textalytics->checkDocument($doc, 0, 'all', '2', 'y', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";

/*
////////////////// Option 2 //////////////////

// Analyzes with a text
$response = $textalytics->checkText($text, 'en', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";
*/
?>
