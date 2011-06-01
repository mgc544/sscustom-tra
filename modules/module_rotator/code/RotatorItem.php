<?php
 
class RotatorItem extends DataObject{

    static $db = array(
        'Name' => 'Varchar(255)',
        'LinkTo' => 'Varchar(255)',
        'Categories' => 'varchar',
        'Featured' => 'Boolean'
    );
    
    static $defaults = array(   
        'Name' => 'Title',
        'LinkTo' => 'Link'
    );
    
    static $has_one = array(
        'Image' => 'Image',
        'PDF' => 'File',
        "LinkedPage" => "SiteTree"
    );
    
    static $summary_fields = array(
        'Name' => 'Title',
        'LinkTo' => 'LinkedTo',
        'Categories' => 'Category',
        'Featured' => 'Featured'

    );
    
    
    static $casting = array(
		"Link" => "Varchar"
	);
    
    
    static $searchable_fields = array (
        'Name',
        'LinkTo'
    );
    
    
    function getLink() {
		$link = '';
		if($this->LinkTo) {
			$link = $this->LinkTo;

		}
		elseif($this->LinkedPageID) {
			if($this->LinkedPage()) {
				$link = $this->LinkedPage()->Link();
			}
		}
		return $link;
	}
    
    function Link() {
		return $this->getLink();
	}
    
    function getCMSFields() 
    {
        $fields = parent::getCMSFields();
 
        //Main Tab
        $fields->addFieldToTab("Root.Main", new TextField('Name', 'Title'));    
        $fields->addFieldToTab("Root.Main", new ImageField('Image', 'Insert the display image for the rotator', Null, Null, Null, 'Uploads/ads'));

		$fields->addFieldToTab("Root.OptionalLink", new TextField($name = "LinkTo", "Link to external site (e.g. http://www.site.com) - this will override an internal link"));
		$fields->addFieldToTab("Root.OptionalLink", new TreeDropdownField($name = "LinkedPageID", "Link to a page on this website", $sourceObject = "SiteTree"));
     	$fields->addFieldToTab("Root.OptionalLink", new FileIFrameField('PDF', 'Link to a PDF -Overrides the settings above', Null, Null, Null, 'Uploads/ads'));


 
	    $Categories = array(
 	 	'Parts' => 'Parts',
 	 	'Service' => 'Service',
 	 	'Sales' => 'Sales'
	   );
	   
	   
	   
        $fields->addFieldToTab("Root.Categories", new CheckboxsetField('Categories', 'Categories', $Categories));
        $fields->addFieldToTab("Root.Categories", new CheckboxField('Featured', 'Feature this item on the home patge?'));
        

        return $fields;
    }
    
    

}