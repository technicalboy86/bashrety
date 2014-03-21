<?php

class Application_Model_News 
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function getallnews($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$news_list = $db->fetchAssoc("SELECT * FROM news ".$where);		
		
		return $news_list;
	}
	public static function getnewsbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$news = $db->fetchRow("SELECT * FROM news where id=".$id);		
		
		return $news;
	}	
	public static function addnews($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$image_name=time().'.png';
		$target = "images/news/".$image_name;
		move_uploaded_file($_FILES['news-image']['tmp_name'],$target);
		
		$icon_name=time().'.png';
		$target = "images/icons/".$icon_name;
		move_uploaded_file($_FILES['news-icon']['tmp_name'],$target);
		
		$insert_data=array();
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['image']=$image_name;
		$insert_data['icon']=$icon_name;		
		$insert_data['title']=$data['title'];		
		$insert_data['link_url']=$data['news-link'];
		$db->insert('news',$insert_data);
	}
	public static function updatenews($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$update_data=array();
		if($_FILES['news-image']['name']!='') {
			$image_name=time().'.png';
			$target = "images/news/".$image_name;
			move_uploaded_file($_FILES['news-image']['tmp_name'],$target);
			$update_data['image']=$image_name;
		}
		if($_FILES['news-icon']['name']!='') {
			$icon_name=time().'.png';
			$target = "images/icons/".$icon_name;
			move_uploaded_file($_FILES['news-icon']['tmp_name'],$target);
			$update_data['icon']=$icon_name;
		}		
		
		$update_data['update_date']=date("Y-m-d H:i:s");
		$update_data['link_url']=$data['news-link'];
		$update_data['title']=$data['title'];		
		$db->update('news',$update_data, 'id='.$id);		
	}
	public static function deletenews($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('news','id='.$id);
	}
}