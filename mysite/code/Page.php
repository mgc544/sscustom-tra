<?php

class Page extends SiteTree {
	
	public static $db = array(
	'SEO' => 'Text',
	'PageLayout' => 'varchar',
	'ShowInheritRightSideBar' => 'Boolean',
	'ShowInheritLeftSideBar' => 'Boolean',
	);
	
	public static $has_one = array(
	'Photo' => 'Image',
	'RightSidebar' => 'WidgetAreaCustom',
	'LeftSidebar' => 'WidgetAreaCustom'
	);
	
	static $defaults = array(
	"PageLayout" => 0,
	"ShowInheritRightSideBar" => 1,
	"ShowInheritLeftSideBar" => 1
	);

	
	function getCMSFields() {
	$fields = parent::getCMSFields();
	   
	    $layoutoptions = array(
 	 	'0' => 'Include Full Page Width',
 	 	'1' => 'Include Left Sidebar',
 	 	'2' => 'Include Right Sidebar',
 	 	'3' => 'Include Left and Right Sidebars' 
	   );
	   $fields->addFieldToTab("Root.Behaviour", new OptionsetField("PageLayout", "Please select one option", $layoutoptions));
	   $fields->addFieldToTab('Root.Behaviour', new CheckboxField("ShowInheritRightSideBar", "Inherit widgets from right sidebar on this page?"));
	   $fields->addFieldToTab('Root.Behaviour', new CheckboxField("ShowInheritLeftSideBar", "Inherit widgets from left sidebar on this page?"));

	
	    if ($this->PageLayout == 1) {	
		$fields->addFieldToTab("Root.Content.Left Sidebar", new WidgetAreaEditorExtended('LeftSidebar', 'Left Sidebar Content'));	   
		}
		
		if ($this->PageLayout == 2) {	
		$fields->addFieldToTab("Root.Content.Right Sidebar", new WidgetAreaEditorExtended("RightSidebar"));		
		}
		
		if ($this->PageLayout == 3) {	
		$fields->addFieldToTab("Root.Content.Left Sidebar", new WidgetAreaEditorExtended('LeftSidebar', 'Left Sidebar Content'));
		$fields->addFieldToTab("Root.Content.Right Sidebar", new WidgetAreaEditorExtended("RightSidebar"));
		}

	   $fields->addFieldToTab('Root.Behaviour', new ImageField('Photo', 'Add a thumbnail image for this page'));
	   $fields->addFieldToTab('Root.Content.Main', new TextareaField('SEO'), 'Content');

		return $fields;
	}
	
	
}


 class Page_Controller extends ContentController {
 
		public function init() {
			parent::init();
	
			$combinepath = MY_SITE_DIR .'/combined';
			Requirements::set_combined_files_folder($combinepath);
			
			$css = array();
			$css [] = MY_SITE_DIR ."/css/layout.css";
			$css [] = MY_SITE_DIR ."/css/text.css";
			$css [] = MY_SITE_DIR ."/css/form.css";
			
			$js = array();
			$js[] =  THIRDPARTY_DIR ."/jquery/jquery-packed.js";
			
			
			foreach($css as $c){ 
				Requirements::css($c);
			}	
	
			foreach($js as $j){ 
				Requirements::javascript($j);
			}
			
			if(Director::isLive()){ 
				Requirements::combine_files('combined.css',$css); 
				Requirements::combine_files('combined.js',$js);  
				Requirements::process_combined_files();
			} 
	
			//compress the styles on flush :)
			if(isset($this->request) && $this->request->getVar('flush') == 'all'){
				if(file_exists(Director::baseFolder() . '/' .$combinepath.'/combined.css')){
					$bf = file_get_contents(Director::baseFolder() . '/' .$combinepath.'/combined.css');
					$bf = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $bf);
					$bf = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $bf);
					$fh = fopen(Director::baseFolder() . '/' .$combinepath.'/combined.css', 'w');
					fwrite($fh, $bf);
					fclose($fh);
				}
			}
			
		}
		
		
		/***********************************
		Sets the widget areas for the sidebars
		/*************************************/
		
		//Sets the inheritance for the right sidebar
		function InheritRightSidebar() 
		{ 
			if ($this->ShowInheritRightSideBar == 1) 
			{ 
			$output = new DataObjectSet();
				$Globalwidgets = $this->owner->SiteConfig->RightSidebar();
				$Pagewidgets = $this->RightSidebar();
			
			$output->push(new ArrayData(array(
				'Global' => $Globalwidgets,
				'Page' => $Pagewidgets
			)));
			
			return $output ; 
			} 
			else {
				return $this->RightSidebar();
			}
		}
		
		//Sets the inheritance for the left sidebar
		function InheritLeftSidebar() 
		{ 
			if ($this->ShowInheritLeftSideBar == 1) 
			{ 
				$output = new DataObjectSet();
				$Globalwidgets = $this->owner->SiteConfig->LeftSidebar();
				$Pagewidgets = $this->LeftSidebar();
			
				$output->push(new ArrayData(array(
				'Global' => $Globalwidgets,
				'Page' => $Pagewidgets
				)));
			
				return $output ; 
			} 
			else {
				
				return $this->LeftSidebar();
			}
		}

		
		//Show the Latest Brands on the Home Page
		public function getBrands ($num=3) 	{
		return DataObject::get('Brand', '', 'RAND()', '', (int)$num); 		
		}

		
		/*********************************************
		These functions are for the newsletter modules
		/***********************************************/
		
		
		//Shows the newsletters on the site
		/*function getNewsletters() {	
		return DataObject::get( 'NewsletterType');
		}
		
		//Sets the preview link for the newsletter
		function PreviewLink(){
		return Controller::curr()->AbsoluteLink()."preview/".$this->ID;
		}
		

		//Sets the preview link for the newsletter
		public function preview($request) {
		$newsletterID = (int) $request->param('ID');
		$obj = DataObject::get_by_id('Newsletter', $newsletterID);
		$templateName = ($obj && ($obj->Parent()->Template)) ? $obj->Parent()->Template : 'GenericEmail';

		// Block stylesheets and JS that are not required (email templates should have inline CSS/JS)
		Requirements::clear();

		// Set template specific variables before passing it to the template
		$obj->Body = $obj->Content;
		
		$obj->Body = str_replace('src="assets','src="'.Director::baseURL().'assets',$obj->Body);

		return $this->customise($obj)->renderWith($templateName);
		}*/
		
		
		
		/*********************************************
		Functions for showing listings feed on page
		/***********************************************/

		//Show vertical scrolling list
		function ListingsFeedV() {
			$mastercontrol = $this->owner->SiteConfig->MasterControl;
			$widget = new ListingsWidget();
			$widget->RssUrl = "http://www.equipmentlocator.com/ELSRSS/dealer.aspx?mc=$mastercontrol&lang=na-en&ind=ag&image=1";
			$widget->RSSTitle = "Latest Listings";
			$widget->Orientation = "V";
			return $widget->renderWith("WidgetHolder");
		}
		
		//Show horizontal scrolling list
		function ListingsFeedH() {
			$mastercontrol = $this->owner->SiteConfig->MasterControl;
			$widget = new ListingsWidget();
			$widget->RssUrl = "http://www.equipmentlocator.com/ELSRSS/dealer.aspx?mc=$mastercontrol&lang=na-en&ind=ag&image=1";
			$widget->RSSTitle = "Latest Listings";
			$widget->Orientation = "H";
			return $widget->renderWith("WidgetHolder");
		}
		
		//Show mobile scrolling list
		function ListingsFeedMobileHome() {
			$mastercontrol = $this->owner->SiteConfig->MasterControl;
			$widget = new ListingsWidget();
			$widget->RssUrl = "http://www.equipmentlocator.com/ELSRSS/dealer.aspx?mc=$mastercontrol&lang=na-en&ind=ag&image=1";
			return $widget->renderWith("MobileList");
		}
		
		
		//Equipment Search
		function EquipmentSearch() {
        
        $mastercontrol = $this->owner->SiteConfig->MasterControl;
        // Create fields          
        $fields = new FieldSet(
            new HiddenField (
			   $name = "master",
			   $title = "title",
			   $value = "$mastercontrol"
			),
			new HiddenField (
			   $name = "winx",
			   $title = "title",
			   $value = "1"
			),
			new HiddenField (
			   $name = "bgnd",
			   $title = "title",
			   $value = "#2b2b2b"
			),
			
			new HiddenField (
			   $name = "textcolor",
			   $title = "title",
			   $value = "#ffffff"
			),
			
			new HiddenField (
			   $name = "linkcolor",
			   $title = "title",
			   $value = "#ffffff"
			),
			new HiddenField (
			   $name = "url",
			   $title = "title",
			   $value = "www.ustractor.com"
			),
            new TextField (
           		$name = "random",
			   $title = "Equipment Search",
			   $value = "Make, Model or Serial No."
            
            )
        );
		        
        // Create action
        $actions = new FieldSet(
            new FormAction('Submit', 'Search')
        );
         
        
         return new SearchFrom($this, 'EquipmentSearch', $fields, $actions);
        //return new Form($this, 'EquipmentSearch', $fields, $actions);
    	}    	
	
} /* end controller class */