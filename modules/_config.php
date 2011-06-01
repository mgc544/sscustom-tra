<?php

/**
 addthis widget config
 @var string The addThis username (set to ' xa-4ca496846544579c ' if you dont have a username)
*/
//define('ADDTHISUSERNAME','aetchell');
define('ADDTHISUSERNAME','xa-4ca496846544579c');
define('ADDTHISTITLE','Social');


if(isset($_POST['PHPSESSID'])) {
	Session::start($_POST['PHPSESSID']);
}


/*** @package newsletter ***/

define('NEWSLETTER_DIR', 'modules/module_newsletter');

Director::addRules(50, array(
	'newsletterlinks/$Hash' => "TrackLinkController",
	'unsubscribe//$Action/$AutoLoginHash/$MailingList' => 'UnsubscribeController'
));

Object::add_extension('NewsletterEmail', 'TrackingLinksEmail');
DataObject::add_extension('Member', 'NewsletterRole');

HtmlEditorConfig::get('cms')->setOptions(array(
	'friendly_name' => 'Default CMS',
	'priority' => '50',
	'mode' => 'none',
	'language' => i18n::get_tinymce_lang(),
	'content_css' => 'cms/css/editor.css, '.(SSViewer::current_theme() ? THEMES_DIR . "/" . SSViewer::current_theme() : project()) . "/css/editor.css",

	'body_class' => 'typography',
	'document_base_url' => Director::absoluteBaseURL(),

	'urlconverter_callback' => "nullConverter",
	'setupcontent_callback' => "sapphiremce_setupcontent",
	'cleanup_callback' => "sapphiremce_cleanup",

	'template_templates' => array(
    	array( 'title' => "Three column", 'src' => "assets/snippet.html", 'description' => "A simple 3 column layout" )
	),

	'use_native_selects' => true, // fancy selects are bug as of SS 2.3.0
	'valid_elements' => "+a[id|rel|rev|dir|tabindex|accesskey|type|name|href|target|title|class],-strong/-b[class],-em/-i[class],-strike[class],-u[class],#p[id|dir|class|align|style],-ol[class],-ul[class],-li[class],br,img[id|dir|longdesc|usemap|class|src|border|alt=|title|width|height|align],-sub[class],-sup[class],-blockquote[dir|class],-table[border=0|cellspacing|cellpadding|width|height|class|align|summary|dir|id|style],-tr[id|dir|class|rowspan|width|height|align|valign|bgcolor|background|bordercolor|style],tbody[id|class|style],thead[id|class|style],tfoot[id|class|style],-td[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],-th[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],caption[id|dir|class],-div[id|dir|class|align|style],-span[class|align|style],-pre[class|align],address[class|align],-h1[id|dir|class|align|style],-h2[id|dir|class|align|style],-h3[id|dir|class|align|style],-h4[id|dir|class|align|style],-h5[id|dir|class|align|style],-h6[id|dir|class|align|style],hr[class],dd[id|class|title|dir],dl[id|class|title|dir],dt[id|class|title|dir]",
	'extended_valid_elements' => "img[style|class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap],iframe[src|name|width|height|align|frameborder|marginwidth|marginheight|scrolling],object[width|height|data|type],param[name|value],map[class|name|id],area[shape|coords|href|target|alt]"
));

HtmlEditorConfig::get('cms')->disablePlugins('blockquote');
HtmlEditorConfig::get('cms')->enablePlugins('media', '../../tinymce_ssbuttons', 'fullscreen');
			
HtmlEditorConfig::get('cms')->insertButtonsBefore('formatselect', 'styleselect');
HtmlEditorConfig::get('cms')->insertButtonsBefore('advcode', 'ssimage', 'ssflash', 'sslink', 'unlink', 'anchor', 'separator' );
HtmlEditorConfig::get('cms')->insertButtonsAfter ('advcode', 'fullscreen', 'separator');
			
HtmlEditorConfig::get('cms')->removeButtons('tablecontrols');
HtmlEditorConfig::get('cms')->addButtonsToLine(3, 'tablecontrols');



SiteMapModule::setTitle('Site Map');

SiteMapModule::setURLSegment('site-map');

/*****************************************
	DO NOT EDIT
*****************************************/

Director::addRules(10, array(
	SiteMapModule::$siteMapURLSegment => 'SiteMapModule',
));


/*** ssdropdownmenu options don't edit ***/
define('ssdropdownmenu', 'modules/module_ssdropdownmenu');

Object::add_extension('ContentController' , 'DropDownMenuExtension');
Object::add_extension('DataObject' , 'DropDownMenuExtension');


/*** Rotator config ***/

define('ROTATOR_DIR', 'modules/module_rotator');
Object::add_extension('ContentController', 'RotatorItemDecorator'); 
Object::add_extension('DataObject' , 'RotatorItemDecorator')

// adds a rule to make www.site.com/sitemap.xml work
Director::addRules(10, array(
	'sitemap.xml' => 'GoogleSitemap',
));

// add the extension 
Object::add_extension('SiteTree', 'GoogleSitemapDecorator');

?>