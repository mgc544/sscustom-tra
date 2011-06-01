<?php 
/**
 * Class for representing a single point in a Google Map
 */
class StoreLocation extends DataObject {
	
    static $db = array(
        'Name' => 'Varchar(80)',
		'Address' => 'Varchar(80)',
		'City' => 'Varchar(80)',
		'State' => 'Varchar(80)',
		'Postcode' => 'Varchar(80)',
		'Phone' => 'Varchar(20)',
		'Fax' => 'Varchar(20)',
		'Toll' => 'Varchar(20)',
		'Email' => 'Text',
		'HoursMF' => 'Text',
		'HoursSat' => 'Text',
		'HoursSun' => 'Text',
        'Lat' => 'Float(10,6)',
        'Lng' => 'Float(10,6)',
    );

	static $has_one = array(
	'StoreLocatorPage' => 'StoreLocatorPage',
	'StorePhoto' => 'Image'

	);
	
	static $has_many = array(
		'Staffs' => 'Staff',
		'Departments' => 'Department',	
	
	);
	
	static $defaults = array(
	"HoursSun" => 'Closed',
	);

	

	
		function getCMSFields()
	{
			

			$staffmanager = new DataObjectManager(
				$this,
				'Staffs',
				'Staff',
				array('Name' => 'Name', 'Position' => 'Position', 'Phone' => 'Phone', 'Email' => 'Email')
			);
			
			$staffmanager->setPopupWidth(900);
			
			$departmentmanager = new DataObjectManager(
				$this,
				'Departments',
				'Department',
				array('DepartmentName' => 'Department Name')
			);
			
			$fields = new FieldSet(
			new HorizontalTabSet("Root",
			new Tab('Info',
				new TextField('Name', 'StoreID'),
				new TextField('Address', 'Address'),
				new TextField('City', 'City'),
				new TextField('State', 'State'),
				new TextField('Postcode', 'Postcode'),
				new LiteralField('Break', '<br/><h2>Store Hours</h2><br/><p>Please enter numeric time only.</p>'),

				new TextField('HoursMF', 'Enter Store Hours for Monday - Friday'),
				new TextField('HoursSat', 'Enter Store Hours for Saturday'),
				new TextField('HoursSun', 'Enter Store Hours for Sunday'),					
				new LiteralField('Break', '<br/><h2>Contact Details</h2><br/>'),
				new TextField('Phone', 'Phone'),
				new TextField('Fax', 'Fax'),
				new TextField('Toll', 'Toll Free Number'),
				new EmailField('Email', 'Primary Email'),
				new ImageField("StorePhoto", "Upload image below", null, null, null, "Uploads/Locations")

			),
			
			new Tab('Departments', $departmentmanager),			
			new Tab('Staff', $staffmanager)
						
			) /* end tab set */
		

		); /* end field set */
			
			return $fields; 
	}


    function toString() {
        return $this->getField("Lat").','.$this->getField("Lng");
    }
	
		//Return the Name as a menu title
	public function MenuTitle(){
		return $this->Name;
	}
	

	//Return the Name as a menu title
	public function Title(){
		return $this->Name;
	}
	
	public function Children(){
        return $this->Children;
    }
	
	public function Link()
	{
		if($StoreLocatorPage = $this->StoreLocatorPage())
		{
			return $StoreLocatorPage->Link('store/') . $this->ID;	
		}
	}

}

