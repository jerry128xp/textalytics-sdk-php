<?php //CategoryManager.php

/**
 * This class makes the requests that correspond to category resources operations in the User 
 * Resources Management service.
 * 
 * @author     Textalytics
 * @version    1.0 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class CategoryManager{
  
  const MODEL_LIST = '/model_list/';
  const CATEGORY_LIST = '/category_list';
  
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
   * This method obtains the list of user-defined categories that satisfy the query sent.
   * @param string modelName with the model in which the categories are  
   * @param string query over the name of the categories
   * @return list of Category objects
   */
  public function getList($modelName, $query){
    $request = new Request($this->url.CategoryManager::MODEL_LIST.$modelName.CategoryManager::CATEGORY_LIST, 
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
   * This function returns the information available for the category resource identified by $id.
   * @param string modelName with the identifier of the model the category belongs to 
   * @param string id
   * @return the corresponding Model object
   */
  public function read($modelName, $id){
    $request = new Request($this->url.CategoryManager::MODEL_LIST.$modelName.CategoryManager::CATEGORY_LIST.'/'.$id,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');                           
  }//read
  
  /**
   * 
   * Creates a new category resource.
   * @param string modelName with the identifier of the model the category will belong to 
   * @param object category
   * @return the identifying field of the category created (code)
   */
  public function create($modelName, $category){
    $request = new Request($this->url.CategoryManager::MODEL_LIST.$modelName.CategoryManager::CATEGORY_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'category' => $category->toJsonString())
                           );
    $aux = $request->sendPOST();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//create
  
  /**
   * 
   * Updates the category specified.
   * @param string modelName with the identifier of the model the category belongs to 
   * @param object category
   * @return the identifying field of the model updated (name)
   */
   
  public function update($modelName, $category){
    $request = new Request($this->url.CategoryManager::MODEL_LIST.$modelName.CategoryManager::CATEGORY_LIST.'/'.$category->getObjectIdentifier(),
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'category' => $category->toJsonString())
                           );
    $aux = $request->sendPUT();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//update
  
  /**
   * 
   * Deletes the category resource identified by $code.
   * @param string modelName with the identifier of the model the category belongs to  
   * @param string code
   * @return the identifying field of the category deleted
   */
  public function delete($modelName, $code){
    $request = new Request($this->url.CategoryManager::MODEL_LIST.$modelName.CategoryManager::CATEGORY_LIST.'/'.$code,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendDELETE();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');        
  }//delete
    
}//class CategoryManager
?>
