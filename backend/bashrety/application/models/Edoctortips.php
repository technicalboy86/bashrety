<?php

class Application_Model_Edoctortips
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function getalltips()
	{	
		$db = Zend_Db_Table::getDefaultAdapter();
		$tips= $db->fetchAssoc("SELECT * FROM edoctortips");
	
		return $tips;
	}
	public static function gettipbykey($key)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();
		$tips= $db->fetchRow("SELECT * FROM edoctortips where metakey='".$key."'");		
	
		return $tips;
	}	
	public static function addtip($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$tip= $db->fetchRow("SELECT * FROM edoctortips where metakey='".$data['metakey']."'");
		$data['create_date']=date("Y-m-d H:i:s");
		if($tip) {
			$db->update('edoctortips',$data,'metakey="'.$data['metakey'].'"');
		} else {	
			$db->insert('edoctortips',$data);
		}
	}
	public static function deletetip($key) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('edoctortips','metakey="'.$key.'"');
	}
}