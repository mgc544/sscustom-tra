<?php

class RSSPage extends Page {
	static $db = array(
		"RSSTitle" => "Text",
		"RssUrl" => "Text",
		"NumberToShow" => "Int"
	);
	
	static $defaults = array(
		"NumberToShow" => 300,
	);
	static $cmsTitle = "RSS Feed";
	static $description = "Shows the latest entries of a RSS feed.";
	
	/**
	 * If the RssUrl is relative, convert it to absolute with the
	 * current baseURL to avoid confusing simplepie.
	 * Passing relative URLs to simplepie will result
	 * in strange DNS lookups and request timeouts.
	 * 
	 * @return string
	 */
	function getAbsoluteRssUrl() {
		$urlParts = parse_url($this->RssUrl);
		if(!isset($urlParts['host']) || !$urlParts['host']) {
			return Director::absoluteBaseURL() . $this->RssUrl;
		} else {
			return $this->RssUrl;
		}
	}
	
	function getCMSFields() {
	$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Content.Main",	new TextField("RSSTitle"));
		$fields->addFieldToTab("Root.Content.Main",	new TextField("RssUrl"));
		$fields->addFieldToTab("Root.Content.Main",	new NumericField("NumberToShow"));
		return $fields;
	}
	
	
	function ListingItems() {
		$output = new DataObjectSet();
		
		include_once(Director::getAbsFile(SAPPHIRE_DIR . '/thirdparty/simplepie/SimplePie.php'));
		
		$t1 = microtime(true);
		$this->feed = new SimplePie($this->AbsoluteRssUrl, TEMP_FOLDER);
		$this->feed->init();
		if($items = $this->feed->get_items(0, $this->NumberToShow)) {
			foreach($items as $item) {
				
				// Cast the Date
				$date = new Date('Date');
				$date->setValue($item->get_date());

				// Cast the Title
				$title = new HTMLText('Title');
				$title->setValue($item->get_title());
				
				// Cast the Title
				$description = new HTMLText('Description');
				$description->setValue($item->get_description());

				
				$output->push(new ArrayData(array(
					'Title' => $title,
					'Date' => $date,
					'Description' => $description,
					'Link' => $item->get_link()
				)));
			}
			return $output;
		}
	}
}
 class RSSPage_Controller extends Page_Controller {
 
 public function init() {
		parent::init();


		
		}

 
 }
?>