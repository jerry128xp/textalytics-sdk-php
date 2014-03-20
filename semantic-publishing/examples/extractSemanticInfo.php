<?php // extractSemanticInfo.php 
require_once('../SempubClient.php');

/**
 * This script analyzes a text with the Semantic tagging service. 
 * The semantic tagging service identifies relevant information in your content and helps you to annotate it.
 * This service analyzes the text with semantic annotations like: 
 *   - Entity extraction
 *   - Concept extraction
 *   - Document categorization
 *   - Linked Open Data
 *   - Other relevant data (money expressions, url, phones and e-mails)
 *
 * To analyze the text there are two options
 *   1. Analyze with a Document object
 *   2. Analyze directly with the text
 * In this example it used the option 2
 *
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.*
 */

// Creates SempubClient object
$textalytics = new SempubClient(KEY);

// the text to analyze
$text = "On Tuesday, author George R.R. Martin stated that his novels take place in an universe meant to be a completely alternate and separate world not linked to our own in any way . It's easy to tell the difference when the plot concerns direwolves, dragons or skinchangers, but the power games that take place in King's Landing could very well be taken from any of the European royal families in Middle Ages, down to the abundance — and associated taint — of children conceived out of marriage, as we see with Ned Stark's bastard."; 
/*
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

// Analyzes with the document in json
$response = $textalytics->analyzeDocument($doc, '', 'n', '', ''); 
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";
*/

////////////////// Option 2 //////////////////
$response = $textalytics->analyzeText($text, 'en', '', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";
?>
