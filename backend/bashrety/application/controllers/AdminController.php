<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
    	$redirector = $this->getHelper("Redirector");
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('_partials/pagination.phtml');
    	
    	if(!Zend_Auth::getInstance()->hasIdentity())
    	{
    		$redir = new Zend_Session_Namespace('redirect-to');
    		$redir->url = serialize($this->getRequest());
    		
    		$redirector->gotoSimple('login', 'auth');
    	}
    }

    public function indexAction()
    {
        // action body
        $this->getHelper("Redirector")->gotoSimple('articles', 'admin');
    }
	  
    public function newsAction() {
    	$news_list = Application_Model_News::getallnews();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($news_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator;    	
    }
    public function addNewsAction() {
    	$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($_FILES['news-image']['name'] == '')
				{ 
					$has_error = false;
					$error_list['image'] = 'image';
				}
				if($_FILES['news-icon']['name'] == '')
				{ 
					$has_error = false;
					$error_list['icon'] = 'icon';
				}
				if($data['news-link'] =='')
				{
					$has_error = false;
					$error_list['url_link'] = 'link';
				}				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_News::addnews($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('news', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}
    }
    public function eventsAction() {
    	$events_list = Application_Model_Events::getallevents();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($events_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator;     	
    }
    public function addEventsAction() {
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{ 
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}
				if($data['date'] =='')
				{
					$has_error = false;
					$error_list['date'] = 'date';
				}				
				if($data['description'] =='')
				{
					$has_error = false;
					$error_list['description'] = 'description';
				}
				if($data['address'] =='')
				{
					$has_error = false;
					$error_list['address'] = 'address';
				}
				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Events::addevents($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('events', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	
    }
    public function editNewsAction() {
    	$newsid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['news-link'] =='')
				{
					$has_error = false;
					$error_list['url_link'] = 'link';
				}		
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_News::updatenews($data, $newsid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('news', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->news_data=Application_Model_News::getnewsbyid($newsid);
    }
    public function editEventsAction() {
    	$eventsid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}
				if($data['date'] =='')
				{
					$has_error = false;
					$error_list['date'] = 'date';
				}				
				if($data['description'] =='')
				{
					$has_error = false;
					$error_list['description'] = 'description';
				}
				if($data['address'] =='')
				{
					$has_error = false;
					$error_list['address'] = 'address';
				}			  
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Events::updateevents($data, $eventsid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('events', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->events_data=Application_Model_Events::geteventsbyid($eventsid);
    }    
    public function deleteNewsAction() {
    	$newsid=$this->getRequest()->getParam('id', '');
  		Application_Model_News::deletenews($newsid);
  		$this->getHelper("Redirector")->gotoSimple('news', 'admin');
    }
    public function deleteEventsAction() {
    	$eventsid=$this->getRequest()->getParam('id', '');
  		Application_Model_Events::deleteevents($eventsid);
  		$this->getHelper("Redirector")->gotoSimple('events', 'admin');
    }
    
    public function articlesAction() {    	
    	$articles_list = Application_Model_Articles::getallarticles();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($articles_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator;   
    }
    public function addArticleAction() {
    	$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['title'] =='')
				{
					$has_error = false;
					$error_list['title'] = 'title';
				}				
				if($_FILES['teaser_image']['name'] == '')
				{ 
					$has_error = false;
					$error_list['teaser_image'] = 'image';
				}
				if($_FILES['main_image']['name'] == '')
				{ 
					$has_error = false;
					$error_list['main_image'] = 'image';
				}
				if($data['body'] =='')
				{
					$has_error = false;
					$error_list['body'] = 'body';
				}				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Articles::addarticles($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('articles', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}
    }  
    public function editArticlesAction() {
    	$articlesid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['title'] =='')
				{
					$has_error = false;
					$error_list['title'] = 'title';
				}		
				if($data['body'] =='')
				{
					$has_error = false;
					$error_list['body'] = 'body';
				}		
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Articles::updatearticles($data, $articlesid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('articles', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->articles_data=Application_Model_Articles::getarticlesbyid($articlesid);
    }  
    public function deleteArticlesAction() {
    	$articlesid=$this->getRequest()->getParam('id', '');
  		Application_Model_Articles::deletearticles($articlesid);
  		$this->getHelper("Redirector")->gotoSimple('Articles', 'admin');
    }
    
    public function productsAction() {    	
    	$products_list = Application_Model_Products::getallproducts();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($products_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator;   
    }
    public function addProductAction() {
    	$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}				
				if($_FILES['products-image']['name'] == '')
				{ 
					$has_error = false;
					$error_list['products-image'] = 'image';
				}
				if($data['description'] =='')
				{
					$has_error = false;
					$error_list['description'] = 'description';
				}			
				if($data['price'] =='')
				{
					$has_error = false;
					$error_list['price'] = 'price';
				}			
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Products::addproducts($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('products', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}
    }  
    public function editProductsAction() {
    	$productsid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}				
				if($data['description'] =='')
				{
					$has_error = false;
					$error_list['body'] = 'body';
				}			
				if($data['price'] =='')
				{
					$has_error = false;
					$error_list['price'] = 'price';
				}			
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Products::updateproducts($data, $productsid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('products', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->products_data=Application_Model_Products::getproductsbyid($productsid);
    }  
    public function deleteProductsAction() {
    	$productsid=$this->getRequest()->getParam('id', '');
  		Application_Model_Products::deleteproducts($productsid);
  		$this->getHelper("Redirector")->gotoSimple('products', 'admin');
    }
    
    
    public function usersAction() {    	
    	$users_list = Application_Model_User::getallusers();    	
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5;     	
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($users_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
			
    	$this->view->paginator = $paginator; 
    }
    public function addUsersAction() {
    	$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['userName'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}
				if($data['email'] =='')
				{
					$has_error = false;
					$error_list['email'] = 'email';
				}			
				if($data['age'] =='')
				{
					$has_error = false;
					$error_list['age'] = 'age';
				}			
				if($data['gender'] =='')
				{
					$has_error = false;
					$error_list['gender'] = 'gender';
				}
				if($data['language'] =='')
				{
					$has_error = false;
					$error_list['language'] = 'language';
				}
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_User::addusers($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('users', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}
    }  
    public function editUsersAction() {
    	$usersid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{  
				if($data['userName'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}
				if($data['email'] =='')
				{
					$has_error = false;
					$error_list['email'] = 'email';
				}			
				if($data['age'] =='')
				{
					$has_error = false;
					$error_list['age'] = 'age';
				}			
				if($data['gender'] =='')
				{
					$has_error = false;
					$error_list['gender'] = 'gender';
				}
				if($data['language'] =='')
				{
					$has_error = false;
					$error_list['language'] = 'language';
				}		
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_User::updateusers($data, $usersid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('users', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->user_data=Application_Model_User::getusersbyid($usersid);
    }  
    public function deleteUsersAction() {
    	$usersid=$this->getRequest()->getParam('id', '');
  		Application_Model_User::deleteusers($usersid);
  		$this->getHelper("Redirector")->gotoSimple('users', 'admin');
    }
    
    public function doctorsAction() {
    	$doctors_list = Application_Model_Doctors::getalldoctors();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($doctors_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator;     	
    }
    
    public function addDoctorsAction() {
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{ 
				if($data['doctor_name'] =='')
				{
					$has_error = false;
					$error_list['doctor_name'] = 'doctor_name';
				}
				if($data['clinic_name'] =='')
				{
					$has_error = false;
					$error_list['clinic_name'] = 'clinic_name';
				}
				if($data['doctor_title'] =='')
				{
					$has_error = false;
					$error_list['doctor_title'] = 'doctor_title';
				}
				if($data['area'] =='')
				{
					$has_error = false;
					$error_list['area'] = 'area';
				}				
				if($data['clinic_details'] =='')
				{
					$has_error = false;
					$error_list['clinic_details'] = 'clinic_details';
				}
				if($data['clinic_address'] =='')
				{
					$has_error = false;
					$error_list['clinic_address'] = 'clinic_address';
				}
				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Doctors::adddoctors($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('doctors', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	
		$this->view->clinicname=Application_Model_Clinicname::getallclinicname();
    }
    public function editDoctorsAction() {
    	$doctorsid=$this->getRequest()->getParam('id', '');
			$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{
				if($data['doctor_name'] =='')
				{
					$has_error = false;
					$error_list['doctor_name'] = 'doctor_name';
				}
				if($data['clinic_name'] =='')
				{
					$has_error = false;
					$error_list['clinic_name'] = 'clinic_name';
				}
				if($data['doctor_title'] =='')
				{
					$has_error = false;
					$error_list['doctor_title'] = 'doctor_title';
				}
				if($data['area'] =='')
				{
					$has_error = false;
					$error_list['area'] = 'area';
				}				
				if($data['clinic_details'] =='')
				{
					$has_error = false;
					$error_list['clinic_details'] = 'clinic_details';
				}
				if($data['clinic_address'] =='')
				{
					$has_error = false;
					$error_list['clinic_address'] = 'clinic_address';
				}
						  
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Doctors::updatedoctors($data, $doctorsid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('doctors', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->doctors_data=Application_Model_Doctors::getdoctorsbyid($doctorsid);
    	$this->view->clinicname=Application_Model_Clinicname::getallclinicname();
    }   
    public function deleteDoctorsAction() {
    	$doctorsid=$this->getRequest()->getParam('id', '');
  		Application_Model_Doctors::deletedoctors($doctorsid);
  		$this->getHelper("Redirector")->gotoSimple('doctors', 'admin');
    }
    public function areasAction() {
    	$areas_list = Application_Model_Areas::getallareas();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($areas_list );
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator; 
    }
    public function editAreasAction() {
    		$areasid=$this->getRequest()->getParam('id', '');
		$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}						  
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Areas::updateareas($data, $areasid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('areas', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->areas_data=Application_Model_Areas::getareasbyid($areasid);
    }
    public function deleteAreasAction() {
    $areasid=$this->getRequest()->getParam('id', '');
  		Application_Model_Areas::deleteareas($areasid);
  		$this->getHelper("Redirector")->gotoSimple('areas', 'admin');
    }
    public function addAreasAction() {
		$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{ 
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}				
				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Areas::addareas($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('areas', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}      
    }
    public function clinicnameAction() {
    	$clinicname_list= Application_Model_Clinicname::getallclinicname();
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
			$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($clinicname_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
			$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator; 
    }
    public function editClinicnameAction() {
    		$clinicnameid=$this->getRequest()->getParam('id', '');
		$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}						  
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Clinicname::updateclinicname($data, $clinicnameid);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('clinicname', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}    	    	
    	$this->view->clinicname_data=Application_Model_Clinicname::getclinicnamebyid($clinicnameid);
    }
    public function deleteClinicnameAction() {
    $clinicnameid=$this->getRequest()->getParam('id', '');
  		Application_Model_Clinicname::deleteclinicname($clinicnameid);
  		$this->getHelper("Redirector")->gotoSimple('clinicname', 'admin');
    }
    public function addClinicnameAction() {
		$request = $this->getRequest();
	   	$data = $request->getPost();
			if($this->getRequest()->isPost())
			{ 
				if($data['name'] =='')
				{
					$has_error = false;
					$error_list['name'] = 'name';
				}				
				
			  if(count($error_list) == 0)
			  {			  	
			  	$result = Application_Model_Clinicname::addclinicname($data);
			   	$this->view->success = true;
	        $this->getHelper("Redirector")->gotoSimple('clinicname', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 
			}      
    }
    public function eventsgoingAction() {
    	$eventsid=$this->getRequest()->getParam('eventid');
    	$this->view->event_data=Application_Model_Events::geteventsbyid($eventsid);
    	$eventgoing_list= Application_Model_Eventsgoing::geteventsgoingbyeventid($eventsid);
    	$rows = ($this->getRequest()->getPost('rows')) ? $this->getRequest()->getPost('rows') : 5; 
	$this->view->page = $this->_getParam('page', 1);
    	$paginator = Zend_Paginator::factory($eventgoing_list);
			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
			//Set the number of items per page
	$paginator->setItemCountPerPage($rows);    	
    	$this->view->paginator = $paginator; 
    }
    public function edoctorsAction() {
    	$edoctortips=Application_Model_Edoctortips::getalltips();
    	$res=array();
    	foreach($edoctortips as $row)
    		$res[$row['metakey']]=$row;
    	$this->view->edoctortips=$res;
    }
    
    public function edoctorproductAction() {
    	$key=$this->getRequest()->getParam('key');    	
    	if($this->getRequest()->isPost())
	{
		$data=$this->getRequest()->getPost();
		Application_Model_Edoctorproduct::addproducts($data);

	}
	$this->view->metakey=$key;
    	$this->view->product_list=Application_Model_Products::getallproducts();
    	$this->view->add_products=Application_Model_Edoctorproduct::getproductsbykey($key,'add');
    	$this->view->remove_products=Application_Model_Edoctorproduct::getproductsbykey($key,'remove');

    }
	public function deleteEdoctorsproductAction() {
		$id=$this->getRequest()->getParam('id');
		Application_Model_Edoctorproduct::deleteproducts($id);
  		$this->getHelper("Redirector")->gotoSimple('edoctors', 'admin');
	}
	public function addEdoctortipAction() {		
		$key=$this->getRequest()->getParam('key');
		$data=$this->getRequest()->getPost();
		if($this->getRequest()->isPost())
		{
			if($data['tip'] =='')
				{
					$has_error = false;
					$error_list['tip'] = 'tip';
				}				
				
			  if(count($error_list) == 0)
			  {			  	
			  	
				Application_Model_Edoctortips::addtip($data);
			   	$this->view->success = true;
	        		$this->getHelper("Redirector")->gotoSimple('edoctors', 'admin');
			   
			  } else { 
				 	$this->view->error_data= $error_list;	        
			  } 			
	
		}
		$tip_data=Application_Model_Edoctortips::gettipbykey($key);
		$this->view->metakey=$key;
		$this->view->tip_data=$tip_data;
	}
	public function deleteEdoctortipAction() {
		$key=$this->getRequest()->getParam('key');
		Application_Model_Edoctortips::deletetip($key);
  		$this->getHelper("Redirector")->gotoSimple('edoctors', 'admin');
	}
}