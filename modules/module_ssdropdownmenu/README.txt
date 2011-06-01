############################################### 
SSDROPDOWNMENU Module 0.1 
###############################################

Maintainer Contact
-----------------------------------------------
Antoine <antoine (at) doubleclique (dot) com>

Requirements
-----------------------------------------------
SilverStripe? 2.3. If it runs on < 2.3 please get in touch

Introduction
-----------------------------------------------
The menu is build automatically from the site tree (CMS) of your website.

The generated menu is based on

    * smoothmenu (JS + CSS) : http://www.dynamicdrive.com/dynamicindex1/ddsmoothmenu.htm
    * or purecssmenu (CSS) : http://purecssmenu.com/ 

Installation
-----------------------------------------------
Download and install the project to the root directory of your silverstripe project : myproject/ssdropdownmenu

Or (advanced users) create a svn:externals rule on the root directory of your project svn propset svn:externals http://ssdropdownmenu.googlecode.com/svn/trunk/ ssdropdownmenu
Documentation

To use the menu in a template (most of the time Page.ss), use simply :

    * $SmoothMenu
    * or $CssMenu
    * call with an argument (1) to add the admin menu links for login and access to the CMS at the end of your menu : $SmoothMenu(1) or $CssMenu(1) 

You can :

    * override the templates in the template's directory of your theme
    * override the css in the css's directory of your theme
    * generate new css easily for the css menu from : http://purecssmenu.com/ 