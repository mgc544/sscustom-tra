<?php
class NewsletterWidget extends Widget {
	static $db = array(
		"Title" => "Text"
		);
	
	static $has_one = array();
	
	
	static $cmsTitle = 'Newsletter Widget';
	static $description = "gets the latest newsletters and adds signup button";
	
		
	
	function getCMSFields()
	{
		$fields = new FieldSet(); 
			$fields->push(new TextField("Title", "Custom title for the widget"));
			
	        		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;

	}
	
	function Title() {
		return ($this->Title) ? $this->Title : 'Newsletter Signup!';
	}
	
	
		/*********************************************
		These functions are for the newsletter modules
		/***********************************************/
		function ShowForm(){
			Requirements::javascript(NEWSLETTER_DIR . '/thirdparty/jquery-validate/jquery.validate.min.js');

			$get = DataObject::get_one('SubscriptionPage', "URLSegment = 'newsletter-signup'");
			return new SubscriptionPage_Controller($get);
		}
		
		//Shows the newsletters on the site
		function getNewsletters() {	
		return DataObject::get( 'NewsletterType');
		}
		
		//Sets the preview link for the newsletter
		function PreviewLink(){
		return "newsletter-signup/preview/".$this->ID;
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
		}

	
}