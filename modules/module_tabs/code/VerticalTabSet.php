<?php

class VerticalTabSet extends HorizontalTabSet
{
				
	public function FieldHolder()
	{
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery-livequery/jquery.livequery.js");
		Requirements::javascript("modules/module_tabs/javascript/vertical_tabset.js");
		Requirements::css("modules/module_tabs/css/vertical_tabset.css");
		return $this->renderWith("VerticalTabSetFieldHolder");
	}
}
