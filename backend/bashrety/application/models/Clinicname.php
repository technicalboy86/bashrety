<?php

class Application_Model_Clinicname
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function api_getallclinicname()
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		$clinicname_list= $db->fetchAssoc("SELECT * FROM clinicname");		
		
		return $clinicname_list;
	}
	public static function getallclinicname($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$clinicname_list= $db->fetchAssoc("SELECT * FROM clinicname".$where);		
		
		return $clinicname_list;
	}
	public static function getclinicnamebyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$clinicname= $db->fetchRow("SELECT * FROM clinicname where id=".$id);		
		
		return $clinicname;
	}	
	public static function addclinicname($data) {		
		$db = Zend_Db_Table::getDefaultAdapter();		
		
		$clinicname= $db->fetchRow("SELECT * FROM clinicname where name='".$data['name']."'");		
		if($clinicname) return;
		$insert_data=array();
		$insert_data=$data;
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['create_date']=date("Y-m-d H:i:s");				
		
		$db->insert('clinicname',$insert_data);
	}
	public static function updateclinicname($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();				
		$update_data=array();		
		
		$update_data=$data;
		$update_data['update_date']=date("Y-m-d H:i:s");		
		
		$db->update('clinicname',$update_data, 'id='.$id);		
	}
	public static function deleteclinicname($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('clinicname','id='.$id);
	}
}