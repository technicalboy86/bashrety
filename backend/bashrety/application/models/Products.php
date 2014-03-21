<?php

class Application_Model_Products 
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function api_getproducts($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		if(!isset($data['id']) || !$data['id']) return null;
		$where='';
		if(isset($data['since']) && $data['since']&& $data['since']!='null') {
			$date=date("Y-m-d H:i:s",$data['since']);
			$where=' where create_date>"'.$date.'"';
		}
		$products_list = $db->fetchAssoc("SELECT * FROM products ".$where);		
		
		return $products_list;
	}
	public static function getallproducts($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$products_list = $db->fetchAssoc("SELECT * FROM products ".$where);		
		
		return $products_list;
	}
	public static function getproductsbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$products = $db->fetchRow("SELECT * FROM products where id=".$id);		
		
		return $products;
	}	
	public static function addproducts($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$image_name=time().'.png';
		$target = "images/products/".$image_name;
		move_uploaded_file($_FILES['products-image']['tmp_name'],$target);
		
		$insert_data=array();
		$insert_data['create_date']=date("Y-m-d H:i:s");
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['image']=$image_name;		
		$insert_data['description']=$data['description'];		
		$insert_data['price']=$data['price'];
		$insert_data['name']=$data['name'];
		$db->insert('products',$insert_data);
	}
	public static function updateproducts($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$update_data=array();
		if($_FILES['products-image']['name']!='') {
			$image_name=time().'.png';
			$target = "images/products/".$image_name;
			move_uploaded_file($_FILES['products-image']['tmp_name'],$target);
			$update_data['image']=$image_name;
		}
		
		$update_data['update_date']=date("Y-m-d H:i:s");
		$update_data['description']=$data['description'];
		$update_data['price']=$data['price'];		
		$update_data['name']=$data['name'];		
		$db->update('products',$update_data, 'id='.$id);		
	}
	public static function deleteproducts($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('products','id='.$id);
	}
}