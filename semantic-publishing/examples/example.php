<?php // example.php
require_once('../SempubClient.php');

$textalytics = new SempubClient(KEY);

/////////////////////// Semantic tagging /////////////////////////////////////////

//  Analyzes a document with the Semantic Tagging service 
$text_semtag = 'Time is out of joint. The summer of peace and plenty, ten years long, is drawing to a close, and the harsh, chill winter approaches like an angry beast. Two great leaders—Lord Eddard Stark and Robert Baratheon, who held sway over an age of enforced peace—are dead, victims of royal treachery. Now, from the ancient citadel of Dragonstone to the forbidding wilds of Winterfell, chaos reigns, as pretenders to the Iron Throne of the Seven Kingdoms prepare to stake their claims through tempest, turmoil, and war. As a prophecy of doom cuts across the sky—a comet the color of blood and flame—six factions struggle for control of a divided land. Eddard\'s son Robb has declared himself King in the North. In the south, Joffrey, Robert\'s heir, rules in name only, victim of the scheming courtiers who teem over King\'s Landing. Robert\'s two brothers each seek their own dominion, while the disfavored House Greyjoy turns once more to conquest. And a continent away, an exiled queen, the Mother of Dragons, risks everything to lead her precious brood across a hard hot desert to win back the crown that is rightfully hers.'; 

$doc_semtag = new Document('1', 
                           'UNKNOWN',
                           $text_semtag,
                           '2013-02-05 16:08:00 GMT+01:00', 
                           'en', 
                           'plain');
$doc = $doc_semtag->toJsonString();

// Analyzes with a document
$response = $textalytics->analyzeDocument($doc, '', 'n', '', ''); 
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";

// Analyzes with a text 
$response = $textalytics->analyzeText($text_semtag, 'en', '', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";

sleep(1);
/////////////////////// Text proofreading /////////////////////////////////////////

// Analyzes a document with the Proofreading Service
$text_check = 'Author George R.R. Martin has stated that his novels take place in an universe meant to be a completely alternate and separate world not linked to our own in any way .';

$doc_check = new Document('1', 
                          'UNKNOWN', 
                          $text_check, 
                          '2013-02-05 16:08:00 GMT+01:00', 
                          'en', 
                          'plain');
$doc = $doc_check->toJsonString();

// Analyzes with a document
$response = $textalytics->checkDocument($doc, 0, 'all', '2', 'y', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";

// Analyzes with a text
$response = $textalytics->checkText($text_check, 'en', '');
if($response)
  if(isset($response->result))
    echo $response->result->toString();
echo "\n\n";


sleep(1);
/////////////////////// Manage user resources /////////////////////////////////////////

////////////// Dictionary //////////////

// Creates a dictionary
$dict = new Dictionary();
$dict->createResourceWithFields('got', 'en', 'Entities and concepts from A Song of Ice and Fire.');
$response = $textalytics->createDictionary($dict);
if($response) {
  if(isset($response->id))
    echo "Identifier of the new dictionary: ".$response->id."\n\n";
  echo "\n\n";
}

// List of user-defined dictionaries
$response = $textalytics->getDictionaryList('', 'en');
if($response) {
  if(isset($response->dictionary_list)) {
    echo "------------------\nDICTIONARIES\n------------------\n";
    foreach($response->dictionary_list as $dict) {
      echo $dict->toString();
    }
  }
  echo "\n\n";
}

// Get the information available for the dictionary resource identified by name
$response = $textalytics->readDictionary('got');
if($response) {
  if(isset($response->dictionary)) {
    echo "------------------\nINFO OF DICTIONARY\n------------------\n";
    echo $response->dictionary->toString();
  }
  echo "\n\n";
}

// Updates the dictionary got
$dict = new Dictionary(); 
$dict->createResourceWithFields('got', 'en', 'Elements from A Song of Ice and Fire.');
$response = $textalytics->updateDictionary($dict);
if($response) {
  if(isset($response->id))
    echo "Identifier of the dictionary updated: ".$response->id."\n\n";
  echo "\n\n";
}

/*
// Deletes the dictionary got - Option I
$response = $textalytics->deleteDictionaryName('got');
if($response) {
  if(isset($response->id))
    echo "Identifier of the dictionary deleted: ".$response->id."\n\n";
  echo "\n\n";
}

// Deletes the dictionary got - Option II
$response = $textalytics->deleteDictionaryObject($dict);
if($response) {
  if(isset($response->id))
    echo "Identifier of the dictionary deleted: ".$response->id."\n\n";
  echo "\n\n";
}
*/

sleep(1);
////////////// Entity //////////////

// Creates an entity
$entity = new Entity();
$alias = array('Dany', 'Khaleesi', 'Daenerys Stormborn', 'Mother of Dragons');
$theme = array('Top>Society>Politics', 'Top>Arts>Cinema');
$entity->createResourceWithFields('01', 'Daenerys Targaryen', $alias, 'Top>Person>FullName', $theme);
$response = $textalytics->createEntity('got', $entity);
if($response) {
  if(isset($response->id))
    echo "Identifier of the new entity: ".$response->id."\n\n";
  echo "\n\n";
}

// List of entities
$response = $textalytics->getEntityList('got', '');
if($response) {
  if(isset($response->entity_list)) {
    echo "------------------\nENTITIES\n------------------\n";
    foreach($response->entity_list as $entity) {
      echo $entity->toString();
    }
  }
  echo "\n\n";
}

// Reads the entity 01
$response = $textalytics->readEntity('got', '01');
if($response) {
  if(isset($response->entity)) {
    echo "------------------\nENTITY\n------------------\n";
    echo $response->entity->toString();
  }
  echo "\n\n";
}

// Updates the entity 01
$entity->addAlias('The Unburnt');
$response = $textalytics->updateEntity('got', $entity);
if($response) {
  if(isset($response->id))
    echo "Identifier of the entity updated: ".$response->id."\n\n";
  echo "\n\n";
}

/*
// Deletes the entity 01 - Option I
$response = $textalytics->deleteEntityId('got', '01');
if($response) {
  if(isset($response->id))
    echo "Identifier of the entity deleted: ".$response->id."\n\n";
  echo "\n\n";
}


// Deletes the entity 01 - Option II
$response = $textalytics->deleteEntityObject('got', $entity);
if($response) {
  if(isset($response->id))
    echo "Identifier of the entity deleted: ".$response->id."\n\n";
  echo "\n\n";
}
*/

sleep(1);
////////////// Concept //////////////
// Creates a concept
$concept = new Concept();
$concept->createResourceWithFields('01', 'knight', array(), 'Top>OtherEntity>Title>PositionTitle', array());
$response = $textalytics->createConcept('got', $concept);
if($response) {
  if(isset($response->id))
    echo "Identifier of the new concept: ".$response->id."\n\n";
  echo "\n\n";
}

// List of concepts
$response = $textalytics->getConceptList('got', '');
if($response) {
  if(isset($response->concept_list)) {
    echo "------------------\nCONCEPTS\n------------------\n";
    foreach($response->concept_list as $concept) {
      echo $concept->toString();
    }
  }
  echo "\n\n";
}

// Reads the concept 01
$response = $textalytics->readConcept('got', '01');
if($response) {
  if(isset($response->concept)) {
    echo "------------------\nCONCEPT\n------------------\n";
    echo $response->concept->toString();
  }
  echo "\n\n";
}

// Updates the concept 01
$concept->addTheme('Top>Society>Military');
$response = $textalytics->updateConcept('got', $concept);
if($response) {
  if(isset($response->id))
    echo "Identifier of the concept updated: ".$response->id."\n\n";
  echo "\n\n";
}

/*
// Deletes the concept 01 - Option I
$response = $textalytics->deleteConceptId('got', '01');
if($response) {
  if(isset($response->id))
    echo "Identifier of the concept deleted: ".$response->id."\n\n";
  echo "\n\n";
}

// Deletes the concept 01 - Option II
$response = $textalytics->deleteConceptObject('got', $concept);
if($response) {
  if(isset($response->id))
    echo "Identifier of the concept deleted: ".$response->id."\n\n";
  echo "\n\n";
}
*/

sleep(1);
////////////// Model //////////////
// Creates a model
$model = new Model();
$model->createResourceWithFields('got_geography_model', 'en', 'A Song of Ice and Fire classification model.');
$response = $textalytics->createModel($model);
if($response) {
  if(isset($response->id))
    echo "Identifier of the new model: ".$response->id."\n\n";
  echo "\n\n";
}

// List of models
$response = $textalytics->getModelList('', 'en');
if($response) {
  if(isset($response->model_list)) {
    echo "------------------\nMODELS\n------------------\n";
    foreach($response->model_list as $model) {
      echo $model->toString();
    }
  }
  echo "\n\n";
}

// Reads the model got_geography_model
$response = $textalytics->readModel('got_geography_model');
if($response) {
  if(isset($response->model)) {
    echo "------------------\nINFO OF MODEL\n------------------\n";
    echo $response->model->toString();
  }
  echo "\n\n";
}

// Updates the model got_geography_model
$model = new Model();
$model->createResourceWithFields('got_geography_model', 'en', 'A Song of Ice and Fire geography classification model.');
$response = $textalytics->updateModel($model);
if($response) {
  if(isset($response->id))
    echo "Identifier of the model updated: ".$response->id."\n\n";
  echo "\n\n";
}

/*
// Deletes the model got_geography_model - Option I
$response = $textalytics->deleteModelName('got_geography_model');
if($response) {
  if(isset($response->id))
    echo "Identifier of the model deleted: ".$response->id."\n\n";
  echo "\n\n";
}

// Deletes the model got_geography_model - Option II
$response = $textalytics->deleteModelObject($model);
if($response) {
  if(isset($response->id))
    echo "Identifier of the model deleted: ".$response->id."\n\n";
  echo "\n\n";
}
*/

sleep(1);
////////////// Categoty //////////////
// Creates a category
$category = new Category();
$category->createResourceWithFields('01', 
                                    'Westeros - far west of the known world', 
                                    'beyond+the+wall|the+iron+islands|the+vale+of+arryn|the+north|the+riverlands|the+westerlands|the+crownlands|the+reach|the+stormlands|the+wall|dorne|the+seven+kingdoms|free+folk|iron+throne|faith+of+the+seven|old+gods|drowned+god|king\'s+landing|oldtown|lannisport|gulltown|white+harbor', 
                                    '', 
                                    'house_baratheon~baelish~martell~greyjoy~arryn~stark~tyrell~lannister|harrenhall|storm\'s+end|eyrie|casterly+rock|children+of+the+forest|giant|giants|others|white+walkers|white+walker|direwolf|direwolves|lizard-lion|lizard-lions|mammoth|mammoths|raven|ravens|shadowcat|shadowcats', 
                                    'beyond+the+narrow+sea|eastern+continent|the+east|free+cities|dothraki+sea|shivering+sea|valyrian+peninsula|slaver\'s+bay|ghiscar|lhazar|qarth|eastern+essos|essos|dothraki|ghiscari|lhazareen|qartheen|ibbenese|jogos+nhai', 
                                    'The continent of Westeros is long and relatively narrow, extending from Dorne in the south to the Lands of Always Winter in the far north, where a large amount of land remains uncharted, due to the extremely cold temperatures and hostile inhabitants known as wildlings. Although no scale appears on the maps in the books themselves, George R. R. Martin has stated that the Wall is a hundred leagues long, or three hundred miles. Thus the continent stretches for about 3,000 miles from north to south and for some 900 miles at its widest point east to west. Its eastern coast borders on the narrow sea; across those waters lies the eastern continent of Essos and the island chain known as the Stepstones. To the south is located the Summer Sea, and within it the Summer Islands. The northern lands of Westeros are less densely populated than the south despite their roughly equivalent size. The five major cities of Westeros are, in order of size: King\'s Landing, Oldtown, Lannisport, Gulltown, and White Harbor. Westeros was originally divided into several independent kingdoms before the consolidation of the War of Conquest. After this war and the eventual incorporation of Dorne, all the regions south of the Wall were united under the rule of House Targaryen into a nation that is known as the Seven Kingdoms.'); 

$response = $textalytics->createCategory('got_geography_model', $category);
if($response) {
  if(isset($response->id))
    echo "Identifier of the new category: ".$response->id."\n\n";
  echo "\n\n";
}

// List of categories
$response = $textalytics->getCategoryList('got_geography_model', '');
if($response) {
  if(isset($response->category_list)) {
    echo "------------------\nCATEGORIES\n------------------\n";
    foreach($response->category_list as $cat) {
      echo $cat->toString();
    }
  }
  echo "\n\n";
}

// Reads the category 01 
$response = $textalytics->readCategory('got_geography_model', '01');
if($response) {
  if(isset($response->category)) {
    echo "------------------\nCATEGORY\n------------------\n";
    echo $response->category->toString();
  }
  echo "\n\n";
}

// Updates the category 01
$category->addRelevantTerm('wildlings');
$response = $textalytics->updateCategory('got_geography_model', $category);
if($response) {
  if(isset($response->id))
    echo "Identifier of the category updated: ".$response->id."\n\n";
  echo "\n\n";
}

/*
// Deletes the category 01 - Option I
$response = $textalytics->deleteCategoryId('got_geography_model', '01');
if($response) {
  if(isset($response->id))
    echo "Identifier of the category deleted: ".$response->id."\n\n";
  echo "\n\n";
}

// Deletes the category 01 - Option II
$response = $textalytics->deleteCategoryObject('got_geography_model', $category);
if($response) {
  if(isset($response->id))
    echo "Identifier of the category deleted: ".$response->id."\n\n";
  echo "\n\n";
}
*/
?>
