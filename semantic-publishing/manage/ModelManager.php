<?php //ModelManager.php

/**
 * This class makes the requests that correspond to model resources operations in the User 
 * Resources Management service.
 * 
 * @author     Textalytics
 * @version    1.0 02/2014
 * @contact    http://www.textalytics.com (http://www.daedalus.es)
 * @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.
 */
class ModelManager{
  
  const MODEL_LIST = '/model_list';
  
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
   * This method obtains the list of user-defined models that satisfy the query sent. 
   * @param string query over the name of the models
   * @param string lang with the language of the models shown in the results
   * @return list of Model objects
   */
  public function getList($query, $lang){
    $request = new Request($this->url.ModelManager::MODEL_LIST, 
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
   * This function returns the information available for the model resource identified by $name. 
   * @param string name
   * @return the corresponding model object
   */
  public function read($name){
    $request = new Request($this->url.ModelManager::MODEL_LIST.'/'.$name,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendGET();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');                           
  }//read
  
  /**
   * 
   * Creates a new model resource.
   * @param object model
   * @return the identifying field of the model created (name)
   */
  public function create($model){
    $request = new Request($this->url.ModelManager::MODEL_LIST, 
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'model' => $model->toJsonString())
                           );
    $aux = $request->sendPOST();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//create
  
  /**
   * 
   * Updates the model specified.
   * @param object model
   * @return the identifying field of the model updated (name)
   */
   
  public function update($model){
    $request = new Request($this->url.ModelManager::MODEL_LIST.'/'.$model->getObjectIdentifier(),
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output,
                                 'model' => $model->toJsonString())
                           );
    $aux = $request->sendPUT();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');    
  }//update
  
  /**
   * 
   * Deletes the model resource identified by $name.
   * @param string name
   * @return the identifying field of the model deleted
   */
  public function delete($name){
    $request = new Request($this->url.ModelManager::MODEL_LIST.'/'.$name,
                           array('key' => $this->key,
                                 'input' => $this->input,
                                 'output' => $this->output)
                           );
    $aux = $request->sendDELETE();    
    return new Response(isset($aux['api-response']) ? $aux['api-response'] : '');        
  }//delete
    
}//class ModelManager

?>
