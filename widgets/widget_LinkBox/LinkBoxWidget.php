<?php
 
class LinkBoxWidget extends Widget {
	static $db = array(
		'WidgetTitle' => 'Varchar(255)',
		'Content' => 'HTMLText',
		'LinkPage' => 'Text',
		'ButtonText' => 'Text',

	);
	
	static $has_one = array(
	  'LinkImage' => 'Image',
	  'LinkToSiteTree' => 'SiteTree',
	);
 
	static $title = 'Info';
	static $cmsTitle = 'Link Box';
	static $description = 'Adds a promo link box.';
	
	function Title() {
		return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
	}
	
	function output() {
		return $this->Content;
	}
 
	function getCMSFields() {
		$records = DataObject::get('SiteTree', "Status IN ('Published','Saved (update)')", 'Title ASC');

		//add each page title into a dropdown menu along with it's page ID
		$dropDownArray = array();
		if($records->exists()) foreach( $records as $record ) {
			$dropDownArray[$record->ID] = $record->Title;
		}

		return new FieldSet(
			new TextField('WidgetTitle', _t('TITLE', 'Title (optional)')),
			new TextareaField('Content', _t('CONTENT', 'Content')),
			new DropdownField(
				   $name = "LinkToSiteTreeID",
				   $title = "Page to display content from:",
				   $source = $dropDownArray
				),
			new TextField("LinkPage", "Manual page (start with 'http://' to link to an external site or link will be relative within current site)"),
			new WidgetImageField("LinkImageID","Image to display (from assest uploaded to 'widgets' folder)"),
			new TextField('ButtonText', 'Button Text')
		);
	}
	
	function LinkToPage() {
		$strURL = '';
		if (!empty($this->LinkPage)) {
			$strURL = $this->LinkPage;
			if (!strpos($strURL, 'http') === 0) {
				$strURL = $this->BaseHref().$strURL;
			}
		}
		else {
			if (isset($this->LinkToSiteTreeID) && is_numeric($this->LinkToSiteTreeID)) {
				$page = DataObject::get_by_id('SiteTree',$this->LinkToSiteTreeID);
				if ($page) {
					$strURL = $this->BaseHref().$page->RelativeLink();
				}
			}
		}

		return $strURL;
	}
	
	function LinkImageTag() {
		if (isset($this->LinkImageID) && is_numeric($this->LinkImageID)) {
			return DataObject::get_by_id('Image',$this->LinkImageID);
		}
		return null;
	}
}
 
?>
