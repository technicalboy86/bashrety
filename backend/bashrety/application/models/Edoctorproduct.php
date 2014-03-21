<?php

class Application_Model_Edoctorproduct
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function getproductsbykey($key,$type=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();
		if(isset($type)) {			
			$products = $db->fetchAssoc("SELECT e.id as edoctorid,p.* FROM edoctorproducts as e left join products as p on p.id=e.product_id where metakey='".$key."' and type='".$type."'");		
			}
		else
			$products = $db->fetchAssoc("SELECT e.id as edoctorid, p.* FROM edoctorproducts as e left join products as p on p.id=e.product_id where metakey='".$key."'");		
	
		return $products;
	}	
	public static function addproducts($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$product=$db->fetchRow("Select * from edoctorproducts where product_id=".$data['product_id']." and metakey='".$data['metakey']."'");
		if($product) return;		
		
		$data['create_date']=date("Y-m-d H:i:s");
				
		$db->insert('edoctorproducts',$data);
	}
	public static function deleteproducts($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('edoctorproducts','id='.$id);
	}
}