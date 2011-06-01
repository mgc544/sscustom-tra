<?php

class Brochure extends DataObject {
	
	static $db = array (
		'AttachmentDescription' => 'Text',	
	);
	
	static $has_one = array (
		'Product' => 'Product',
		'Attachment' => 'File'
	);
	
	function getCMSFields()
	{
		return new FieldSet(
			new TextField('AttachmentDescription'),
			new FileUploadField('Attachment')
		);	
	}			
}