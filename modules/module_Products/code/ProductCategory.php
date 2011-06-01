<?php

class ProductCategory extends DataObject{

   static $db = array ( 
      'Category' => 'Text',
      'URLSegment' => 'Text',
	  'SEO' => 'Text'
   );
   
   static $api_access = true;


   static $has_one = array ( 
      'ProductHolder' => 'ProductHolder'
   );

   static $has_many = array ( 
    'Products' => 'Product' 
   );

   public function getCMSFields_forPopup() { 
		return new FieldSet( 
         new TextField('Category', 'Category'),
         new TextField('URLSegment', 'URL Segment'),
		 new TextareaField('SEO', 'SEO')
   ); 
}
	
	//Return the Name as a menu title
	function MenuTitle(){
		
		$MenuTitle = $this->Category;
		
		return $MenuTitle;
	}
	

	//Return the Name as a menu title
	function Title(){
		return $this->Category;
	}
	
	public function Children(){

    }
	
		//Generate our thumbnail for the DOM
		public function getThumb()
		{
			if($this->PhotoID && $this->Photo())
				return $this->Photo()->CMSThumbnail();
			else	
				return '(No Image)';
		}
		
		
			function onBeforeWrite()
		{       
			// If there is no URLSegment set, generate one from Title
			if((!$this->URLSegment || $this->URLSegment == 'new-product') && $this->Category != 'New Product') 
			{
				$this->URLSegment = SiteTree::generateURLSegment($this->Category);
			} 
			else if($this->isChanged('URLSegment')) 
			{
				// Make sure the URLSegment is valid for use in a URL
				$segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
				$segment = preg_replace('/-+/','-',$segment);
				  
				// If after sanitising there is no URLSegment, give it a reasonable default
				if(!$segment) {
					$segment = "product-$this->ID";
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
			return (DataObject::get_one('ProductCategory', "URLSegment = '" . $URLSegment ."' AND ID != " . $this->ID));
		}

	
	
		//Return the link to view this all products
		public function Link()
		{
			if($ProductHolder = $this->ProductHolder())
			{
				return $ProductHolder->absoluteLink(). 'category/' . $this->URLSegment;	
			}
		}
	

	
	
		public function LinkingMode()
		{
			//Check that we have a controller to work with and that it is a StaffPage
			if($Controller = Controller::CurrentPage() && Controller::CurrentPage()->ClassName == 'ProductHolder')
			{
				//check that the action is 'show' and that we have a StaffMember to work with
				if(Controller::CurrentPage()->getAction() == 'category' && $ProductCategory = Controller::CurrentPage()->getProductCategory())
				{
					//If the current StaffMember is the same as this return 'current' class
					return ($ProductCategory->ID == $this->ID) ? 'current' : 'link';
				}
			}
		}
	
	
		public function getProductModel()
		{
			$Params = $this->getURLParams();
			$URLSegment = Convert::raw2sql($Params['ID']);

			
			if($URLSegment && $ProductModel = DataObject::get_one('ProductModel', "URLSegment = '" . $URLSegment . "'"))
			{		
				return $ProductModel;
			}
		}
}