<?php

class SearchFrom extends Form { 
   
   function init() { 
      parent::init(); 
   } 
   
   function FormAction() { 
      return 'http://www.equipmentlocator.com/remarket/dealers/defaultsearchresults.aspx'; 
   } 
   
   
   // This is what gets put your form line in Form.ss <form $FormAttributes> 
	public function FormAttributes() { 
	$attr = parent::FormAttributes(); 
	// Do your manipulations 
	$attr .= 'target="_blank"';
	return $attr; 
	} 
}
