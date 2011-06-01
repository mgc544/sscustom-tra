<?php

class RotatorItemDecorator extends Extension {
	
	public function Template($template) {
    return $this->owner->renderWith($template);
	}
	
	
	//Show Rotatos
	function RotatorItemByCategory($num=10, $itemcat) 	{
		Requirements::javascript( ROTATOR_DIR ."/js/jquery.jshowoff.min.js");
		Requirements::css( ROTATOR_DIR. "/css/jshowoff.css");	
		Requirements::customScript(<<<JS
			$('#Intro').jshowoff({
				effect: 'fade',
				autoPlay: 'true',
				animatePause: 'true',
				hoverPause: 	'true',
				links:	'false'
			});
JS
);
		$rotator = DataObject::get("RotatorItem", "Categories = '$itemcat'", "RAND()", '', (int)$num);
		return $this->owner->customise(array("Rotators" => $rotator))->renderWith("Flash");
	}
			
	function FeaturedRotatorItem($num=10) 	{
		Requirements::javascript( ROTATOR_DIR ."/js/jquery.jshowoff.min.js");
		Requirements::css( ROTATOR_DIR. "/css/jshowoff.css");
	    Requirements::customScript(<<<JS
			$('#Intro').jshowoff({
				effect: 'fade',
				autoPlay: 'true',
				animatePause: 'true',
				hoverPause: 	'true',
				links:	'false'
			});
JS
);
		$rotator = DataObject::get("RotatorItem", "Featured = '1'", "RAND()", '', (int)$num);
		return $this->owner->customise(array("Rotators" => $rotator))->renderWith("Flash");
	}

}