<?php 
/**
 * Defines the StoreLocatorPage page type
 */
 
class StoreLocatorPage extends Page {
   static $db = array(
   	'GmapApi' => 'Text'
   );
   
   static $has_one = array(
   
   );
   
   static $has_many = array(
		'StoreLocations' => 'StoreLocation'
	);
	
	public function getCMSFields()
   	{	
   		$storemanager = new DataObjectManager(
			$this,
			'StoreLocations',
			'StoreLocation',
				array(
				'Name' => 'Name',
				'Address'=>'Address',
				'City' => 'City',
				'State' => 'State',
				'Postcode' => 'Postcode'
				),
			'getCMSFields_forPopup'
   		);
		$storemanager->setPopupWidth(950);
   		
   		$f = parent::getCMSFields();
   		$f->addFieldToTab("Root.Content.Locations", $storemanager);
		$f->addFieldToTab('Root.Content.Locations', new TextField('GmapApi','Google Map API Key'));

 		return $f;
 	}
	
	public function Children(){
        return $this->StoreLocations();
    }

}
 
class StoreLocatorPage_Controller extends Page_Controller {

		public function init() {
		parent::init();
		
		$markerParams = Director::urlParams();
		if($markerParams['ID'] && is_numeric($markerParams['ID'])) {
			$markerId = (int)$markerParams['ID'];
		}
		else {
			$markerId = '';
		}

		$GMaps_API_Key = $this->getField("GmapApi");
		
    	Requirements::javascript("http://maps.google.com/maps?file=api&v=2.x&key=".$GMaps_API_Key);
		
		$Baseurl = Director::BaseURL(); 
		Requirements::customScript(<<<JS
		$(document).ready(function($){ 
			
			$("div.location").hover(
				function(){
					$(this).toggleClass("current");
				},
				function () {
					
					$(this).removeClass("current");
				  }
			);					
		});
		function loadAjax(loadIntoElID, url) {
		 var imgHtml = '<div class="loader"></div>';
		 var loadurl = url + " #storeinfo ";
		 jQuery("#" + loadIntoElID).html(imgHtml);
		 jQuery("#" + loadIntoElID).load(loadurl);
		 return true;
		}
JS
);
		Requirements::customScript(<<<JS
		//<![CDATA[
		    if (GBrowserIsCompatible()) {
		      // this variable will collect the html which will eventually be placed in the side_bar
		    
		      // arrays to hold copies of the markers and html used by the side_bar
		      // because the function closure trick doesnt work there
		      var gmarkers = [];
		      var htmls = [];
		      // arrays to hold variants of the info window html with get direction forms open
		      var to_htmls = [];
		      var from_htmls = [];
		 
		      // A function to create the marker and set up the event window
		      function createMarker(point,name,address,zip) {
		        var marker = new GMarker(point);
		 
		        var i = gmarkers.length;
		 
		        // The info window version with the "to here" form open
		        to_htmls[i] = '<p style="margin:0px;"><strong>' + name + '</strong><br>Directions: <b>To here<\/b> - <a href="javascript:fromhere(' + i + ')">From here<\/a>' +
		           '<br>Start address:</p><form action="http://maps.google.com/maps" method="get" target="_blank">' +
		           '<input type="text" SIZE=28 MAXLENGTH=28 name="saddr" id="saddr" value="" /><br>' +
		           '<INPUT class="action button" value="Get Directions" TYPE="SUBMIT">' +
		           '<input type="hidden" name="daddr" value="' + point.lat() + ',' + point.lng() + 
		                  // "(" + name + ")" + 
		           '"/>';
		        
		        // The info window version with the "to here" form open
		        from_htmls[i] =  '<p style="margin:0px;"><strong>' + name + '</strong><br>Directions: <a href="javascript:tohere(' + i + ')">To here<\/a> - <b>From here<\/b>' +
		           '<br>End address:</p><form action="http://maps.google.com/maps" method="get"" target="_blank">' +
		           '<input type="text" SIZE=28 MAXLENGTH=28 name="daddr" id="daddr" value="" /><br>' +
		           '<INPUT class="action button" value="Get Directions" TYPE="SUBMIT">' +
		           '<input type="hidden" name="saddr" value="' + point.lat() + ',' + point.lng() +
		                  // "(" + name + ")" + 
		           '"/>';
		        
		        // The inactive version of the direction info
		        html = '<p style="margin:0px;"><strong>' + name + '</strong><br>Directions: <a href="javascript:tohere('+i+')">To here<\/a> - <a href="javascript:fromhere('+i+')">From here<\/a></p>';
		        htmllist = '<p><strong><a href="javascript:myclick(' + i + ')">' + name + '<\/a></strong><br/>' + address + '&nbsp;' + zip + '</p><p>Directions: <a href="javascript:tohere('+i+')">To here<\/a> - <a href="javascript:fromhere('+i+')">From here<\/a></p>';
		
		        GEvent.addListener(marker, "click", function() {
		          marker.openInfoWindowHtml('<p style="margin:0px;"><strong>' + name + '</strong><br>Directions: <a href="javascript:tohere('+i+')">To here<\/a> - <a href="javascript:fromhere('+i+')">From here<\/a></p>');
		        });
		        
		        GEvent.addListener(marker, "click", function() {
		          marker.openInfoWindowHtml('<p style="margin:0px;"><strong>' + name + '</strong><br>Directions: <a href="javascript:tohere('+i+')">To here<\/a> - <a href="javascript:fromhere('+i+')">From here<\/a></p>');
		        });
		        
		        // save the info we need to use later for the side_bar
		        gmarkers.push(marker);
		        htmls[i] = html;
		        return marker;
		      }
		 
		 
		      // This function picks up the click and opens the corresponding info window
		      function myclick(i) {
		        gmarkers[i].openInfoWindowHtml(htmls[i]);
		      }
		 
		      // functions that open the directions forms
		      function tohere(i) {
		        gmarkers[i].openInfoWindowHtml(to_htmls[i]);
		      }
		      function fromhere(i) {
		        gmarkers[i].openInfoWindowHtml(from_htmls[i]);
		      }
		 
		 
		      // create the map
		      var map = new GMap2(document.getElementById("map"));
		      map.addControl(new GLargeMapControl());
		      map.addControl(new GMapTypeControl());
		      map.setCenter(new GLatLng(39.011902,-98.484246), 6);
		 
		      // Read the data from example.xml
		      var request = GXmlHttp.create();
		      request.open("GET", "$this->URLSegment/markers/$markerId", true); //RUNS MARKERS FUNCTION
		      request.onreadystatechange = function() {
		        if (request.readyState == 4) {
		          var xmlDoc = GXml.parse(request.responseText);
		          // obtain the array of markers and loop through it
		          var markers = xmlDoc.documentElement.getElementsByTagName("marker");
		          
		          for (var i = 0; i < markers.length; i++) {
		            // obtain the attribues of each marker
		            var lat = parseFloat(markers[i].getAttribute("lat"));
		            var lng = parseFloat(markers[i].getAttribute("lng"));
		            var name = parseFloat(markers[i].getAttribute("name"));
		            var address = parseFloat(markers[i].getAttribute("address"));
		            var zip = parseFloat(markers[i].getAttribute("zip")); 
					
		 			var point = new GLatLng(lat,lng);
		            var address = markers[i].getAttribute("address");
		            var zip = markers[i].getAttribute("zip");
		            var name = markers[i].getAttribute("name");
		            // create the marker
		            var marker = createMarker(point,name,address,zip);
		            map.addOverlay(marker);
					map.setCenter(point, 6);
		          }
		        }
		      }
		      request.send(null);
		    }
		 
		    else {
		      alert("Sorry, the Google Maps API is not compatible with this browser");
		    }
		 
		    // This Javascript is based on code provided by the
		    // Community Church Javascript Team
		    // http://www.bisphamchurch.org.uk/   
		    // http://econym.org.uk/gmap/
		 
		    //]]>
JS
);


}


		function markers() {
			//parent::init();
			$markerParams = Director::urlParams();
	   	   	$markerId = (int)$markerParams['ID'];
			
			$this->response->addHeader("Content-Type", "application/xml");
			if($markerId) {
				$StoreLocations = DataObject::get_by_id('StoreLocation', $markerId);
			}
			else {
				$StoreLocations = DataObject::get('StoreLocation');
			}
			return $this->customise(array("StoreLocations" => $StoreLocations))->renderWith("MarkerXML");
		}  
		
		
		function getLocations() {
		return DataObject::get('StoreLocation');
		}

		function getLocation() {
		return DataObject::get_one('StoreLocation');
		}
		
		
		function store($id = null) {
	 		$params = Director::urlParams(); 
	   	   	$id = (int)$params['ID'];

	    	$object2 = DataObject::get_by_id('StoreLocation', $id);
	      
	      	return $this 
	         ->customise(array('StoreLocation' => $object2)) 
	         ->renderWith(array('Directory')); 
		}
		
	

}