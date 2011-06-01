<?php
 
class CustomSiteConfig extends DataObjectDecorator {
 
function extraStatics() {
return array(
'db' => array(
	'Copyright' => 'Text',
	'MasterControl' => 'Text',
),
'has_one' => array(
	'SiteLogo' => 'Image',
	'RightSidebar' => 'WidgetAreaCustom',
	'LeftSidebar' => 'WidgetAreaCustom'
)
);
}
 
public function updateCMSFields(FieldSet &$fields) {
 
		$fields->addFieldToTab("Root.Main", new ImageField("SiteLogo", "Logo"));
		$fields->addFieldToTab("Root.Main", new TextField("MasterControl", "Master Control"));
		$fields->addFieldToTab("Root.Main", new TextField("Copyright", "Copyright"));
		$fields->addFieldToTab("Root.Left Sidebar", new WidgetAreaEditorExtended('LeftSidebar', 'Left Sidebar Content'));	   
		$fields->addFieldToTab("Root.Right Sidebar", new WidgetAreaEditorExtended('RightSidebar', 'Right Sidebar Content'));	   
}
 
}
?>