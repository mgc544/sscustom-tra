<?php

class ProductModel extends DataObject {
	
	static $db = array (
		'ModelNumber' => 'HTMLText',
      	'URLSegment' => 'Text',
		'Features' => 'HTMLText',
		'Specs' => 'HTMLText',
		'Publish' => 'Boolean'

	);
	
	static $api_access = true;
	static $has_one = array (
		'Product' => 'Product',
		'Photo' => 'Image',
	);
	
	static $defaults = array(
	"Publish" => 1,
	);
	
	function getCMSFields()
	{
		return new FieldSet( 
		new TextField('URLSegment', 'URL Segment'),
        new TextField('ModelNumber'),
        new SimpleTinyMCEField('Features'),
        new SimpleTinyMCEField('Specs'),
        new ImageField("Photo", "Upload image below", null, null, null, "Uploads/Products/images"),
    	new CheckboxField("Publish", "Set for publish?")
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


		function onBeforeWrite()
    {       
        // If there is no URLSegment set, generate one from Title
        if((!$this->URLSegment || $this->URLSegment == 'new-model') && $this->Category != 'New Model') 
        {
            $this->URLSegment = SiteTree::generateURLSegment($this->ModelNumber);
        } 
        else if($this->isChanged('URLSegment')) 
        {
            // Make sure the URLSegment is valid for use in a URL
            $segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
            $segment = preg_replace('/-+/','-',$segment);
              
            // If after sanitising there is no URLSegment, give it a reasonable default
            if(!$segment) {
                $segment = "model-$this->ID";
            }
            $this->URLSegment = $segment;
        }
  
        // Ensure that this object has a non-conflicting URLSegment value.
        $count = 2;
        while($this->LookForExistingURLSegment($this->URLSegment)) 
        {
            $this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment) . '-' . $count;
            $count++;
        }
  
        parent::onBeforeWrite();
    }
          
    //Test whether the URLSegment exists already on another Product
    function LookForExistingURLSegment($URLSegment)
    {
        return (DataObject::get_one('ProductModel', "URLSegment = '" . $URLSegment ."' AND ID != " . $this->ID));
    }

	
}	
