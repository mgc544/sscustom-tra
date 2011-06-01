<?php

class DropDownMenuExtension extends Extension {
  function extraStatics() {
    return array(
    );
  }

  public function Subject() {
    return $this->owner;
  }

  /**
   * Render a template
   * @param $template template_file
   * @return html render
   */
  public function Template($template) {
    return $this->owner->renderWith($template);
  }

  /**
   * Render a smoothmenu
   * @param $add_admin if true add the admin link
   * @return html render
   */
  function SmoothMenu( $add_admin = false ) {
    
  //    Use this css for vertical menu
  //    $this->includeCss('ddsmoothmenu-v.css')
    $this->includeCss('ddsmoothmenu.css');

    Requirements::javascript(ssdropdownmenu . '/javascript/ddsmoothmenu.js');

    $ssdropdownmenu_path = ssdropdownmenu;
    //see http://www.dynamicdrive.com/dynamicindex1/ddsmoothmenu.htm for more options
    Requirements::customScript(<<<JS
        ddsmoothmenu.arrowimages = {down:['downarrowclass', '/$ssdropdownmenu_path/images/down.gif', 23], right:['rightarrowclass', '/$ssdropdownmenu_path/images/right.gif']};
        
        ddsmoothmenu.init({
               mainmenuid: "smoothmenu",
               orientation: 'h',
               classname: 'ddsmoothmenu',
               contentsource: "markup"
              })
JS
    );

    return $this->owner->renderWith('MenuSmooth', array( 'AddAdminMenu' => $add_admin ));
  }

   /**
   * Render a css menu
   * @param $add_admin if true add the admin link
   * @return html render
   */
  public function CssMenu( $add_admin = false ) {
    
    $this->includeCss('cssmenu.css');

    return $this->owner->renderWith('MenuCss', array( 'AddAdminMenu' => $add_admin ));
  }
  
  /**
   * include a css, check first in the the theme, then project or ele in the module
   * @param $css
   */
  private function includeCss( $css ) {
    if( Director::fileExists($file = project() . '/themes/' . SSViewer::current_theme() . '/css/' . $css) ) {
      Requirements::css($file);

    }
    elseif( Director::fileExists($file = project() . '/css/' . $css) ) {
      Requirements::css($file);
    }
    else {
      Requirements::css(ssdropdownmenu . '/css/' . $css);
    }
  }
}