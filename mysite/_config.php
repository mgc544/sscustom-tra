<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => '',
	"database" => 'ss_sandbox',
	"path" => '',
);

// Sites running on the following servers will be
// run in development mode. See
// http://doc.silverstripe.org/doku.php?id=configuration
// for a description of what dev mode does.
Director::set_dev_servers(array(
	'localhost',
	'127.0.0.1'
));

define('MY_SITE_DIR', 'mysite');

DataObject::add_extension('SiteConfig', 'CustomSiteConfig');

Director::set_environment_type("dev"); 

SSViewer::setOption('rewriteHashlinks', false);
			
MySQLDatabase::set_connection_charset('utf8');

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('LayoutX');

// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

//Set HTML Editor Config
HtmlEditorConfig::get('cms')->enablePlugins('preview'); // enables plugin

//Turns off legacy js validation
Validator::set_javascript_validation_handler('none');
PageCommentInterface::set_use_ajax_commenting(false);

//Add Drag/Drop re-ordering to data object manager
SortableDataObject::add_sortable_classes(array(
        'Product',
        'ProductCategory',
		'ProductModel',
		'StoreLocation',
		'Staff',
		'Department'
));

SiteMapModule::setTheme('default');

LeftAndMain::setApplicationName('ELS Site Manager');
LeftAndMain::set_loading_image('loading.gif');
LeftAndMain::setLogo('logo.gif', 'padding-left:0px');
Object::add_extension('LeftAndMain', 'MyLeftAndMainDecorator');

Object::add_extension('StoreLocation', 'Addressable');
Object::add_extension('StoreLocation', 'Geocodable');

GoogleLogger::activate('SiteConfig');
GoogleAnalyzer::activate('SiteConfig');

/* if adding froms through userforms module use this to enable captchas */
/*
SpamProtectorManager::set_spam_protector('RecaptchaProtector');
RecaptchaField::$public_api_key = 'xxx';
RecaptchaField::$private_api_key = 'xxx';
*/