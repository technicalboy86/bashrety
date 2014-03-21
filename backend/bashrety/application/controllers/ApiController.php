<?php

class ApiController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    	echo "Please try correct api url"; exit;
        // action body
    }	  
    public function loginAction() {
	$data = $_REQUEST;	
    	$user_id=Application_Model_User::register_user($data);
    	$res=array();
    	$res['user_id']=$user_id;
    	echo json_encode($res); exit;
    }
    public static function add_removeproduct($rows, $add_remove_products) {
    	$add_products=$add_remove_products['add'];    	
    	$remove_products=$add_remove_products['remove'];
    	
    	$products=array();
    	$res=array();
    	for($i=0; $i<sizeof($rows); $i++) {
    		if(!in_array($rows[$i]['id'],$add_products) && !in_array($rows[$i]['id'],$remove_products))
    			$res[]=$rows[$i];
    	}
    	for($i=0;$i<sizeof($add_products);$i++) {
    		$product=Application_Model_Products::getproductsbyid($add_products[$i]);
    		if($product)
	    		$res[]=$product;
    	}
    	return $res;
    }
    public static function getedoctorproductid($metakey,$type) {
	$db = Zend_Db_Table::getDefaultAdapter();
    	$result=$db->fetchAssoc("select product_id from edoctorproducts where metakey='".$metakey."' and type='".$type."'");
    	$res=array();
    	foreach($result as $row)
    		$res[]=intval($row['product_id']);
    	return $res;
    }
    public function edoctorAction() {
    	$db = Zend_Db_Table::getDefaultAdapter();
    	$fixed_question['gender']['male']['add']=self::getedoctorproductid('gender-male','add');
	$fixed_question['gender']['male']['remove']=self::getedoctorproductid('gender-male','remove');
    	$fixed_question['gender']['female']['add']=self::getedoctorproductid('gender-female','add');
	$fixed_question['gender']['female']['remove']=self::getedoctorproductid('gender-female','remove');
	
    	$fixed_question['skin'][6]['add']=self::getedoctorproductid('skin-6','add');
	$fixed_question['skin'][6]['remove']=self::getedoctorproductid('skin-6','remove');
    	$fixed_question['skin'][1]['add']=self::getedoctorproductid('skin-1','add');
	$fixed_question['skin'][1]['remove']=self::getedoctorproductid('skin-1','remove');
    	$fixed_question['skin'][2]['add']=self::getedoctorproductid('skin-2','add');
	$fixed_question['skin'][2]['remove']=self::getedoctorproductid('skin-2','remove');
    	$fixed_question['skin'][3]['add']=self::getedoctorproductid('skin-3','add');
	$fixed_question['skin'][3]['remove']=self::getedoctorproductid('skin-3','remove');
    	$fixed_question['skin'][4]['add']=self::getedoctorproductid('skin-4','add');
	$fixed_question['skin'][4]['remove']=self::getedoctorproductid('skin-4','remove');
    	$fixed_question['skin'][5]['add']=self::getedoctorproductid('skin-5','add');
	$fixed_question['skin'][5]['remove']=self::getedoctorproductid('skin-5','remove');
	
	$fixed_question['acne']['black']['add']=self::getedoctorproductid('acne-black','add');
	$fixed_question['acne']['black']['remove']=self::getedoctorproductid('acne-black','remove');
    	$fixed_question['acne']['white']['add']=self::getedoctorproductid('acne-white','add');
	$fixed_question['acne']['white']['remove']=self::getedoctorproductid('acne-white','remove');
    	$fixed_question['acne']['red']['add']=self::getedoctorproductid('acne-red','add');
	$fixed_question['acne']['red']['remove']=self::getedoctorproductid('acne-red','remove');
	$fixed_question['acne']['big-red']['add']=self::getedoctorproductid('acne-big-red','add');
	$fixed_question['acne']['big-red']['remove']=self::getedoctorproductid('acne-big-red','remove');
	
    	$fixed_question['freckle']['no']['add']=self::getedoctorproductid('freckle-no','add');
	$fixed_question['freckle']['no']['remove']=self::getedoctorproductid('freckle-no','remove');
	$fixed_question['freckle']['dark']['add']=self::getedoctorproductid('freckle-dark','add');
	$fixed_question['freckle']['dark']['remove']=self::getedoctorproductid('freckle-dark','remove');
    	$fixed_question['freckle']['freckle']['add']=self::getedoctorproductid('freckle-freckle','add');
	$fixed_question['freckle']['freckle']['remove']=self::getedoctorproductid('freckle-freckle','remove');
	$fixed_question['freckle']['melsama']['add']=self::getedoctorproductid('freckle-melsama','add');
	$fixed_question['freckle']['melsama']['remove']=self::getedoctorproductid('freckle-melsama','remove');	
	
	$fixed_question['sensitivity']['yes']['add']=self::getedoctorproductid('sensitivity-yes','add');
	$fixed_question['sensitivity']['yes']['remove']=self::getedoctorproductid('sensitivity-yes','remove');
	$fixed_question['sensitivity']['no']['add']=self::getedoctorproductid('sensitivity-no','add');
	$fixed_question['sensitivity']['no']['remove']=self::getedoctorproductid('sensitivity-no','remove');
	
	$fixed_question['around_eyes']['none']['add']=self::getedoctorproductid('aroundeyes-none','add');
	$fixed_question['around_eyes']['none']['remove']=self::getedoctorproductid('aroundeyes-none','remove');
    	$fixed_question['around_eyes']['dark']['add']=self::getedoctorproductid('aroundeyes-dark','add');
	$fixed_question['around_eyes']['dark']['remove']=self::getedoctorproductid('aroundeyes-dark','remove');
    	$fixed_question['around_eyes']['puffiness']['add']=self::getedoctorproductid('aroundeyes-puffiness','add');
	$fixed_question['around_eyes']['puffiness']['remove']=self::getedoctorproductid('aroundeyes-puffiness','remove');
	
	$fixed_question['skin_aging']['none']['add']=self::getedoctorproductid('skinaging-none','add');
	$fixed_question['skin_aging']['none']['remove']=self::getedoctorproductid('skinaging-none','remove');
    	$fixed_question['skin_aging']['medium']['add']=self::getedoctorproductid('skinaging-medium','add');
	$fixed_question['skin_aging']['medium']['remove']=self::getedoctorproductid('skinaging-medium','remove');
    	$fixed_question['skin_aging']['deep']['add']=self::getedoctorproductid('skinaging-deep','add');
	$fixed_question['skin_aging']['deep']['remove']=self::getedoctorproductid('skinaging-deep','remove');
	
	$fixed_question['skin_type']['dry']['add']=self::getedoctorproductid('skintype-dry','add');
	$fixed_question['skin_type']['dry']['remove']=self::getedoctorproductid('skintype-dry','remove');
    	$fixed_question['skin_type']['mixed']['add']=self::getedoctorproductid('skintype-mixed','add');
	$fixed_question['skin_type']['mixed']['remove']=self::getedoctorproductid('skintype-mixed','remove');
    	$fixed_question['skin_type']['oily']['add']=self::getedoctorproductid('skintype-oily','add');
	$fixed_question['skin_type']['oily']['remove']=self::getedoctorproductid('skintype-oily','remove');
	
    	$fixed_question['wide_pores']['wide_pores']['add']=self::getedoctorproductid('pores-scars-pores','add');
	$fixed_question['wide_pores']['wide_pores']['remove']=self::getedoctorproductid('pores-scars-pores','remove');
    	$fixed_question['scars']['scars']['add']=self::getedoctorproductid('pores-scars-scars','add');
	$fixed_question['scars']['scars']['remove']=self::getedoctorproductid('pores-scars-scars','remove');

	/*var_dump($fixed_question); exit;	
	
    	$fixed_question=array('gender'=>
    				array('male'=>
    					array('add'=>array(1,2),'remove'=>array(3)),
    				      'female'=>
    				      	array('add'=>array(4),'remove'=>array(1))),
    			      'skin'=>
    			      	array(array('add'=>array(5,9),'remove'=>array(4)),
    			      		array('add'=>array(8),'remove'=>array(7)),
    			      		array('add'=>array(2,6),'remove'=>array(1)),
    			      		array('add'=>array(1),'remove'=>array(5)),
    			      		array('add'=>array(4),'remove'=>array(3)),
    			      		array('add'=>array(6),'remove'=>array(2))),
    			      'acne'=>
    			      	array('none'=>
    			      		array('add'=>array(3,7),'remove'=>array(2)),
    			      	      'few'=>
    			      	      	array('add'=>array(7),'remove'=>array(9)),
    			      	      'many'=>
    			      	      	array('add'=>array(5,9),'remove'=>array(4))),
    			      'freckle'=>
    			      	array('no'=>
    			      		array('add'=>array(2),'remove'=>array(1,3)),
    			      	      'yes'=>
    			      	      	array('add'=>array(3),'remove'=>array(8))));*/
    			      	      	
    	$data =$_REQUEST;
    	$products_list=Application_Model_Products::getallproducts();
    	$res=array();
    	$result=array();
    	$tip='';
    	if(count($products_list )>0) {
    		foreach($products_list as $row)
    			$result[]=$row;
    		}	
	if(isset($data['gender'])) {
		$result=self::add_removeproduct($result,$fixed_question['gender'][$data['gender']]);
		$temp=Application_Model_Edoctortips::gettipbykey('gender-'.$data['gender']);
		$tip.=$temp['tip'].' ';
	}
    	if(isset($data['skin'])) {
    		$result=self::add_removeproduct($result,$fixed_question['skin'][$data['skin']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('skin-'.$data['skin']);
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['acne_black']) && $data['acne_black']) {
    		$result=self::add_removeproduct($result,$fixed_question['acne'][$data['acne_black']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('acne-'.$data['acne_black']);
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['acne_white']) && $data['acne_white']) {
    		$result=self::add_removeproduct($result,$fixed_question['acne'][$data['acne_white']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('acne-'.$data['acne_white']);
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['acne_red']) && $data['acne_red']) {
    		$result=self::add_removeproduct($result,$fixed_question['acne'][$data['acne_red']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('acne-'.$data['acne_red']);
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['acne_big_red']) && $data['acne_big_red']) {
    		$result=self::add_removeproduct($result,$fixed_question['acne']['big-red']);
    		$temp=Application_Model_Edoctortips::gettipbykey('acne-big-red');
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['freckle'])) {
    		$result=self::add_removeproduct($result,$fixed_question['freckle'][$data['freckle']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('freckle-'.$data['freckle']);
		$tip.=$temp['tip'].' ';
    	}
    	if(isset($data['sensitivity'])) {
    		$result=self::add_removeproduct($result,$fixed_question['sensitivity'][$data['sensitivity']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('sensitivity-'.$data['gender']);
		$tip.=$temp['tip'].' ';
    	}
    	if(isset($data['around_eyes'])) {
    		$result=self::add_removeproduct($result,$fixed_question['around_eyes'][$data['around_eyes']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('aroundeyes-'.$data['around_eyes']);
		$tip.=$temp['tip'].' ';
    	}
    	if(isset($data['skin_aging'])) {
    		$result=self::add_removeproduct($result,$fixed_question['skin_aging'][$data['skin_aging']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('skinaging-'.$data['gender']);
		$tip.=$temp['tip'].' ';
    	}
    	if(isset($data['skin_type'])) {
    		$result=self::add_removeproduct($result,$fixed_question['skin_type'][$data['skin_type']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('skintype-'.$data['gender']);
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['wide_pores']) && $data['wide_pores']) {
    		$result=self::add_removeproduct($result,$fixed_question['wide_pores'][$data['wide_pores']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('pores-scars-pores');
		$tip.=$temp['tip'].' ';
    	}
    	
    	if(isset($data['scars']) && $data['scars']) {
    		$result=self::add_removeproduct($result,$fixed_question['scars'][$data['scars']]);
    		$temp=Application_Model_Edoctortips::gettipbykey('pores-scars-scars');
		$tip.=$temp['tip'].' ';
    	}
    	
    	$res['count']=sizeof($result);
    	$res['products']=$result;
    	$res['tip']=$tip;

    	echo json_encode($res); exit;
    }
    public function getclinicnameAction() {
    $res=array();
    	$result=array();

    	//$areas_list=Application_Model_Areas::api_getallareas();
    	$db = Zend_Db_Table::getDefaultAdapter();
    	$clinicname_list= $db->fetchAssoc("SELECT * FROM clinicname");
    	
    	if(count($clinicname_list )>0) {
    		foreach($clinicname_list as $row)
    			$result[]=$row;
    		}
    	$res['count']=sizeof($result);
    	$res['areas']=$result;
    	echo json_encode($res); exit;
    }
    public function eventsgoingAction() {
    	$data=$_REQUEST;
     	$db = Zend_Db_Table::getDefaultAdapter();
	$eventgoing=$db->fetchRow("SELECT * FROM eventsgoing where event_id=".$data['event_id']." and user_id=".$data['user_id']);
	if($eventgoing) exit;
     	$data['create_date']=date("Y-m-d H:i:s");
     	$db->insert('eventsgoing',$data);
     	exit;
    }
    public function getallareasAction() {
    $res=array();
    	$result=array();

    	//$areas_list=Application_Model_Areas::api_getallareas();
    	$db = Zend_Db_Table::getDefaultAdapter();
    	$areas_list= $db->fetchAssoc("SELECT * FROM areas");
    	
    	if(count($areas_list )>0) {
    		foreach($areas_list as $row)
    			$result[]=$row;
    		}
    	$res['count']=sizeof($result);
    	$res['areas']=$result;
    	$res['time']=time();
    	echo json_encode($res); exit;
    }
	public function searcheventsAction() {
			$data = $_REQUEST;	
			$res=array();    	
    	$result=array();
				
    	//$events_list=Application_Model_Events::getsearchevents($data);
    	$db = Zend_Db_Table::getDefaultAdapter();
		
		$where='where 1 ';
		if(isset($data['events_from'])) {
			$date=explode('-',$data['events_from']);
			$where .=" and date>='".$date['1']."/".$date['2']."/".$date['0']."'";
		}
		if(isset($data['events_to'])) {
			$date=explode('-',$data['events_to']);
			$where .=" and date<='".$date['1']."/".$date['2']."/".$date['0']."'";
		}
		if(isset($data['events_area']))
			$where .=" and area='".$data['events_area']."'";
			
		$events_list = $db->fetchAssoc("SELECT * FROM events ".$where);
 
    	if(count($events_list)>0) {
	    	foreach($events_list as $row)
	    		$result[]=$row;
	    	}
	    		
    	$res['count']=count($result);
    	$res['events']=$result;
    	echo json_encode($res); exit;
    }
    public function searchdoctorsAction() {
    	$data =$_REQUEST;			
    	//$doctors_list=Application_Model_Doctors::getsearchdoctors($data);
    	$db = Zend_Db_Table::getDefaultAdapter();	
		$where='where 1 ';
		if(isset($data['doctor_name']))
			$where .=" and doctor_name like'%".$data['doctor_name']."%'";
		if(isset($data['clinic_name']))
			$where .=" and clinic_name='".$data['clinic_name']."'";
		if(isset($data['clinic_area']))
			$where .=" and area='".$data['clinic_area']."'";
			
		$doctors_list = $db->fetchAssoc("SELECT * FROM doctors ".$where);
    	$res=array();
    	$result=array();
    	if(count($doctors_list )>0) {
	    	foreach($doctors_list as $row)
    			$result[]=$row;
    		}
    	$res['count']=count($result);
    	$res['doctors']=$result;
    	echo json_encode($res); exit;
    }
    public function getproductsAction() {
    	$data = $_REQUEST;
    	$products_list=Application_Model_Products::api_getproducts($data);
    	$res=array();
    	$result=array();
    	if(count($products_list )>0) {
    		foreach($products_list as $row)
    			$result[]=$row;
    		}
    	$res['count']=count($result);
    	$res['products']=$result;
    	$res['time']=time();
    	echo json_encode($res); exit;
    }
    public function getarticlesAction() {
	$data = $_REQUEST;
    	$articles_list=Application_Model_Articles::api_getarticles($data);
    	$result=array();
    	$res=array();
    	if(count($articles_list )>0) {
    		foreach($articles_list as $row)
    			$result[]=$row;
    		}
    	$res['count']=count($result);
    	$res['articles']=$result;
    	$res['time']=time();
    	echo json_encode($res); exit;
    }
}