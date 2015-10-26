<?php

 /*** include the controller class ***/
 include __SITE_REAL_PATH . '/Application/' . 'controller_base.class.php';

 /*** include the registry class ***/
 include __SITE_REAL_PATH . '/Application/' . 'registry.class.php';

 /*** include the router class ***/
 include __SITE_REAL_PATH . '/Application/' . 'router.class.php';

 /*** include the template class ***/
 include __SITE_REAL_PATH . '/Application/' . 'template.class.php';
 
  /*** include the httpclient class ***/
 include __SITE_REAL_PATH . '/Application/' . 'httpclient.class.php';

 /*** auto load model classes ***/
    function __autoload($class_name) {
    	
    $filename = strtolower($class_name) . '.class.php';
    
    $file = __SITE_REAL_PATH . '/Model/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

 /*** a new registry object ***/
 $registry = new registry;

 /*** create the database registry object ***/
 // $registry->db = db::getInstance();
?>
