<?php

class Application_Model_Eventsgoing
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}	
	public static function getalleventsgoing($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$eventsgoing_list = $db->fetchAssoc("SELECT * FROM eventsgoing ".$where);		
		
		return $eventsgoing_list ;
	}
	public static function geteventsgoingbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$eventsgoing = $db->fetchRow("SELECT * FROM eventsgoing where id=".$id);		
		
		return $eventsgoing;
	}
	public static function geteventsgoingbyeventid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$eventsgoing = $db->fetchAssoc("SELECT e.create_date, u.userName, u.email FROM eventsgoing as e left join users as u on u.id=e.user_id where e.event_id=".$id);		
		
		return $eventsgoing;
	}	
}