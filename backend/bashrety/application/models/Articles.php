<?php

class Application_Model_Articles
{
	/**
	 * @var Zend_Db_Adapter_Abstract
	 */
	private function __construct()
	{
	}
	public static function api_getarticles($data) {
		$db = Zend_Db_Table::getDefaultAdapter();				
		if(!isset($data['id']) || !$data['id']) return null;
		$where='';		
		if(isset($data['since']) && $data['since']&& $data['since']!='null') {
			$date=date("Y-m-d H:i:s", $data['since']);
			$where=' where create_date>"'.$date.'"';
		}
		
		$articles_list = $db->fetchAssoc("SELECT * FROM articles ".$where);		
		
		return $articles_list;
	}
	public static function getallarticles($limit=null)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		
		if($limit)
			$where =" ORDER BY update_date DESC LIMIT ".intval($limit);
		else
			$where =" ORDER BY update_date DESC";
		
		$articles_list = $db->fetchAssoc("SELECT * FROM articles ".$where);		
		
		return $articles_list;
	}
	public static function getarticlesbyid($id)
	{	
		$db = Zend_Db_Table::getDefaultAdapter();				
		$articles = $db->fetchRow("SELECT * FROM articles where id=".$id);		
		
		return $articles;
	}	
	public static function addarticles($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$teaser_image_name='teaser-'.time().'.png';
		$target = "images/articles/".$teaser_image_name;
		move_uploaded_file($_FILES['teaser_image']['tmp_name'],$target);
		
		$main_image_name='main-'.time().'.png';
		$target = "images/articles/".$main_image_name;
		move_uploaded_file($_FILES['main_image']['tmp_name'],$target);
		
		$insert_data=array();
		$insert_data['update_date']=date("Y-m-d H:i:s");
		$insert_data['create_date']=date("Y-m-d H:i:s");
		$insert_data['teaser_image']=$teaser_image_name;
		$insert_data['main_image']=$main_image_name;		
		$insert_data['title']=$data['title'];		
		$insert_data['body']=$data['body'];
		$db->insert('articles',$insert_data);
	}
	public static function updatearticles($data, $id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$update_data=array();
		if($_FILES['teaser_image']['name']!='') {
			$teaser_image_name='teaser-'.time().'.png';
			$target = "images/articles/".$teaser_image_name;
			move_uploaded_file($_FILES['teaser_image']['tmp_name'],$target);
			$update_data['teaser_image']=$teaser_image_name;
		}
		if($_FILES['main_image']['name']!='') {
			$main_image_name='main-'.time().'.png';
			$target = "images/articles/".$main_image_name;
			move_uploaded_file($_FILES['main_image']['tmp_name'],$target);
			$update_data['main_image']=$main_image_name;
		}		
		
		$update_data['update_date']=date("Y-m-d H:i:s");
		$update_data['body']=$data['body'];
		$update_data['title']=$data['title'];		
		$db->update('articles',$update_data, 'id='.$id);		
	}
	public static function deletearticles($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('articles','id='.$id);
	}
}