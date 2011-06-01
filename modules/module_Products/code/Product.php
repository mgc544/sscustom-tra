<?php

class Product extends DataObject {
	
	static $db = array(
		'Name' => 'Text',
		'Manufacture' => 'Text',
		'ProductDescription' => 'HTMLText',
		'VisitSite' => 'Text',
		'Publish' => 'Boolean'
	);
	
	static $api_access = true;
	static $default_extension =  "json";
	static $default_mimetype =  "text/json";
	
	static $has_one = array(
		'ProductHolder' => 'ProductHolder',
		'ProductCategory' => 'ProductCategory',
		'MainImage' => 'Image'
	);	
	
	static $has_many = array(
		'ProductModels' => 'ProductModel',
		'Brochures' => 'Brochure'
	);	
	
	static $defaults = array(
	"Publish" => 1,
	);

		
	function getCMSFields()
	{
		
		
		$dep_map = array();
		if($departments = DataObject::get("ProductCategory", "ProductHolderID='{$this->ProductHolderID}'")) {
			$dep_map = $departments->map("ID", "Category");
		}

	
		$modelsmanager = new DataObjectManager(
				$this,
				'ProductModels',
				'ProductModel',
				array('ModelNumber' => 'Model Number', 'Thumbnail' => 'Model Photo')
			);
			$modelsmanager->setPopupWidth(900);

		$brochuremanager = new FileDataObjectManager(
				$this,
				'Brochures',
				'Brochure',
				'Attachment',
				array('AttachmentDescription' => 'Attachment Description')
			);

		$fields = new FieldSet( 
			
			 new HorizontalTabSet("Root", 
			      new Tab('Info',
				  new DropdownField('ProductCategoryID','Category',$dep_map),
				  new TextField('Name', 'Name'),
			      new TextField('Manufacture', 'Manufacture'),
			      new TextField('VisitSite', 'Visit Site'),
			      new SimpleTinyMCEField('ProductDescription', 'Product Description'),
			      new ImageField("MainImage", "Upload image below", null, null, null, "Uploads/Products/images"),
			      new CheckboxField("Publish", "Set for publish?")
			   	  ),
			   	  new Tab('Models', $modelsmanager),
			   	  new Tab('Brochures', $brochuremanager)

			) /* end tab set */
		

		); /* end field set */
		
		return $fields; 
	}
	
	
	
	      		
	
				
		function getThumbnail() 
		{
		    if ($Image = $this->MainImage()) 
		    {
		        return $Image->CMSThumbnail();
		    } 
		    else
		    {
		        return '(No Image)';
		    }
		}		
				
				
		
}
