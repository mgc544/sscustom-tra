<?php

/* extends event_calendar module */
class SpecialsCalendar extends CalendarEvent
	static $dbase_add_record = array(
		'Category' => "Enum('Parts', 'Service', 'Sales')"
	);

	static has_one = array(
		'PDF' => 'File'
	);
	
	public function getCMSFields()
	{
	   $f = parent::getCMSFields();
	   $f->addFieldsToTab("Root.Content.Main", new DropdownField('Category','Worshop Category', singleton('Workshop')->dbObject('Category')->enumValues()), 'Content');
	   $f->addFieldToTab("Root.Content.Image", new ImageField('PDF'));
	 
	   return $f;
	}
} // end specials subclass