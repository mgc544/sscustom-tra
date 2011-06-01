<?php

class WeatherWidget extends Widget {
	static $db = array(
		"Title" => "Text",
		);
	
	static $has_one = array();
	
	static $has_many = array();
	
	static $many_many = array();

	static $belongs_many_many = array();
	
	static $defaults = array(
		"Title" => 'Current Weather',
	);
	
	static $cmsTitle = 'Weather Widget';
	static $description = "Gets local weather based on IP address";
	 
	
	
	function getCMSFields()
	{
		$fields = new FieldSet(); 
			$fields->push(new TextField("Title", "Custom title for the widget"));		
		return $fields;

	}
	
	function Title() {
		return ($this->Title) ? $this->Title: 'Current Weather';
	}
	
	
/*------------------------- Weather --------------------*/

function YahooWeather(){ 
   

try{ 

    $geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );     
    $lat = $geoplugin['geoplugin_latitude'];
	$long = $geoplugin['geoplugin_longitude'];
    $getzip = unserialize( file_get_contents('http://www.geoplugin.net/extras/postalcode.gp?lat='.$lat.'&long='.$long.'&format=php'));
    $zip = $getzip['geoplugin_postCode'];

 /*$xml = geturl("http://xml.weather.yahoo.com/forecastrss?p=UKXX0052");*/ 
      $cache_expiry = 60*60; 
      $xml = new RestfulService("http://xml.weather.yahoo.com/forecastrss", $cache_expiry );

      $params = array('p' => $zip,'u'=>'f');

      $xml->setQueryString($params); 
      $conn = $xml->request()->getBody();  
      $msgs = $xml->getValues($conn, "channel"); 
      $conditions = $xml->searchAttributes($conn, "//yweather:condition"); 
      $winds = $xml->searchAttributes($conn, "//yweather:wind"); 
      $locations = $xml->searchAttributes($conn, "//yweather:location"); 
      $atmospheres = $xml->searchAttributes($conn, "//yweather:atmosphere"); 
      $astros = $xml->searchAttributes($conn, "//yweather:astronomy"); 
      $units = $xml->searchAttributes($conn, "//yweather:units");
      $forecasts = $xml->searchAttributes($conn, "//yweather:forecast");  
       
      $compassPoints = array( 
            1 => "N", 
            2 => "NbE", 
            3 => "NNE", 
            4 => "NEbN", 
            5 => "NE", 
            6 => "NEbE", 
            7 => "ENE", 
            8 => "EbN", 
            9 => "E", 
            10 => "EbS", 
            11 => "ESE", 
            12 => "SEbE", 
            13 => "SE", 
            14 => "SEbS", 
            15 => "SEbS", 
            16 => "SbE", 
            17 => "S", 
            18 => "SbW", 
            19 => "SSW", 
            20 => "SWbS", 
            21 => "SW", 
            22 => "SWbW", 
            23 => "WSW", 
            24 => "WbS", 
            25 => "W", 
            26 => "WbN", 
            27 => "WNW", 
            28 => "NWbW", 
            29 => "NW", 
            20 => "NWbN", 
            41 => "NNW", 
            32 => "NbW" 
                      ); 
      $BarometerState = array( 
            0 => "steady", 
            1 => "rising", 
            2 => "falling" 
           );

      /* Get base info */ 
      $output = new DataObjectSet(); 
      foreach($msgs as $msg){ 
         $resArray = array( 
            "Description" => $msg->description, 
			"LastBuildDate" => $msg->lastBuildDate 
         ); 
      }
      
 
       
      /* Get condition info */ 
      foreach($conditions as $condition){ 
         $resArray += array( 
            "ConditionText" => $condition->text, 
            "ConditionCode" => ($condition->code==3200)?44:$condition->code, 
            "Temp" => $condition->temp, 
         ); 
      } 
       
      /* Get Units info */ 
      foreach($units as $unit){ 
         $resArray += array( 
            "TempUnit" => $unit->temperature, 
            "DistanceUnit" => $unit->distance, 
            "PressureUnit" => $unit->pressure, 
            "WindSpeedUnit" => $unit->speed 
         ); 
      }

       
      /* Get Location info */ 
      foreach($locations as $location){ 
         $resArray += array( 
            "City" => $location->city, 
            "Region" => $location->region, 
            "Country" => $location->country 
         ); 
      }

      /* Get Astronomy info */ 
      foreach($astros as $astro){ 
         $resArray += array( 
            "Sunrise" => $astro->sunrise, 
            "Sunset" => $astro->sunset 
         ); 
      }
      
      
      foreach($forecasts as $forecast){ 
         $resArray += array( 
            "Day" => $forecast->day, 
            "Low" => $forecast->low,
            "High" => $forecast->high
         ); 
      } 

       
       
      /* Get Atmosphere info */ 
      foreach($atmospheres as $atmosphere){ 
         $resArray += array( 
            "Humidity" => $atmosphere->humidity, 
            "HumidityText" => $atmosphere->humidity."%", 
            "Visibility" => round($atmosphere->visibility), 
            "VisibilityText" => round($atmosphere->visibility).$resArray["DistanceUnit"], 
            "Pressure" => round($atmosphere->pressure), 
            "PressureText" => round($atmosphere->pressure).$resArray["PressureUnit"],
            "Rising" => $atmosphere->rising, 
            "BarometerState" => $BarometerState[$atmosphere->rising] 
         ); 
      } 
       
       
       
      /* Get Wind info */ 
      foreach($winds as $wind){ 
         $resArray += array( 
            "WindChill" => $wind->chill, 
            "WindDirection" => $compassPoints[intval((($wind->direction/360)/32)+0.5)+1], 
            "WindSpeed" => intval($wind->speed), 
            "WindSpeedText" => intval($wind->speed).$resArray["WindSpeedUnit"] 
         ); 
      } 
      
       
      /* find out if it is day or night - use sunset and sunrise times */ 
      date_default_timezone_set('US/Central'); 
      $timeNow = strtotime(date("g:i a")); 
      $timeSet = strtotime($resArray["Sunset"]); 
      $timeRise = strtotime($resArray["Sunrise"]); 
      if (($timeNow>=$timeRise) && ($timeNow<$timeSet)){ 
         $isDayOrNight = "d";    
         $bgColor = "#069"; 
		 $bgDaytime = "day";      
	} else { 
         $isDayOrNight = "n"; 
         $bgColor = "#000";
		 $bgDaytime = "night";           
      } 
      $resArray += array("Today" => $isDayOrNight, "LocalTime" => date("g:ia"),"bgColor" => $bgColor);


      /* adjust image url output to include day or night pics */ 
      $ImageURL = "widgets/widget_Weather/images/".$resArray["ConditionCode"].$isDayOrNight.".png";
      $ImageURLSmall = "http://l.yimg.com/a/i/us/nws/weather/gr/".$resArray["ConditionCode"]."s.png"; 
      $resArray += array("ImageURL" => $ImageURL, "ImageURLSmall" => $ImageURLSmall);
       
      /* Output Results */ 
      $output->push(new ArrayData($resArray)); 
      return $output; 
       
   } catch(Exception $e) { 
         return false; 
   }       
}

/*------------------------- End Weather --------------------*/  	

	
}
