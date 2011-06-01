<?php

// SkyscraperWidget Widget 0.0.1 for the SilverStripe Blog Module
// 12.01.2009
// By nivanka@whynotonline.com
// Save this and SkyscraperWidget.ss to widget_skyscraperwidget/ and run "db/build".

class SkyscraperWidget extends Widget{

	//The widget info
	static $title = "Quick Links";
	static $cmsTitle = "Skyscrapers Widget";
	static $description = "This widget enables you to add skyscrapers to your website";

	static $db = array(
		"Adcode1" => "HTMLText",
		"Adcode2" => "HTMLText",
		"Adcode3" => "HTMLText",
		"OnlyThis" => "Int"
	);
	
	function getCMSFields(){
	
		return new FieldSet(
			new TextareaField("Adcode1", "Ad code 1"),
			new TextareaField("Adcode2", "Ad code 2"),
			new TextareaField("Adcode3", "Ad code 3"),
			new DropdownField("OnlyThis", "Show only the following ad", array("0" => "Rotate", "1" => "1", "2"=>"2" , "3" => "3"))
		);
	
	}
	
	function getSkyscraper(){
		
		switch($this->OnlyThis){
			
			case 0:
				$codes = array();
				
				if(strcmp($this->Adcode1,""))
					$codes[] = $this->Adcode1;
				if(strcmp($this->Adcode2,""))
					$codes[] = $this->Adcode2;
				if(strcmp($this->Adcode3,""))
					$codes[] = $this->Adcode3;
				
				shuffle($codes);
				if(sizeof($codes) != 0)
					return $codes[0];
				else
					return null;
			case 1:
				return $this->Adcode1;
			case 2:
				return $this->Adcode2;
			case 3:
				return $this->Adcode3;
					
		}

	
		
	}

}


