<?php

class SiteMapModule extends Page_Controller {

	/**
	 * The default title for the Site map page. This can be updated in the config using
	 * SiteMapModule::setTitle('Title');
	 * @param sring $siteMapTitle
	*/
	public static $siteMapTitle = 'Site Map';

	/**
	 * The default URLSegment for the Site map page. This can be updated in the config.
	 * SiteMapModule::setURLSegment('URLSegment');
	 * @param sring $siteMapURLSegment
	*/
	public static $siteMapURLSegment = 'site-map';

	/**
	 * The site map theme. This can be updated in the config.
	 * SiteMapModule::setTheme('default');
	 * SiteMapModule::setTheme('slickmap');
	 * @param sring $siteMapTheme
	*/
	public static $siteMapTheme = 'default';

	/**
	 * Page types to ignore from the Site Tree.
	 * SiteMapModule::skipPageTypes(" 'ErrorPage', 'OtherPage', 'OtherPage' ");
	 * @param sring $siteMapSkipPageTypes
	*/
	public static $siteMapSkipPageTypes = "'ErrorPage'";

	/**
	 * Do you want to hide pages from users who don't have permission to view the page?
	 * SiteMapModule::setPermissionCheck(true);
	 * @param sring $siteMapPermissionCheck
	*/
	public static $siteMapPermissionCheck = true;

	/**
	 * Used to override the default Title for the site map
	 * Set with SiteMapModule::setTitle();
	 * @param string $newTitle
	 */
	public static function setTitle($newTitle) {
		if($newTitle == 'none' || $newTitle == "") {
			user_error("SiteMapModule::setTitle() passed bad title '$newTitle'", E_USER_WARNING);
		} else {
			self::$siteMapTitle = $newTitle;
		}
	}

	/**
	 * Used to override the default URLSegment for the site map
	 * Set with SiteMapModule::setURLSegment();
	 * @param string $newURLSegment
	 */
	public static function setURLSegment($newURLSegment) {
		if($newURLSegment == 'none' || $newURLSegment == "") {
			user_error("SiteMapModule::setURLSegment() passed bad title '$newURLSegment'", E_USER_WARNING);
		} else {
			self::$siteMapURLSegment = $newURLSegment;
		}
	}

	/**
	 * Used to override the default theme for the site map
	 * Set with SiteMapModule::setTheme();
	 * @param string $newTheme
	 */
	public static function setTheme($newTheme) {
		if($newTheme == 'none' || $newTheme == "") {
			user_error("SiteMapModule::setTheme() passed bad theme '$newTheme'", E_USER_WARNING);
		} else {
			self::$siteMapTheme = $newTheme;
		}
	}

	/**
	 * Used to hide certain page types from the site map.
	 * Set with SiteMapModule::skipPageTypes();
	 * @param string $NewSkipPageTypes
	 */
	public static function skipPageTypes($NewSkipPageTypes) {
		if($NewSkipPageTypes == "") {
			user_error("SiteMapModule::skipPageTypes() passed bad pages to be skipped '$NewSkipPageTypes'", E_USER_WARNING);
		} else {
			self::$siteMapSkipPageTypes = $NewSkipPageTypes;
		}
	}

	/**
	 * Set whether pages that a user does not have permission to view should be hidden from the site map.
	 * Set with SiteMapModule::setPermissionCheck();
	 * @param string $newPermissionCheck
	 */
	public static function setPermissionCheck($newPermissionCheck) {
		if($newPermissionCheck != true && $newPermissionCheck != false ) {
			user_error("SiteMapModule::setPermissionCheck() passed bad option '$newPermissionCheck'. Must be true/false.", E_USER_WARNING);
		} else {
			self::$siteMapPermissionCheck = $newPermissionCheck;
		}
	}

	function init() {
		Requirements::javascript("modules/module_sitemapmodule/javascript/sitemap-".self::$siteMapTheme.".js");
		Requirements::css("modules/module_sitemapmodule/css/sitemap-".self::$siteMapTheme.".css");
		parent::init();
	}

	/**
	 * This function will return a unordered list of pages at the root level only.
	 */
	function Content() {
		$rootLevel = DataObject::get("Page", "ParentID = 0 AND ClassName NOT IN(".self::$siteMapSkipPageTypes.")");
		$output = "";
		$output = $this->makeList($rootLevel);
		return $output;
	}
 
	/**
	 * Returns the Title for the page.
	 * @param string $siteMapTitle. 
	*/
 	function Title() {
 		return self::$siteMapTitle;
 	}
 
	private function makeList($pages) {
		$output = "";
		if(count($pages)) {
			
			/* get number of columns for slickmap */
			$totalItems = $pages->Count();
			if (($totalItems - 1) < 11 ) { /* remove home page from count */
				$slickmapWidth = "col".($totalItems - 1);
			} else { $slickmapWidth = "col10"; }

			$output = '
			<ul id="sitemap" class="'.$slickmapWidth.'">';
			foreach($pages as $page) {
			
				/* if selected, check if user has permission to view page and skip rendering it if they don't have permission. */
				if (self::$siteMapPermissionCheck) {
					if (!$page->canView()) {
						continue;
					}
				}
					
				/* add id for slickmap */
				if ($page->URLSegment == 'home') {
					$slickmapHomeID = "id='home' ";
				} else { $slickmapHomeID = null; }

				$output .= '
				<li '.$slickmapHomeID.'><a href="'.$page->Link().'" title="Go to the '.Convert::raw2xml($page->Title).' page">'.Convert::raw2xml($page->MenuTitle).'</a>';
				$whereStatement = "ParentID = ".$page->ID." AND ClassName NOT IN(".self::$siteMapSkipPageTypes.")";
				$childPages = DataObject::get("Page", $whereStatement);
				$output .= $this->makeChildList($childPages);
				$output .= '</li>';
			}
			$output .= '
			</ul>
		';
		}
		return $output;
	}

	private function makeChildList($pages) {
		$output = "";
		if(count($pages)) {
				$output = '
					<ul>';
			foreach($pages as $page) {

				/* if selected, check if user has permission to view page and skip rendering it if they don't have permission. */
				if (self::$siteMapPermissionCheck) {
					if (!$page->canView()) {
						continue;
					}
				}
					
				$output .= '
						<li><a href="'.$page->Link().'" title="Go to the '.Convert::raw2xml($page->Title).' page">'.Convert::raw2xml($page->MenuTitle).'</a>';
				$whereStatement = "ParentID = ".$page->ID." AND ClassName NOT IN(".self::$siteMapSkipPageTypes.")";
				$childPages = DataObject::get("Page", $whereStatement);
				if($childPages) {
					$output .= $this->makeChildList($childPages);
				}
				$output .= '</li>';
			}
			$output .= '
					</ul>
				';
		}
		return $output;
	}

}