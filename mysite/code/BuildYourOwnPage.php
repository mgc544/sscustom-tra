<?php

class BuildYourOwnPage extends Page {
   
   public static $db = array(
   );
   
   public static $has_many = array (
   'BuildYourOwnItems' => 'BuildYourOwnItem'
   
   );
  
   public static $has_one = array(
   			'Photo' => 'Image'
   );
   
   static $icon = "mysite/images/build";
   
   public function getCMSFields()
	{
  $bf = parent::getCMSFields();
  $bf->addFieldToTab("Root.Content.Build Your Own", new DataObjectManager(
			$this,
			'BuildYourOwnItems',
			'BuildYourOwnItem',
			array('Name' => 'Name','ExternalLink'=>'External Link','Thumbnail' => 'Photo'),
			'getCMSFields_forPopup'
		));
		return $bf;
}



}
class BuildYourOwnPage_Controller extends Page_Controller {
}
