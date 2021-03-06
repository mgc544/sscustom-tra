<?php
/**
 * CustomMenuAdmin creates an admin area that allows developers to
 * create/edit/delete custom menu's for their site. These menu's can then be
 * accessed via the Control CustomMenu(Slug)
 * 
 */

class CustomMenuAdmin extends LeftAndMain {
    static $url_segment = 'menus';
    static $menu_title = 'Menus';
    static $menu_priority = 30;
    static $url_priority = 41;
    static $url_rule = '/$Action/$ID/$OtherID';
    static $tree_class = "CustomMenuHolder";
	
    public function init() {
        parent::init();
        Requirements::javascript('modules/module_custommenus/js/CustomMenu_right.js');
        Requirements::css('modules/module_custommenus/css/CustomMenu.css');
    }

    /**
    * Basic action to display a blank pannel when the root node is selected
    * from the left sitetree.
    *
    * @return <type> false
    */
    public function root() {
        return false;
    }

    /**
    * get_menus retrieves all CustomMenuHolder objects from the database,
    * which will be rendered in the left pain by the template.
    *
    * @return DataObjectSet
    */
    public function get_menus() {
        $result = DataObject::get('CustomMenuHolder');
        return $result;
    }

    /**
    * Generate the editform, only if there is a URL ID available
    * @see cms/code/LeftAndMain#getEditForm($id)
    */
    function getEditForm($id = null) {
        if(!$id)
            $id = $this->urlParams['ID'];

        if($id) {
            // Create form fields
            $fields = new FieldSet(
                new TabSet('Root',
                new Tab(
                    _t('CustomMenus.FormMain','Main'),
                    new HiddenField('ID','id #',$id),
                    new HeaderField('MenuHeading',_t('CustomMenus.FormMainHeader','Edit Menu')),
                    new TextField('Title', _t('CustomMenus.FormMainTitle','Menu Title')),
                    new TextField('Slug', _t('CustomMenus.FormMainSlug','Menu Slug (used in your control call)'))
                ), new Tab(_t('CustomMenus.FormPages','Pages'),
                    new CustomMenuField('Pages',_t('CustomMenus.FormPagesPages','Pages in menu'))
                ), new Tab(_t('CustomMenus.FormOrder','Order'),
                    new CustomMenuOrderField('OrderList',_t('CustomMenus.FormOrderOrderList','This is how your menu is currently ordered')),
                    new TextField('Order',_t('CustomMenus.FormOrderOrder','Customise this order (list of page IDs, seperated by a comma)'))
                )
                )
            );

            $actions = new FieldSet(
                new FormAction('doDeleteMenu', _t('CustomMenus.FormActionDelete','Delete Menu')),
                new FormAction('doUpdateMenu', _t('CustomMenus.FormActionUpdate','Update Menu'))
            );

            $form = new Form($this, "EditForm", $fields, $actions);

            $currentMenu = DataObject::get_by_id('CustomMenuHolder',$id);

            $form->loadDataFrom($currentMenu);

            return $form;
        }
    }
	
    function leftMenuForm() {
        // Create form fields
        $fields = new FieldSet(
            new HiddenField('ID','id#','new')
        );

        $actions = new FieldSet(
            new FormAction('doCreateMenu', _t('CustomMenus.CreateMenu','Create Menu'))
        );

        $form = new Form($this, "LeftMenuForm", $fields, $actions);

        return $form;
    }
 
    function doUpdateMenu($data, $form) {
        $id = $data['ID'];

        $record = DataObject::get_by_id("CustomMenuHolder", $id);
        $record->Status = "Saved (update)";
        $form->saveInto($record);

        if($record->write()) {
            FormResponse::status_message(_t('CustomMenus.UpdateSuccess','Updated Menu'), 'good');
            FormResponse::update_status($record->Status);
            FormResponse::set_node_title($id, $record->Title);
            FormResponse::get_page($id);
        } else {
            FormResponse::status_message(_t('CustomMenus.UpdateFail','Update Failed'), 'bad');
        }

        return FormResponse::respond();
    }
	
    function doDeleteMenu($data, $form) {
        $id = $data['ID'];

        $record = DataObject::get_by_id("CustomMenuHolder", $id);
        $record->delete();

        FormResponse::add($this->deleteTreeNodeJS($record));
        FormResponse::status_message(_t('CustomMenus.DeleteSuccess','Deleted Menu'), 'good');
        //FormResponse::status_message(_t('CustomMenus.DeleteFail','Delete Failed'), 'bad');

        return FormResponse::respond();
    }

    function doCreateMenu($data, $form) {
        $menu = new CustomMenuHolder();
        $menu->Title = 'New Menu';
        $menu->Slug = "new-menu";

        if($menu->write()) {
            FormResponse::status_message(_t('CustomMenus.CreateSuccess','Created Menu'), 'good');
        } else
            FormResponse::status_message(_t('CustomMenus.CreateFail','Creation Failed'), 'bad');

        return FormResponse::respond();
    }
}