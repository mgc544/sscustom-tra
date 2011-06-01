<?php

class Brand extends DataObject {
   
   static $db = array(
     'BrandName' => 'Text',
      'BrandDescription' => 'HTMLText',
      'VisitSite' => 'Text',
   );
   
   public static $has_one = array(
   	  'BrandPage' => 'BrandPage',
      'BrandPhoto' => 'Image'
   );
   
   public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField('BrandName'),
			new TextareaField('BrandDescription'),
			new TextField('VisitSite'),
        	new ImageField("BrandPhoto", "Upload image below", null, null, null, "Uploads/Products/brands")
		);
	}

	function getThumbnail() 
	{
    if ($BrandPhoto = $this->BrandPhoto()) 
    {
        return $BrandPhoto->CMSThumbnail();
    } 
    else
    {
        return '(No Image)';
    }
	}
		
}



