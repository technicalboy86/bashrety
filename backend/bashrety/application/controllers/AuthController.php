<?php

class AuthController extends Zend_Controller_Action
{

 	public function init()
    {
        /* Initialize action controller here */
    	$this->config = $this->getInvokeArg('bootstrap')->getOptions();
    }

    public function indexAction()
    {
    	$redirector = $this->getHelper("Redirector");    	
    	if(Zend_Auth::getInstance()->hasIdentity())
    	{    		
    		$data = Zend_Auth::getInstance()->getStorage()->read();
        $redirector->gotoSimple('index', 'admin');
    	}
    	else 
    	{
	        $redirector->gotoSimple('login', 'auth');	
    	}
    }
    
    public function loginAction()
    {    	
    	$redirector = $this->getHelper("Redirector");
		
		 $this->view->messages = $this->_helper->flashMessenger->getMessages();
		
    	if(Zend_Auth::getInstance()->hasIdentity())
    	{			
			
    		$data = Zend_Auth::getInstance()->getStorage()->read();
 				$redirector->gotoSimple('index', 'admin');

    	}
    	else
    	{    		
			
    		$form = new Application_Form_Login();
			
    		$this->view->form = $form;
    	
    		$request = $this->getRequest();
	    	
	    	if($request->isPost())
	    	{	    		
	    		
	    		if($form->isValid($request->getPost()))
	    		{	   			
	    			$adapter = $this->getAuthAdapter($form->getValues());
	    			$data=$form->getValues();
	    			
		    		$result = Zend_Auth::getInstance()->authenticate($adapter);
						
	    			if($result->isValid())
	    			{
	    				$data = $adapter->getResultRowObject(null, 'password');
	    				Zend_Auth::getInstance()->getStorage()->write($data);
	    				
	    				if($form->remember->isChecked())
	    				{
	    					Zend_Session::rememberMe(60 * 60 * 24 * 14);
	    				}
	    				
		    			$redir = new Zend_Session_Namespace('redirect-to');
	    				if(isset($redir->url))
	    				{
							
	    					$url = unserialize($redir->url)->getRequestUri();
								$info = unserialize($redir->url)->getPathInfo();							
	    					unset($redir->url);
	    					$this->_redirect($info);
	    					return;
	    				}
	    				
	    				//Application_Model_User::updateadminlastlogin($data->id);
	    				
	    				$this->getHelper("Redirector")->gotoSimple('index', 'admin');	
			    	}
	    			else
	    			{
	    				$form->markAsError();
	    				
	    				$form->addErrorMessage("Username or password do not match");
	    			}
	    		}
		    	else
	    		{
	    			$form->markAsError();
	    			$form->addErrorMessage("Invalid data entered");
	    		}
	    	}
    	}
    	
    }
     /*
     * This is the forgotten password action
     */
 	/*
     * This is the function that generates new password links that go into the
     * forgotten passowrd email content
     * 
     * @param int $userId
     * @return string $passwordLink
     */
     
    /*
     * This function validates the hash that has been set to the activate
     * password action. It checks the database for the user id and forgot_password_hash value
     * 
     * @param mixed $hash
     * @return boolean $result
     */
	/*
     * Function for activating the users passwords
     * 
     * This function gets the request url, splits it up and checks if it matches the hash in the db
     * if the hash and id combo is valid then we present the user with a reset password form
     * after the form is submitted we set the new password and remove the has from the users record
     * 
     */
 	/*
     * This is function to set the flash messages for incorrect validation
     * in the forgotten password section
     */
    
    public function logoutAction()
    {
    	$this->getHelper('viewRenderer')->setNoRender();
    	
    	Zend_Auth::getInstance()->getStorage()->clear();
    	
    	$this->getHelper("Redirector")->gotoSimple('login', 'auth');
    }
    
    
	public function getAuthAdapter(array $params)
  {
  	
    	$authAdapter = new Zend_Auth_Adapter_DbTable($this->getInvokeArg('bootstrap')->getPluginResource('db')->getDbAdapter());
    	$authAdapter->setTableName('admin')
    				->setIdentityColumn("username")
    				->setCredentialColumn("password")
    				->setIdentity($params['username'])
    				->setCredential($params['password']);			
    	
    	return $authAdapter;
    }


}