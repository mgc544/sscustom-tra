<?php
 
class RotatorAdmin extends ModelAdmin 
{
 
public static $managed_models = array( 
        'RotatorItem',
    );
     
    static $url_segment = 'rotator-manager';
    static $menu_title = 'Rotator Manager';
    
    

     
}