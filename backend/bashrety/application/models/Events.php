<?php

class Application_Model_Events
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function getsearchevents($data) {
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
			
		return $events_list;		
	}
	public static function getallevents($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$events_list = $db->fetchAssoc("SELECT * FROM events ".$where);		
		
		return $events_list;
	}
	public static function geteventsbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$events = $db->fetchRow("SELECT * FROM events where id=".$id);		
		
		return $events;
	}	
	public static function addevents($data) {		
		$db = Zend_Db_Table::getDefaultAdapter();		
		
		$insert_data=array();
		$insert_data=$data;
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['create_date']=date("Y-m-d H:i:s");				
		
		$db->insert('events',$insert_data);
	}
	public static function updateevents($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();				
		$update_data=array();		
		
		$update_data=$data;
		$update_data['update_date']=date("Y-m-d H:i:s");		
		
		$db->update('events',$update_data, 'id='.$id);		
	}
	public static function deleteevents($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('events','id='.$id);
	}
}