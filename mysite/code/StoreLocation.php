<?php 
/**
 * Class for representing a single point in a Google Map
 */
class StoreLocation extends DataObject {
	
    static $db = array(
        'Name' => 'Varchar(80)',
		'URLSegment' => 'Varchar(255)',
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
				new TextField('URLSegment', 'URLSegment'),
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
		return $this->City;
	}
	

	//Return the Name as a menu title
	public function Title(){
		return $this->Name;
	}
	
	function Link() {
        if($ProductHolder = $this->StoreLocatorPage()) {
			return $ProductHolder->absoluteLink().'store/'.$this->URLSegment;
		}
    }
	
	public function Children(){
        return $this->Children;
    }
	
	
	
	//Set URLSegment to be unique on write
    function onBeforeWrite()
    {       
        // If there is no URLSegment set, generate one from Title
        if((!$this->URLSegment || $this->URLSegment == 'new-location') && $this->City != 'New Location') 
        {
            $this->URLSegment = SiteTree::generateURLSegment($this->City);
        } 
        else if($this->isChanged('URLSegment')) 
        {
            // Make sure the URLSegment is valid for use in a URL
            $segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
            $segment = preg_replace('/-+/','-',$segment);
              
            // If after sanitising there is no URLSegment, give it a reasonable default
            if(!$segment) {
                $segment = "location-$this->ID";
            }
            $this->URLSegment = $segment;
        }
  
        // Ensure that this object has a non-conflicting URLSegment value.
        $count = 2;
        while($this->LookForExistingURLSegment($this->URLSegment)) 
        {
            $this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment) . '-' . $count;
            $count++;
        }
  
        parent::onBeforeWrite();
    }
          
    //Test whether the URLSegment exists already on another Location
    function LookForExistingURLSegment($URLSegment)
    {
        return (DataObject::get_one('StoreLocation', "URLSegment = '" . $URLSegment ."' AND ID != " . $this->ID));
    }
	
}
