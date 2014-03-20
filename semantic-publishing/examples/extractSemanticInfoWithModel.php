<?php // extractSemanticInfoWithModel.php 
require_once('../SempubClient.php');

/**
 * This script runs an instance of SemPubClient in order to use Textalytics Semantic Publishing API 
 * services to tag semantic information in a text using a user-defined text classification model. 
 * Before the analysis, the script will create a model and then it will add two categories. 
 * Once this has been done, the text will be analyzed. There are two ways of analyzing a text, either
 * by sending a json Document object (option 1) or just sending the text to analyze (option 2). When the
 * analysis is finished, the model will be deleted.
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

// Creates SempubClient object
$textalytics = new SempubClient(KEY);

//////////////////// Manage a user-defined text classification model ////////////////////

echo "\n ******** Creating the user-defined text classification model... ********\n";

$model_name = 'got_geography_model';
$language = 'en';

// Creates a Model object
$model = new Model();
$model->createResourceWithFields($model_name, $language, 'A Song of Ice and Fire geography classification model.');

// Creates a user-defined model 
$response = $textalytics->createModel($model);
if($response) {
  if(isset($response->id)) {
    echo "User-defined model created!\n";
    echo $model->toString()."\n";
  }
}

// Adds categories to the model
echo "\n ******** Creating the category \"Westeros - far west of the known world\"... ********\n";

$category = new Category();
$category->createResourceWithFields('01', 
                                    'Westeros - far west of the known world', 
                                    "beyond+the+wall|the+iron+islands|the+vale+of+arryn|the+north|the+riverlands|the+westerlands|the+crownlands|the+reach|the+stormlands|the+wall|dorne|the+seven+kingdoms|free+folk|iron+throne|faith+of+the+seven|old+gods|drowned+god|oldtown|lannisport|gulltown|white+harbor", 
                                    '', 
                                    "house_baratheon~baelish~martell~greyjoy~arryn~stark~tyrell~lannister|harrenhall|eyrie|casterly+rock|children+of+the+forest|giant|giants|others|white+walkers|white+walker|direwolf|direwolves|lizard-lion|lizard-lions|mammoth|mammoths|raven|ravens|shadowcat|shadowcats", 
                                    "beyond+the+narrow+sea|eastern+continent|the+east|free+cities|dothraki+sea|shivering+sea|valyrian+peninsula|slaver|ghiscar|lhazar|qarth|eastern+essos|essos|dothraki|ghiscari|lhazareen|qartheen|ibbenese|jogos+nhai", 
                                    "The continent of Westeros is long and relatively narrow, extending from Dorne in the south to the Lands of Always Winter in the far north, where a large amount of land remains uncharted, due to the extremely cold temperatures and hostile inhabitants known as wildlings. Although no scale appears on the maps in the books themselves, George R. R. Martin has stated that the Wall is a hundred leagues long, or three hundred miles. Thus the continent stretches for about 3,000 miles from north to south and for some 900 miles at its widest point east to west. Its eastern coast borders on the narrow sea; across those waters lies the eastern continent of Essos and the island chain known as the Stepstones. To the south is located the Summer Sea, and within it the Summer Islands. The northern lands of Westeros are less densely populated than the south despite their roughly equivalent size. The five major cities of Westeros are, in order of size: King's Landing, Oldtown, Lannisport, Gulltown, and White Harbor. Westeros was originally divided into several independent kingdoms before the consolidation of the War of Conquest. After this war and the eventual incorporation of Dorne, all the regions south of the Wall were united under the rule of House Targaryen into a nation that is known as the Seven Kingdoms."); 
$category->addPositiveTerm('king+landing');

$response = $textalytics->createCategory($model_name, $category);
if($response) {
  if(isset($response->id)) {
    echo "Category created!\n";
    echo $category->toString()."\n";
  }
}

echo "\n ******** Creating the category \"Essos - beyond the narrow sea\"... ********\n";

$category = new Category();
$category->createResourceWithFields('02', 
                                    'Essos - beyond the narrow sea', 
                                    'the+free+cities|the+dothraki+sea|the+shivering+sea|valyrian+peninsula|slaver|ghiscar|lhazar|qarth|eastern+essos', 
                                    '', 
                                    'dothraki|lhazareen|qartheen|ibbenese|jogos+nhai', 
                                    '', 
                                    ''); 
$category->addRelevantTerm('ghiscari');

$response = $textalytics->createCategory($model_name, $category);
if($response) {
  if(isset($response->id)) {
    echo "Category created!\n";
    echo $category->toString()."\n";
  }
}

// the text to analyze
$text = "On Tuesday, author George R.R. Martin stated that his novels take place in an universe meant to be a completely alternate and separate world not linked to our own in any way . It's easy to tell the difference when the plot concerns direwolves or dragons, but the power games that take place in King's Landing could very well be taken from any of the European royal families in Middle Ages, down to the abundance — and associated taint — of children conceived out of marriage, as we see with Ned Stark's bastard.";


//////////////////// Analyzes the text ////////////////////
echo "\n ******** Analyzing the text... ********\n";

/*
////////////////// Option 1 //////////////////
// Creates a Document object
$document = new Document('1', 
                         'UNKNOWN',
                         $text,
                         '2013-02-05 16:08:00 GMT+01:00', 
                         $language, 
                         'plain');

// Obtains the json of the document
$doc = $document->toJsonString();

// Analyzes with the document in json
$response = $textalytics->analyzeDocument($doc, '', 'n', '', $model_name); 
if($response)
  if(isset($response->result))
    echo $response->result->toString()."\n";
*/

////////////////// Option 2 //////////////////
$response = $textalytics->analyzeText($text, $language, '', $model_name);
if($response)
  if(isset($response->result))
    echo $response->result->toString()."\n";


//////////////////// Manage a user-defined text classification model ////////////////////


// Deletes the user-defined model 
echo "\n ******** Deleting the user-defined model... ********\n";


////////////////// Option 1 //////////////////
$response = $textalytics->deleteModelName($model_name);
if($response) {
  if(isset($response->id))
    echo "User-defined model deleted!\n";
}

/*
////////////////// Option 2 //////////////////
$response = $textalytics->deleteModelObject($model);
if($response) {
  if(isset($response->id))
    echo "User-defined model deleted!\n";
}
*/
echo "\n";
?>
