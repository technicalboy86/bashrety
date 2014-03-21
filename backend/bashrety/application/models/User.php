<?php

class Application_Model_User 
{
	private function __construct()
	{
	}
	public static function register_user($data)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();
		if(!isset($data['email']) || !$data['email']) return -1;
		$user= $db->fetchRow("SELECT * FROM users where email='".$data['email']."'");
		if($user) return $user['id'];
		$data['last_login']=date("Y-m-d H:i:s");			
		$data['create_date']=date("Y-m-d H:i:s");
		
		$db->insert('users',$data);

		$user= $db->fetchRow("SELECT * FROM users where email='".$data['email']."'");

		return $user['id'];
	}
	
	public static function getallusers($limit=null)
	{			
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY create_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY create_date DESC";
		
		$users_list = $db->fetchAssoc("SELECT * FROM users ".$where);
				
		return $users_list;
	}
	public static function getusersbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$users = $db->fetchRow("SELECT * FROM users where id=".$id);		
		
		return $users;
	}	
	public static function addusers($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$insert_data=array();
		$insert_data=$data;
		$insert_data['create_date']=date("Y-m-d H:i:s");
		$update_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['last_login']=date("Y-m-d H:i:s");
		
		$db->insert('users',$insert_data);
	}
	public static function updateusers($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$update_data=array();
		
		$update_data=$data;
		$update_data['update_date']=date("Y-m-d H:i:s");
		$db->update('users',$update_data, 'id='.$id);		
	}
	public static function deleteusers($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('users','id='.$id);
	}
}