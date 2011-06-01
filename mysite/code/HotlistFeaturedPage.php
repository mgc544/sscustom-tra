<?php
 
class HotlistFeaturedPage extends Page {
 
	// define your database fields here - for example we have author
	static $db = array(
		"Language" => "Varchar",
		"Mode" => "Varchar(1024)",
		'BgColor' => 'Varchar(6)',
		'TextColor' => 'Varchar(6)', 
		'LinkColor' => 'Varchar(6)',
		"Stores" => "Varchar(1024)",
		"height" => "Varchar(20)",
		"width" => "Varchar(20)",
	);

	static $defaults = array(
	   "Mode" => "1",
	   "Language" => "English",
	   "BgColor" => "1f1f1f",
	   "TextColor" => "ffffff",
	   "LinkColor" => "ffffff",
		"height" => '800',
		'width' => '100%'
	);
	
   static $icon = "mysite/images/featured";
	// add custom fields for this flickr gallery page
	function getCMSFields($cms) {

		$fields = parent::getCMSFields($cms);
		$fields->removeFieldFromTab("Root.Content.Main","Content");
		
		$language = array(
 	 	'loc=na-en' => 'English',
 	 	'loc=eu-nl' => 'Netherlands',
 	 	'loc=eu-sp' => 'Spanish',
 	 	'loc=eu-de' => 'German',
 	 	'loc=me-ab' => 'Arabic',
 	 	'loc=eu-ru' => 'Sussian',
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
		$mode = array(
 	 	'2' => 'Hotlist',
 	 	'1' => 'Featured'
	   );
	   $fields->addFieldToTab("Root.Content.Main", new DropdownField("Mode", "Please select one option", $mode ));
		$fields->addFieldToTab('Root.Content.Main', new ColorField('TextColor', 'Text Color'));
		$fields->addFieldToTab('Root.Content.Main', new ColorField('LinkColor', 'Link Color')); 		
		$fields->addFieldToTab('Root.Content.Main', new ColorField('BgColor', 'Background Color'));
		$fields->addFieldToTab("Root.Content.Main", new TextField("Stores","Add store controls seperated by commas", "640px"));
		$fields->addFieldToTab("Root.Content.Main", new TextField("width","Width of remote window", "640px"));
		$fields->addFieldToTab("Root.Content.Main", new TextField("height","Height of remote window", "480px"));
		return $fields;
	}


	function isPost(){
		return Director::urlParam('Action') == 'post';
	}

}

class HotlistFeaturedPage_Controller extends Page_Controller {

	function init() {

		parent::init();	
		
		// Note: you should use SS template require tags inside your templates
		// instead of putting Requirements calls here.  However these are
		// included so that our older themes still work
	}

}

?>
