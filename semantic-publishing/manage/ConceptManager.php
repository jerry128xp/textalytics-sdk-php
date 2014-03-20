<?php //ConceptManager.php

/**
 * This class makes the requests that correspond to concept resources operations in the User 
 * Resources Management service.
 * 
 * @author     Textalytics
 * @version    1.0 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class ConceptManager{
  
  const DICTIONARY_LIST = '/dictionary_list/';
  const CONCEPT_LIST = '/concept_list';
  
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
   * This method obtains the list of user-defined concepts that satisfy the query sent.
   * @param string dictName with the dictionary in which the concepts are  
   * @param string query over the name of the concepts
   * @return list of Concept objects
   */
  public function getList($dictName, $query){
    $request = new Request($this->url.ConceptManager::DICTIONARY_LIST.$dictName.ConceptManager::CONCEPT_LIST, 
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
   * This function returns the information available for the concept resource identified by $id.
   * @param string dictName with the identifier of the dictionary the concept belongs to 
   * @param string id
   * @return the corresponding Dictionary object
   */
  public function read($dictName, $id){
    $request = new Request($this->url.ConceptManager::DICTIONARY_LIST.$dictName.ConceptManager::CONCEPT_LIST.'/'.$id,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');                           
  }//read
  
  /**
   * 
   * Creates a new concept resource.
   * @param string dictName with the identifier of the dictionary the concept will belong to 
   * @param object concept
   * @return the identifying field of the concept created (id)
   */
  public function create($dictName, $concept){
    $request = new Request($this->url.ConceptManager::DICTIONARY_LIST.$dictName.ConceptManager::CONCEPT_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'concept' => $concept->toJsonString())
                           );
    $aux = $request->sendPOST();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//create
  
  /**
   * 
   * Updates the concept specified.
   * @param string dictName with the identifier of the dictionary the concept belongs to 
   * @param object concept
   * @return the identifying field of the concept updated (id)
   */
   
  public function update($dictName, $concept){
    $request = new Request($this->url.ConceptManager::DICTIONARY_LIST.$dictName.ConceptManager::CONCEPT_LIST.'/'.$concept->getObjectIdentifier(),
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'concept' => $concept->toJsonString())
                           );
    $aux = $request->sendPUT();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//update
  
  /**
   * 
   * Deletes the concept resource identified by $id.
   * @param string dictName with the identifier of the dictionary the concept belongs to  
   * @param string id
   * @return the identifying field of the concept deleted
   */
  public function delete($dictName, $id){
    $request = new Request($this->url.ConceptManager::DICTIONARY_LIST.$dictName.ConceptManager::CONCEPT_LIST.'/'.$id,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendDELETE();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');        
  }//delete
    
}//class ConceptManager
?>
