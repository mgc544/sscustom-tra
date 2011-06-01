<?php

class BuildYourOwnItem extends DataObject {
   
   static $db = array(
     'Name' => 'Text',
      'ExternalLink' => 'Text'
   );
   
   public static $has_one = array(
   	  'BuildYourOwnPage' => 'BuildYourOwnPage',
      'Photo' => 'Image'
   );
   
   public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField('Name'),
			new TextField('ExternalLink'),
        	new ImageField("Photo", "Upload image below", null, null, null, "Uploads/Products/builyourown")
		);
	}
	
	function getThumbnail() 
		{
		    if ($Image = $this->Photo()) 
		    {
		        return $Image->CMSThumbnail();
		    } 
		    else
		    {
		        return '(No Image)';
		    }
		}
	
}



