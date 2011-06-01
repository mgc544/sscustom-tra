<?php

class Department extends DataObject {
	
	static $db = array (
		'DepartmentName' => 'Text'
	);
	
	static $has_one = array (
		'StoreLocation' => 'StoreLocation',
	);
	
	static $has_many = array(
		'Staffs' => 'Staff',	
	);	

	
	function getCMSFields()
	{
		return new FieldSet(
			new TextField('DepartmentName')
		);	
	}
	
}