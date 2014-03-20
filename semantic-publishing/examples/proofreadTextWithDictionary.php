<?php // proofreadTextWithDictionary.php 
require_once('../SempubClient.php');

/**
 * This script runs an instance of SemPubClient in order to use Textalytics Semantic Publishing API 
 * services to proofread a text using a user-defined dictionary. Before the analysis, the script will 
 * create a dictionary and then it will add three entries: two entities and a concept. Once this has 
 * been done, the text will be proofread. There are two ways of proofreading a text, either by sending 
 * a json Document object (option 1) or just sending the text to analyze (option 2). When the analysis 
 * has been finished, the dictionary will be deleted.
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

//////////////////// Manage a user-defined dictionary ////////////////////

echo "\n ******** Creating user-defined dictionary... ********\n";

$dictionary_name = 'got';
$language = 'en';

// Creates a Dictionary object
$dict = new Dictionary();
$dict->createResourceWithFields($dictionary_name, $language, 'Entities and concepts from A Song of Ice and Fire.');

// Creates a user-defined dictionary
$response = $textalytics->createDictionary($dict);
if($response) {
  if(isset($response->id)) {
    echo "User-defined dictionary created!\n";
    echo $dict->toString()."\n";
  }
}

// Adds entities to the dictionary
echo "\n ******** Creating the entity \"King's Landing\"... ********\n";

$entity = new Entity();
$alias = array();
$theme = array('Top>Society>Military', 'Top>Society>Politics');
$entity->createResourceWithFields('01', "King's Landing", $alias, 'Top>Location>GeoPoliticalEntity>City', $theme);
$response = $textalytics->createEntity($dictionary_name, $entity);
if($response) {
  if(isset($response->id)) {
    echo "Entity created!\n";
    echo $entity->toString()."\n";
  }
}

echo "\n ******** Creating the entity \"Jon Snow\"... ********\n";

$entity = new Entity();
$alias = array("Ned Stark's bastard");
$theme = array('Top>Arts>Cinema');
$entity->createResourceWithFields('02', 'Jon Snow', $alias, 'Top>Person>FullName', $theme);
//if we want to add more info to an entry already created
$entity->addAlias("Bastard of Winterfell");
$entity->addTheme('Top>Society>Politics');

$response = $textalytics->createEntity($dictionary_name, $entity);
if($response) {
  if(isset($response->id)) {
    echo "Entity created!\n";
    echo $entity->toString()."\n";
  }
}


// Adds concepts to the dictionary
echo "\n ******** Creating the concept \"direwolf\"... ********\n";

$concept = new Concept();
$alias = array('direwolves');
$theme = array();
$concept->createResourceWithFields('03', 'direwolf', $alias, 'Top>LivingThing>Animal>Vertebrate>Mammal', $theme);
$response = $textalytics->createConcept($dictionary_name, $concept);
if($response) {
  if(isset($response->id)) {
    echo "Concept created!\n";
    echo $concept->toString()."\n";
  } 
}

sleep(1); 

//////////////////// Proofreads the text ////////////////////


// This is the text that's going to be proofread
$text = "On Tuesday, author George R.R. Martin stated that his novels take place in an universe meant to be a completely alternate and separate world not linked to our own in any way . It's easy to tell the difference when the plot concerns direwolves or dragons, but the power games that take place in King's Landing could very well be taken from any of the European royal families in Middle Ages, down to the abundance — and associated taint — of children conceived out of marriage, as we see with Ned Stark's Bastard."; 


echo "\n ******** Analyzing the text... ********\n";


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
$response = $textalytics->checkDocument($doc, 0, 'all', '2', 'y', $dictionary_name);
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";


////////////////// Option 2 //////////////////
/*
// Analyzes with a text
$response = $textalytics->checkText($text, 'en', $dictionary_name);
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";
*/


//////////////////// Manage a user-defined dictionary ////////////////////


// Deletes the user-defined dictionary 
echo "\n ******** Deleting the user-defined dictionary... ********\n";


////////////////// Option 1 //////////////////
$response = $textalytics->deleteDictionaryName($dictionary_name);
if($response) {
  if(isset($response->id))
    echo "User-defined dictionary deleted!\n";
}

/*
////////////////// Option 2 //////////////////
$response = $textalytics->deleteDictionaryObject($dict);
if($response) {
  if(isset($response->id))
    echo "User-defined dictionary deleted!\n";
}
*/
?>
