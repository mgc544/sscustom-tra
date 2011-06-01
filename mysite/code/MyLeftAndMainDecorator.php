<?php
class MyLeftAndMainDecorator extends LeftAndMainDecorator {
   function init() {
      CMSMenu::remove_menu_item('Help');
	  CMSMenu::remove_menu_item('CommentAdmin');
   }
}