<?php
 
class ListingsPage extends Page {
 
	// define your database fields here - for example we have author
	static $db = array(
		"Language" => "Varchar",
		"Etypes" => "Varchar(1024)",
		"Stores" => "Varchar(1024)",
		"Industry" => "Varchar",
		"Class" => "Varchar(1024)",
		"Cat" => "Varchar(1024)",
		'BgColor' => 'Varchar(6)', 
		'TextColor' => 'Varchar(6)', 
		'LinkColor' => 'Varchar(6)', 
		"height" => "Varchar(20)",
		"width" => "Varchar(20)",
	);
	

	static $defaults = array(
	   "Industry" => "ag",
	   "Class" => "Used",
	   "Language" => "English",
	   "BgColor" => "1f1f1f",
	   "TextColor" => "ffffff",
	   "LinkColor" => "ffffff",
		"height" => '800',
		'width' => '100%'
	);
	
	static $can_be_root = false;
	static $allowed_children = "none";

	// add custom fields for this flickr gallery page
	function getCMSFields($cms) {

		$fields = parent::getCMSFields($cms);
 
      	$fields->removeFieldFromTab("Root.Content.Main","Content");

		$industry = array(
 	 	'' => 'all',
 	 	'industry=ag' => 'ag',
 	 	'industry=ce' => 'ce',
 	 	'industry=gc' => 'gc',
 	 	'industry=mh' => 'mh',
 	 	'industry=tree' => 'tree',
 	 	'industry=suv' => 'suv',
 	 	'industry=emv' => 'emv',
 	 	'industry=trk' => 'trk',
 	 	'industry=trls' => 'trls',
 	 	'industry=rent' => 'rent',
 	 	'industry=wde' => 'wde'
	   );
	   
	   $fields->addFieldToTab("Root.Content.Main", new DropdownField("Industry", "Please select one option", $industry ));
		$language = array(
 	 	'loc=na-en' => 'English',
 	 	'loc=eu-nl' => 'Netherlands',
 	 	'loc=eu-sp' => 'Spanish',
 	 	'loc=eu-de' => 'German',
 	 	'loc=me-ab' => 'Arabic',
 	 	'loc=eu-ru' => 'Russian',
 	 	'loc=mx-sp' => 'Mexico',
 	 	'loc=la-sp' => 'Latin America',
 	 	'loc=br-pt' => 'Brazil Portugese',
 	 	'loc=ap-md' => 'Mandarin',
 	 	'loc=na-fr' => 'Canadian French',
 	 	'loc=eu-sw' => 'Swedish',
 	 	'loc=eu-pt' => 'Portugese',
 	 	'loc=eu-en' => 'UK English',
 	 	'loc=eu-da' => 'Danish',
 	 	'loc=au-en' => 'Auzzie',
 	 	'loc=eu-fr' => 'French',
 	 	'loc=eu-it' => 'Italian',
 	 	'loc=eu-pl' => 'Polish',
 	 	'loc=la-pt' => 'Latin American Portugese',
	   );
	   $fields->addFieldToTab("Root.Content.Main", new DropdownField("Language", "Please select one option", $language));
		$class = array(
		'' => 'all',
 	 	'class=30' => 'Used',
 	 	'class=31' => 'New',
 	 	'class=32' => 'Rental',
 	 	'class=33' => 'Salvage',
 	 	'class-parts=34' => 'Salvage Parts',
 	 	'class=35' => 'Lease Return',
 	 	'class=4904' => 'Buyback',
 	 	'class=4905' => 'Aged Inventory'
	   );
	   $fields->addFieldToTab("Root.Content.Main", new DropdownField("Class", "Please select one option", $class ));
	   	
	   	$cat = array(
		'' => 'all',
 	 	'cat=26' => 'Just For Sale',
 	 	'cat=27' => 'For or Rent',
 	 	'cat=28' => 'Rent',
 	 	'cat=29' => 'Want to Buy'
	   );

	    $fields->addFieldToTab("Root.Content.Main", new DropdownField("Cat", "Please select one option", $cat ));
	   	$fields->addFieldToTab('Root.Content.Main', new ColorField('TextColor', 'Text Color'));
		$fields->addFieldToTab('Root.Content.Main', new ColorField('LinkColor', 'Link Color')); 		
		$fields->addFieldToTab('Root.Content.Main', new ColorField('BgColor', 'Background Color')); 		
		$fields->addFieldToTab("Root.Content.Main", new TextField("Etypes","Add equipment types seperated by commas", "640px"));
		$fields->addFieldToTab("Root.Content.Main", new TextField("Stores","Add store controls seperated by commas", "640px"));
		$fields->addFieldToTab("Root.Content.Main", new TextField("width","Width of remote window", "640px"));
		$fields->addFieldToTab("Root.Content.Main", new TextField("height","Height of remote window", "480px"));
		return $fields;
	}


	function isPost(){
		return Director::urlParam('Action') == 'post';
	}

}

class ListingsPage_Controller extends Page_Controller {

	function init() {

		parent::init();	
		
		// Note: you should use SS template require tags inside your templates
		// instead of putting Requirements calls here.  However these are
		// included so that our older themes still work
	}

}

?>




