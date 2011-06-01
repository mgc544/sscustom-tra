<?php

class LinksWidget extends Widget {
	static $db = array(
		"Links_23" => "Varchar",
		"Name1" => "Varchar",
		"Link1" => "Varchar",
		"Name2" => "Varchar",
		"Link2" => "Varchar",
		"Name3" => "Varchar",
		"Link3" => "Varchar",
		"Name4" => "Varchar",
		"Link4" => "Varchar"
		);
	
	
	static $title = "Links ";
	static $cmsTitle = "Links Widget";
	static $description = "Puts links into the side bar for you blog readers to access. Please remember to put http:// before links unless they are internal links.";


    function output() { 
	$link1 = $this->Link1;
	$test1 = $this->Link1;
	$name1 = $this->Name1;
	$link2 = $this->Link2;
	$test2 = $this->Link2;
	$name2 = $this->Name2;
	$link3 = $this->Link3;
	$test3 = $this->Link3;
	$name3 = $this->Name3;
	$link4 = $this->Link4;
	$test4 = $this->Link4;
	$name4 = $this->Name4;
	
   
	if (empty($test1)) {
	$output_1 = "";
	} else {
$output_1 = "<li><a href='$link1'>$name1</a><br></li>";
	}
	
	if (empty($test2)){
	$output_2 = "";
	}else{
$output_2 = "<li> <a href='$link2'>$name2</a><br></li>";
	}

	if (empty($test3)) {
	$output_3 = "";
	} else {
$output_3 = "<li><a href='$link3'>$name3</a><br></li>";
	}
	
	if (empty($test4)){
	$output_4 = "";
	}else{
$output_4 = "<li> <a href='$link4'>$name4</a><br></li>";
	}
	
	return "$output_1 $output_2 $output_3 $output_4";
	
		}
		
		function getCMSFields() {
		$links_choose = $this->Links_23;
           
		   return new FieldSet(
			new TextField("Name1", "Name "),
			new TextField("Link1", "Link "),
			new TextField("Name2", "Name "),
			new TextField("Link2", "Link "),
		    new TextField("Name3", "Name "),
			new TextField("Link3", "Link "),
		    new TextField("Name4", "Name "),
			new TextField("Link4", "Link "));

}}
