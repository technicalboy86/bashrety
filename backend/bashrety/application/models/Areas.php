<?php

class Application_Model_Areas
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function api_getallareas()
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		$areas_list= $db->fetchAssoc("SELECT * FROM areas");		
		
		return $areas_list;
	}
	public static function getallareas($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$areas_list= $db->fetchAssoc("SELECT * FROM areas ".$where);		
		
		return $areas_list;
	}
	public static function getareasbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$areas= $db->fetchRow("SELECT * FROM areas where id=".$id);		
		
		return $areas;
	}	
	public static function addareas($data) {		
		$db = Zend_Db_Table::getDefaultAdapter();		
		
		$areas= $db->fetchRow("SELECT * FROM areas where name='".$data['name']."'");		
		if($areas) return;
		$insert_data=array();
		$insert_data=$data;
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['create_date']=date("Y-m-d H:i:s");				
		
		$db->insert('areas',$insert_data);
	}
	public static function updateareas($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();				
		$update_data=array();		
		
		$update_data=$data;
		$update_data['update_date']=date("Y-m-d H:i:s");		
		
		$db->update('areas',$update_data, 'id='.$id);		
	}
	public static function deleteareas($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('areas','id='.$id);
	}
}