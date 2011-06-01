<?php

class YoutubeWidget extends Widget {
	static $db = array(
		"Method" => "Int",
		"User" => "Varchar",
		"MaxResults" => "Int",
		"StartIndex" => "Int"
	);
	
	static $defaults = array(
		"Method" => 1,
		"MaxResults" => 5,
		"StartIndex" => 1
	);
	
  static $title = "YouTube Videos Widget";
  static $cmsTitle = "YouTube Videos";
  static $description = "Shows thumbnails of your Youtube videos.";
	

   function Videos(){
	if($this->_cachedVideos) return $this->_cachedVideos;	
		Requirements::javascript('widgets/wiget_YouTube/jquery.youtube.js');
		Requirements::customScript(<<<JS
		$(document).ready(function($){ 
			$("ul.youtubewidget").ytplaylist({
			addThumbs:true, 
			autoPlay: false,
			thumbSize: 'small',
			playerHeight: '140',
			playerWidth: '220',
			holderId: 'ytvideo'
			}); 
		});
JS
);
   	
   		$youtube = new YoutubeService();
		switch ($this->Method){
			case 1:
				$videos = $youtube->getVideosUploadedByUser($this->User, $this->MaxResults);
				break;
			case 2:
				$videos = $youtube->getFavoriteVideosByUser($this->User);
				break;
		}
		return $videos;
	}

	function flushCache() {
		parent::flushCache();
		
		unset($this->_cachedVideos);
	}

	function getCMSFields() {
	
		return new FieldSet(
			new TextField("User", "Youtube username"),
			new DropdownField("Method", "Select ", array(
				'1' => 'Videos uploaded by',
				'2' => 'Favorite videos of'	) ), 
			new NumericField("MaxResults", "Videos to Show", 5),
			new DropdownField("Sortby", "Sort by ", array(
				'relevance' => 'Relevance',
				'updated' => 'Upload date',
				'viewCount' => 'View count',
				'rating' => 'Rating'))
			);
	}
}