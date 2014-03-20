<?php //DictionaryManager.php
/**
 * This class makes the requests that correspond to dictionary resources operations in the User 
 * Resources Management service.
 * 
 * @author     Textalytics
 * @version    1.0 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class DictionaryManager{
  
  const DICTIONARY_LIST = '/dictionary_list';
  
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
   * This method obtains the list of user-defined dictionaries that satisfy the query sent. 
   * @param string query over the name of the dictionaries
   * @param string lang with the language of the dictionaries shown in the results
   * @return list of Dictionary objects
   */
  public function getList($query, $lang){
    $request = new Request($this->url.DictionaryManager::DICTIONARY_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'query' => $query, 
                                 'lang' => $lang)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');
  }//getList
  
  
  /**
   * 
   * This function returns the information available for the dictionary resource identified by $name. 
   * @param string name
   * @return the corresponding Dictionary object
   */
  public function read($name){
    $request = new Request($this->url.DictionaryManager::DICTIONARY_LIST.'/'.$name,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');                           
  }//read
  
  /**
   * 
   * Creates a new dictionary resource.
   * @param object dictionary
   * @return the identifying field of the dictionary created (name)
   */
  public function create($dictionary){
    $request = new Request($this->url.DictionaryManager::DICTIONARY_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'dictionary' => $dictionary->toJsonString())
                           );
    $aux = $request->sendPOST();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//create
  
  /**
   * 
   * Updates the dictionary specified.
   * @param object dictionary
   * @return the identifying field of the dictionary updated (name)
   */
   
  public function update($dictionary){
    $request = new Request($this->url.DictionaryManager::DICTIONARY_LIST.'/'.$dictionary->getObjectIdentifier(),
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'dictionary' => $dictionary->toJsonString())
                           );
    $aux = $request->sendPUT();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//update
  
  /**
   * 
   * Deletes the dictionary resource identified by $name.
   * @param string name
   * @return the identifying field of the dictionary deleted
   */
  public function delete($name){
    $request = new Request($this->url.DictionaryManager::DICTIONARY_LIST.'/'.$name,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendDELETE();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');        
  }//delete
    
}//class DictionaryManager
?>
