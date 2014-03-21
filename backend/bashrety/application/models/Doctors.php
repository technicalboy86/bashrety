<?php

class Application_Model_Doctors
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function getsearchdoctors($data) {
		$db = Zend_Db_Table::getDefaultAdapter();	
		$where='where 1 ';
		if(isset($data['doctor_name']))
			$where .=" and doctor_name like'%".$data['doctor_name']."%'";
		if(isset($data['clinic_name']))
			$where .=" and clinic_name='".$data['clinic_name']."'";
		if(isset($data['clinic_area']))
			$where .=" and area='".$data['clinic_area']."'";
			
		$doctors_list = $db->fetchAssoc("SELECT * FROM doctors ".$where);		
		return $doctors_list;
	}
	public static function getalldoctors($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$doctors_list = $db->fetchAssoc("SELECT * FROM doctors ".$where);		
		
		return $doctors_list;
	}
	public static function getdoctorsbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$doctors = $db->fetchRow("SELECT * FROM doctors where id=".$id);		
		
		return $doctors;
	}	
	public static function adddoctors($data) {		
		$db = Zend_Db_Table::getDefaultAdapter();		
		
		$insert_data=array();
		$insert_data=$data;
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['create_date']=date("Y-m-d H:i:s");				
		
		$db->insert('doctors',$insert_data);
	}
	public static function updatedoctors($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();				
		$update_data=array();		
		
		$update_data=$data;
		$update_data['update_date']=date("Y-m-d H:i:s");		
		
		$db->update('doctors',$update_data, 'id='.$id);		
	}
	public static function deletedoctors($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('doctors','id='.$id);
	}
}