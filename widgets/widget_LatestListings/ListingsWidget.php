<?php

class ListingsWidget extends Widget {
	static $db = array(
		"RSSTitle" => "Text",
		"RssUrl" => "Text",
		"NumberToShow" => "Int",
		"Orientation" => "Varchar"
		);
	
	static $has_one = array();
	
	static $has_many = array();
	
	static $many_many = array();

	static $belongs_many_many = array();
	
	static $defaults = array(
		"NumberToShow" => 10,
		"RSSTitle" => 'Latest Listings',
		"RSSUrl" => 'http://www.equipmentlocator.com/ELSRSS/dealer.aspx?mc=$mastercontrol&lang=na-en&ind=ag',
	);
	static $cmsTitle = 'Listings Widget';
	static $description = "Downloads latest listings from ELS";
	
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
	
	
	function getCMSFields()
	{
		$fields = new FieldSet(); 
			$fields->push(new TextField("RSSTitle", "Custom title for the feed"));
			$fields->push(new TextField("RssUrl", "URL of the other page's RSS feed.  Please make sure this URL points to an RSS feed."));
			$fields->push(new NumericField("NumberToShow", "Number of Items to show"));
			$srcollorientation = array(
	 	 	'V' => 'Vertical',
	 	 	'H' => 'Horizontal'
		    );
			$dropdown = new DropdownField("Orientation", "Please select one option", $srcollorientation);
	        $fields->push ( $dropdown );
	        		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;

	}
	
	function Title() {
		return ($this->RSSTitle) ? $this->RSSTitle : 'Latest Listings Widget';
	}
	
	

	function FeedItems() {
		Requirements::javascript('widgets/widget_LatestListings/jquery.latestistings.min.js');
		Requirements::CSS('widgets/widget_LatestListings/latestistings.css');
		
		if($this->Orientation == 'V'){
		Requirements::customScript(<<<JS
		$(document).ready(function(){ 
			$("#scrollinglistings-V").simplyScroll({
				className: 'vert',
				autoMode:	'loop',
				startOnLoad:	false,
				horizontal: false,
				frameRate: 25,
				speed: 1
			});
 
		});
JS
);
		}elseif($this->Orientation == 'H'){
		Requirements::customScript(<<<JS

		$(document).ready(function(){ 
		
			$("#scrollinglistings-H").simplyScroll({
				className: 'horz',
				autoMode:	'loop',
				startOnLoad:	false,
				horizontal: true,
				frameRate: 25,
				speed: 1
			});
 
		});
JS
);		
		}

		$output = new DataObjectSet();
		
		include_once(Director::getAbsFile(SAPPHIRE_DIR . '/thirdparty/simplepie/SimplePie.php'));
		$t1 = microtime(true);
		$this->feed = new SimplePie($this->AbsoluteRssUrl, TEMP_FOLDER);
		$this->feed->enable_caching(true);
		$this->feed->init();
		if($this->feed->get_items() != 0){
		if($items = $this->feed->get_items(0, $this->NumberToShow)) {
			foreach($items as $item) {
				
				// Cast the Date
				$date = new Date('Date');
				$date->setValue($item->get_date());

				// Cast the Desc
				$description = new Text('Description');
				$description->setValue($item->get_description());
				
				// Cast the Desc
				$title = new Text('Title');
				$title->setValue($item->get_title());
				
				$enclosure = new Text('Photo');
				if ($enclosure = $item->get_enclosure()) {

							
				$imageUrl = $enclosure->get_link();
				$imageUrl = substr(strrchr($imageUrl, "/"), 1);
				$imageUrl = 'http://72.32.111.242/handlers/ThumbnailHandler.ashx?height=100&width=100&area=scroll&image=' .$imageUrl;


				
				$output->push(new ArrayData(array(
				'Photo' => '<img alt="'.$item->get_description().'" title="'.$item->get_description().'" src="'.$imageUrl.'"' .'/>',
				'Title' => $title,
				'Description' => $description,
				'Date' => $date,
				'Link' => $item->get_link(),
				)));
				}				
				
				
								
			}
			return $output;
			}
		}
	}
}