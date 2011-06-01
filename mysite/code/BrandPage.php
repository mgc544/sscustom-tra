<?php

class BrandPage extends Page {
   
   public static $db = array(
   );
   
   public static $has_many = array (
   'Brands' => 'Brand'
   );
  
   
   public function getCMSFields()
	{
  $f = parent::getCMSFields();
	$brandmanager = new DataObjectManager(
				$this,
				'Brands',
				'Brand',
				array('BrandName' => 'Brand Name', 'Thumbnail' => 'Image'),
			'getCMSFields_forPopup'
		);
		
		$f->addFieldToTab("Root.Content.Product Lines",$brandmanager);
		return $f;
	}



}

class BrandPage_Controller extends Page_Controller {
}
