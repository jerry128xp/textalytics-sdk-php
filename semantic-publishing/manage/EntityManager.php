<?php //EntityManager.php

/**
 * This class makes the requests that correspond to entity resources operations in the User 
 * Resources Management service.
 * 
 * @author     Textalytics
 * @version    1.0 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class EntityManager{
  
  const DICTIONARY_LIST = '/dictionary_list/';
  const ENTITY_LIST = '/entity_list';
  
  public $key;
  public $input;
  public $output;
  public $url;
  
  /**
   * 
   * Class constructor
   * @param key license key to use in the request to the API
   * @param url url of the service
   * @param input format, set to json if it's not specified
   * @param output format, set to json if it's not specified
   */
  public function __construct($key, $url, $input = 'json', $output = 'json'){
    $this->key = $key;
    $this->url = $url;
    $this->input = $input;
    $this->output = $output;
  }//__construct
  
  
  /**
   * 
   * This method obtains the list of user-defined entities that satisfy the query sent.
   * @param string dictName with the dictionary in which the entities are  
   * @param string query over the name of the entities
   * @return list of Entity objects
   */
  public function getList($dictName, $query){
    $request = new Request($this->url.EntityManager::DICTIONARY_LIST.$dictName.EntityManager::ENTITY_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'query' => $query)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');
  }//getList
  
  
  /**
   * 
   * This function returns the information available for the entity resource identified by $id.
   * @param string dictName with the identifier of the dictionary the entity belongs to 
   * @param string id
   * @return the corresponding Dictionary object
   */
  public function read($dictName, $id){
    $request = new Request($this->url.EntityManager::DICTIONARY_LIST.$dictName.EntityManager::ENTITY_LIST.'/'.$id,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');                           
  }//read
  
  /**
   * 
   * Creates a new entity resource.
   * @param string dictName with the identifier of the dictionary the entity will belong to 
   * @param object entity
   * @return the identifying field of the entity created (id)
   */
  public function create($dictName, $entity){
    $request = new Request($this->url.EntityManager::DICTIONARY_LIST.$dictName.EntityManager::ENTITY_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'entity' => $entity->toJsonString())
                           );
    $aux = $request->sendPOST();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//create
  
  /**
   * 
   * Updates the entity specified.
   * @param string dictName with the identifier of the dictionary the entity belongs to 
   * @param object entity
   * @return the identifying field of the entity updated (id)
   */
   
  public function update($dictName, $entity){
    $request = new Request($this->url.EntityManager::DICTIONARY_LIST.$dictName.EntityManager::ENTITY_LIST.'/'.$entity->getObjectIdentifier(),
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'entity' => $entity->toJsonString())
                           );
    $aux = $request->sendPUT();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//update
  
  /**
   * 
   * Deletes the entity resource identified by $id.
   * @param string dictName with the identifier of the dictionary the entity belongs to  
   * @param string id
   * @return the identifying field of the entity deleted
   */
  public function delete($dictName, $id){
    $request = new Request($this->url.EntityManager::DICTIONARY_LIST.$dictName.EntityManager::ENTITY_LIST.'/'.$id,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendDELETE();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');        
  }//delete
    
}//class EntityManager
?>
