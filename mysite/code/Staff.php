<?php

class Staff extends DataObject {
	
	static $db = array (
		'Name' => 'Text',
		'Position' => 'Text',
		'Phone' => 'Text',
		'Email' => 'Text',
	);
	
	static $has_one = array (
		'Department' => 'Department',
		'StoreLocation' => 'StoreLocation',
		 'StaffPhoto' => 'Image'
	);
	
	function getCMSFields()
	{
		$dep_map = array();
		if($departments = DataObject::get("Department", "StoreLocationID='{$this->StoreLocationID}'")) {
			$dep_map = $departments->map("ID", "DepartmentName");
		}
		
		$fields = new FieldSet( 
			new TextField('Name'),
			new TextField('Position'),
			new TextField('Phone'),
			new TextField('Email'),
			new DropdownField(
				'DepartmentID',
				'DepartmentName', 
				$dep_map
			),
			new ImageField("StaffPhoto", "Upload image below", null, null, null, "Uploads/Locations/Staff")


			
			); /* end field set */
		
		return $fields; 
	
	}			
}
