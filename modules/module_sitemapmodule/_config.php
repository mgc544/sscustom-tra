<?php

/*****************************************
	CONFIGURATION OPTIONS
*****************************************/

   /***********	
	* SITE MAP PAGE TITLE
	* Uncomment or add the following line to your 
	* _config.php to override the default Title 
	* for the site map page. Uses 'Site Map' by default.
	**********/

	//SiteMapModule::setTitle('Site Map');

   /***********	
	* SITE MAP URL
	* Uncomment or add the following line to your 
	* _config.php to override the default URL Segment 
	* for the site map. Uses 'site-map' by default.
	**********/

	//SiteMapModule::setURLSegment('site-map');

   /***********	
	* HIDE PAGE TYPES FROM THE SITE MAP
	* Uncomment or add the following line to your 
	* _config.php to override the default page types
	* that are skipped when rendering the site map.
	* 
	* Page classes must be listed in single quotes 
	* and separated by commas. List of page types 
	* must be contained within double quotes.
	**********/

//	SiteMapModule::skipPageTypes(" 'ErrorPage', 'OtherPage', 'OtherPage' ");

   /***********	
	* CHECK USER PERMISSIONS AND HIDE PAGES THE USER CAN'T VIEW
	* Uncomment or add the following line to your 
	* _config.php to do a permissions check to ensure
	* only pages the user is allowed to view are shown.
	**********/

//	SiteMapModule::setPermissionCheck(true);

   /***********	
	* SITE MAP THEME
	* Uncomment or add the following line to your 
	* _config.php to switch the theme from the default 
	* minimal theme to slickmap:
	**********/

//	SiteMapModule::setTheme('slickmap');
//	SiteMapModule::setTheme('default');


/*****************************************
	DO NOT EDIT
*****************************************/

Director::addRules(10, array(
	SiteMapModule::$siteMapURLSegment => 'SiteMapModule',
));

?>