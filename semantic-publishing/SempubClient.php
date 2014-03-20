<?php //SempubClient.php
require_once('config.inc');
require_once('Request.php');
require_once('Response.php');
require_once('domain/Document.php');
require_once('manage/DictionaryManager.php');
require_once('manage/EntityManager.php');
require_once('manage/ConceptManager.php');
require_once('manage/ModelManager.php');
require_once('manage/CategoryManager.php');


/**
 * This class implements the basic behavior of the Sempub API
 * 
 * @author     Textalytics
 * @version    1.0 -- 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */

class SempubClient{

  public $key;
  private $dictionaryManager;
  private $entityManager;
  private $conceptManager;
  private $modelManager;
  private $categoryManager;
 
  /**
   * Class constructor
   *
   * @param string key password to use the API
   */
  public function __construct($key){
    $this->key = $key;
    $this->dictionaryManager = null;
    $this->entityManager = null;
    $this->conceptManager = null;
    $this->modelManager = null;
    $this->categoryManager = null;
  }//__construct


  /////////////////////// Semantic tagging /////////////////////////////////////////

  /**
   * This function analyses the json document passed as a parameter following the 
   * configuration specified in it.
   *
   * @param document includes the document to analyze
   * @param fields analysis fields or functionalities included in the output
   * @param filter_data determines if the output will be filtered
   * @param dictionary_name name of a user-defined dictionary
   * @param model_name name of a user-defined classification model
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function analyzeDocument($document, $fields, $filter_data, $dictionary_name, $model_name){
    $request = new Request(SERVICE_URL_SEMTAG,
                           array('key' => $this->key,
                                 'input' => 'json', 
                                 'output' => 'json',
                                 'doc' => $document,
                                 'fields' => $fields,
                                 'filter_data' => $filter_data,
                                 'dictionary' => $dictionary_name,
                                 'model' => $model_name));
    $aux = $request->sendPOST();
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');
  }//analyzeDocument


  /**
   * This function analyses the text passed as a parameter following the 
   * configuration specified in it.
   *
   * @param text the text you would like to analyze
   * @param language language in which the text will be analyzed
   * @param dictionary_name name of a user-defined dictionary
   * @param model_name name of a user-defined classification model
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function analyzeText($text, $language, $dictionary_name, $model_name){
    $doc = new Document('1', 'UNKNOWN', $text, '', $language, 'plain');
    $document = $doc->toJsonString(); 
    return $this->analyzeDocument($document, '', 'y', $dictionary_name, $model_name);
  }//analyzeText


  /////////////////////// Text proofreading /////////////////////////////////////////

  /**
   * This function checks the json document passed as a parameter following the 
   * configuration specified in it.
   *
   * @param document includes the document to check 
   * @param doc_offset offset in characters from which to start the revision of the text
   * @param mode check mode
   * @param group_errors behavior in sentences with many errors
   * @param check_spacing check multiple spacing problems
   * @param dictionary_name name of a user-defined dictionary
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function checkDocument($document, $doc_offset, $mode, $group_errors, $check_spacing, $dictionary_name) {
    $request = new Request(SERVICE_URL_CHECK,
                           array('key' => $this->key,
                                 'input' => 'json',
                                 'output' => 'json',
                                 'doc' => $document,
                                 'doc_offset' => $doc_offset,
                                 'mode' => $mode,
                                 'group_errors' => $group_errors,
                                 'check_spacing' => $check_spacing,
                                 'dictionary' => $dictionary_name));
    $aux = $request->sendPOST();
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');
  } //checkDocument


  /**
   * This function checks the text passed as a parameter following the 
   * configuration specified in it.
   *
   * @param text the text you would like to check 
   * @param language language in which the text will be analyzed 
   * @param dictionary_name name of a user-defined dictionary
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function checkText($text, $language, $dictionary_name) {
    $doc = new Document('1', 'UNKNOWN', $text, '', $language, 'plain');
    $document = $doc->toJsonString(); 
    return $this->checkDocument($document, '0', 'all', '2', 'n', $dictionary_name);
  } //checkText


  /////////////////////// Manage user resources /////////////////////////////////////////
 
  /**
   * Creates a dictionaryManager object
   *
   */ 
  private function createDictionaryManager() {
    $this->dictionaryManager = new DictionaryManager($this->key, SERVICE_URL_MANAGE);
  } // createDictionaryManager


  /**
   * Creates a entityManager object
   *
   */ 
  private function createEntityManager() {
    $this->entityManager = new EntityManager($this->key, SERVICE_URL_MANAGE);
  } // createEntityManager


  /**
   * Creates a cocneptManager object
   *
   */ 
  private function createConceptManager() {
    $this->conceptManager = new ConceptManager($this->key, SERVICE_URL_MANAGE);
  } // createConceptManager

 
  /**
   * Creates a modelManager object
   *
   */ 
  private function createModelManager() {
    $this->modelManager = new ModelManager($this->key, SERVICE_URL_MANAGE);
  } // createModelManager

 
  /**
   * Creates a categoryManager object
   *
   */ 
  private function createCategoryManager() {
    $this->categoryManager = new CategoryManager($this->key, SERVICE_URL_MANAGE);
  } // createCategoryManager


  ////////////// Dictionary //////////////

  /**
   * This method obtains the list of user-defined dictionaries that satisfy the query sent. 
   *
   * @param query over the name of the dictionaries
   * @param language with the language of the dictionaries shown in the results
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function getDictionaryList($query, $language) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->getList($query, $language); 
  } // getDictionaryList


  /**
   * Creates a new dictionary resource. 
   *
   * @param object dictionary
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function createDictionary($dictionary) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->create($dictionary);
  } // createDictionary


  /**
   * This function returns the information available for the dictionary resource identified by name.
   *
   * @param dictionary_name
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function readDictionary($dictionary_name) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->read($dictionary_name);
  } // readDictionary


  /**
   * Updates the dictionary specified.
   *
   * @param object dictionary 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function updateDictionary($dictionary) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->update($dictionary);
  } // updateDictionary


  /**
   * Deletes the dictionary resource identified by name.
   *
   * @param dictionary_name 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteDictionaryName($dictionary_name) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->delete($dictionary_name);
  } // deleteDictionaryName


  /**
   * Deletes the dictionary resource.
   *
   * @param object dictionary 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteDictionaryObject($dictionary) {
    if($this->dictionaryManager == null) $this->createDictionaryManager();
    return $this->dictionaryManager->delete($dictionary->getObjectIdentifier());
  } // deleteDictionaryObject


  ////////////// Entity //////////////

  /**
   * This method obtains the list of user-defined entities that satisfy the query sent.
   *
   * @param dictionary_name with the dictionary in which the entities are
   * @param query over the name of the entities
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function getEntityList($dictionary_name, $query) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->getList($dictionary_name, $query); 
  } // getEntityList


  /**
   * Creates a new entity resource. 
   *
   * @param dictionary_name with the identifier of the dictionary the entity will belong to
   * @param object entity
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function createEntity($dictionary_name, $entity) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->create($dictionary_name, $entity);
  } // createEntity


  /**
   * This function returns the information available for the entity resource identified by id. 
   *
   * @param dictionary_name with the identifier of the dictionary the entity belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function readEntity($dictionary_name, $id) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->read($dictionary_name, $id);
  } // readEntity


  /**
   * Updates the entity specified. 
   *
   * @param dictionary_name with the identifier of the dictionary the entity belongs to
   * @param object entity 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function updateEntity($dictionary_name, $entity) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->update($dictionary_name, $entity);
  } // updateEntity


  /**
   * Deletes the entity resource identified by id. 
   *
   * @param dictionary_name with the identifier of the dictionary the entity belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteEntityId($dictionary_name, $id) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->delete($dictionary_name, $id);
  } // deleteEntityId


  /**
   * Deletes the entity resource  
   *
   * @param dictionary_name with the identifier of the dictionary the entity belongs to
   * @param object entity 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteEntityObject($dictionary_name, $entity) {
    if($this->entityManager == null) $this->createEntityManager();
    return $this->entityManager->delete($dictionary_name, $entity->getObjectIdentifier());
  } // deleteEntityObject


  ////////////// Concept //////////////

  /**
   * This method obtains the list of user-defined concepts that satisfy the query sent.
   *
   * @param dictionary_name with the dictionary in which the concepts are
   * @param query over the name of the concepts 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function getConceptList($dictionary_name, $query) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->getList($dictionary_name, $query);
  } // getConceptList

  
  /**
   * Creates a new concept resource. 
   *
   * @param dictionary_name with the identifier of the dictionary the concept will belong to
   * @param object concept 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function createConcept($dictionary_name, $concept) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->create($dictionary_name, $concept);
  } // createConcept


  /**
   * This function returns the information available for the concept resource identified by id. 
   *
   * @param dictionary_name with the identifier of the dictionary the concept belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function readConcept($dictionary_name, $id) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->read($dictionary_name, $id);
  } // readConcept

 
  /**
   * Updates the concept specified. 
   *
   * @param dictionary_name with the identifier of the dictionary the concept belongs to
   * @param object concept
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function updateConcept($dictionary_name, $concept) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->update($dictionary_name, $concept);
  } // updateConcept


  /**
   * Deletes the concept resource identified by id. 
   *
   * @param dictionary_name with the identifier of the dictionary the concept belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteConceptId($dictionary_name, $id) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->delete($dictionary_name, $id);
  } // deleteConceptId


  /**
   * Deletes the concept resource
   *
   * @param dictionary_name with the identifier of the dictionary the concept belongs to
   * @param object concept 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteConceptObject($dictionary_name, $concept) {
    if($this->conceptManager == null) $this->createConceptManager();
    return $this->conceptManager->delete($dictionary_name, $concept->getObjectIdentifier());
  } // deleteConceptObject


  ////////////// Model //////////////

  /**
   * This method obtains the list of user-defined models that satisfy the query sent. 
   *
   * @param query over the name of the models 
   * @param language with the language of the models shown in the results
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function getModelList($query, $language) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->getList($query, $language); 
  } // getModelList


  /**
   * Creates a new model resource. 
   *
   * @param object model
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function createModel($model) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->create($model);
  } // createModel


  /**
   * This function returns the information available for the model resource identified by name.
   *
   * @param model_name
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function readModel($model_name) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->read($model_name);
  } // readModel


  /**
   * Updates the model specified.
   *
   * @param object model 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function updateModel($model) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->update($model);
  } // updateModel


  /**
   * Deletes the model resource identified by name.
   *
   * @param model_name 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteModelName($model_name) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->delete($model_name);
  } // deleteModelName


  /**
   * Deletes the model resource.
   *
   * @param object model 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteModelObject($model) {
    if($this->modelManager == null) $this->createModelManager();
    return $this->modelManager->delete($model->getObjectIdentifier());
  } // deleteModelObject


  ////////////// Category //////////////

  /**
   * This method obtains the list of user-defined categories that satisfy the query sent.
   *
   * @param model_name with the model in which the categories are
   * @param query over the name of the categories 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function getCategoryList($model_name, $query) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->getList($model_name, $query); 
  } // getCategoryList


  /**
   * Creates a new category resource. 
   *
   * @param model_name with the identifier of the model the category will belong to
   * @param object category 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function createCategory($model_name, $category) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->create($model_name, $category);
  } // createCategory


  /**
   * This function returns the information available for the category resource identified by id. 
   *
   * @param model_name with the identifier of the model the category belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function readCategory($model_name, $id) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->read($model_name, $id);
  } // readCategory


  /**
   * Updates the category specified. 
   *
   * @param model_name with the identifier of the model the category belongs to
   * @param object category 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function updateCategory($model_name, $category) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->update($model_name, $category);
  } // updateCategory


  /**
   * Deletes the category resource identified by id. 
   *
   * @param model_name with the identifier of the model the category belongs to
   * @param id
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteCategoryId($model_name, $id) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->delete($model_name, $id);
  } // deleteCategoryId

  /**
   * Deletes the category resource
   *
   * @param model_name with the identifier of the model the category belongs to
   * @param object category 
   * @return Response object with the result obtained from the API or false if there was an error
   */
  public function deleteCategoryObject($model_name, $category) {
    if($this->categoryManager == null) $this->createCategoryManager();
    return $this->categoryManager->delete($model_name, $category->getObjectIdentifier());
  } // deleteCategoryObject


}//class SempubClient 


?>
