<?php
/**
 * Defines the News Holder type
 */
class ProductHolder extends Page {
   static $db = array(
   );
   
   static $has_one = array(
   );
   static $api_access = true;

   static $has_many = array (
   		'Products' => 'Product', 
   		'ProductCategories' => 'ProductCategory'
   	);
   	
   	public function getCMSFields()
   	{
   	

   		$manager = new DataObjectManager(   			
   			$this,
			'Products',
			'Product',
			array(
			'Thumbnail' => 'Image',
			'Name' => 'Name',
			'ProductDescription' => 'Product Description',
			'ProductCategory.Category' => 'Category'
			),
   			'getCMSFields_forPopup'
   		);
   		$manager->setPopupWidth(950);
   		
   		$f = parent::getCMSFields();
   		$f->addFieldToTab("Root.Content.Add Products", $manager);
   		
   		
   		$f->addFieldToTab("Root.Content.Product Categories", new DataObjectManager(   			
   			$this,
   			'ProductCategories',
   			'ProductCategory',
   			array('Category'=>'Category'),
   			'getCMSFields_forPopup'
   		));
   		return $f;
   	}

   	 	
   	public function Children(){
        return $this->ProductCategories();
    }
   	

}

class ProductHolder_Controller extends Page_Controller {

//add our 'show' function as an allowed URL action
	static $allowed_actions = array(
		'category',
		'singleproduct',
		'showImage',
		'specifications',
		'features'
	);

		public function init() {
		parent::init();
		Requirements::javascript('modules/module_Products/js/jquery.popupWindow.js');
		Requirements::customScript(<<<JS
		$(document).ready(function(){ 
			$('.pop').popupWindow({ 
				height:600, 
				width:820, 
				top:50, 
				left:50 ,
				resizable: 0,
				scrollbars: 1
			});
		});
		
		function loadAjax(loadIntoElID, url) {
			 var imgHtml = '<div class="loader"></div>';
			 var loadurl = url;
			 jQuery("#" + loadIntoElID).html(imgHtml);
			 jQuery("#" + loadIntoElID).load(loadurl);
			 return true;
		}
JS
);

}
	

	function category() 
	{		
		if($ProductCategory = $this->getProductCategory())
		{
			$Data = array(
				'ProductCategory' => $ProductCategory
			);
			
			//return our $Data to use on the page
			return $this->Customise($Data)->renderWith(array('ProductHolder_show'));
		}
		else
		{
			//Product not found
			return $this->httpError(404, 'Sorry there are no products at this time.');
		}
	}
	

	

	function features() 
	{		
		if($ProductModel = $this->getProductModel())
		{
			$Data = array(
				'ProductModel' => $ProductModel
			);
			
			//return our $Data to use on the page
			return $this->Customise($Data)->renderWith(array('Features'));
		}
		else
		{
			//Product not found
			return $this->httpError(404, 'Sorry there are no products at this time.');
		}
	}
	
	function specifications() 
	{		
		if($ProductModel = $this->getProductModel())
		{
			$Data = array(
				'ProductModel' => $ProductModel
			);
			
			//return our $Data to use on the page
			return $this->Customise($Data)->renderWith(array('Specs'));
		}
		else
		{
			//Product not found
			return $this->httpError(404, 'Sorry there are no products at this time.');
		}
	}
	
	function showImage() 
	{		
		if($ProductModel = $this->getImage())
		{
			$Data = array(
				'ProductModel' => $ProductModel
			);
			
			//return our $Data to use on the page
			return $this->Customise($Data)->renderWith(array('ShowImage'));
		}
		else
		{
			//Product not found
			return $this->httpError(404, 'Sorry there are no products at this time.');
		}
	}


//Get the current Product from the URL, if any
	public function getProductCategory()
	{
		$Params = $this->getURLParams();
		$URLSegment = Convert::raw2sql($Params['ID']);
		
		if($URLSegment && $ProductCategory = DataObject::get_one('ProductCategory', "URLSegment = '" . $URLSegment . "'"))
		{		
			return $ProductCategory;
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
	
	
		public function getImage()
	{
		$Params = $this->getURLParams();
		
		if(is_numeric($Params['ID']) && $ProductModel = DataObject::get_by_id('ProductModel', $Params['ID']))
		{		
			return $ProductModel;
		}
	}	

	

	
//Return our custom breadcrumbs
	public function Breadcrumbs() {
		
		//Get the default breadcrumbs
		$Breadcrumbs = parent::Breadcrumbs();
		
		if($ProductCategory = $this->getProductCategory())
		{
			//Explode them into their individual parts
			$Parts = explode(SiteTree::$breadcrumbs_delimiter, $Breadcrumbs);
	
			//Count the parts
			$NumOfParts = count($Parts);
			
			//Change the last item to a link instead of just text
			$Parts[$NumOfParts-1] = ("<a href=\"" . $this->Link() . "\">" . $this->Title . "</a>");
			
			//Add our extra piece on the end
			$Parts[$NumOfParts] = $ProductCategory->Category; 
	
			//Return the imploded array
			$Breadcrumbs = implode(SiteTree::$breadcrumbs_delimiter, $Parts);			
		}

		return $Breadcrumbs;
	}
	
	
		
	  
	
}

