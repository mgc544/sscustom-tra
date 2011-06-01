<?php

class MainProductHolder extends Page {
	
	public static $db = array(

	);
	
	public static $has_one = array(

	);
	
	public static $has_many = array(
   );
   
   
   static $allowed_children = array('ProductHolder');

   static $icon = "ProductsModule/images/newequipment";

}

class MainProductHolder_Controller  extends Page_Controller {
	

	
	function api($request) { 
      $this->response->addHeader("Content-Type", "application/xml");

	  // if $_GET['source'] exists, do something else, otherwise return normal page 
      
	  if($source = $request->getVar('source')) { 
          
        $products = DataObject::get("Product", "Manufacture = '$source'");

         return $this->customise(array("Products" => $products))->renderWith("ProductsXML");
      } 
      else { 
         return $this; 
      } 
	}  	
	
}

