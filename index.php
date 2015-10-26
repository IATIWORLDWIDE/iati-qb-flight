<?php

 /*** error reporting on ***/
 error_reporting(E_ALL);

 /*** define the site path ***/
 $site_real_path = realpath(dirname(__FILE__));
 define ('__SITE_REAL_PATH', $site_real_path);

$encoding = 'http://';
if( isset($_SERVER['HTTPS'] ) )
	$encoding = 'https://';

 $site_path =  $encoding . $_SERVER['SERVER_NAME'] . (dirname ($_SERVER['PHP_SELF']) == "/" ? "" : dirname ($_SERVER['PHP_SELF']));
 define ('__SITE_PATH', $site_path);

 /*** include the init.php file ***/
 include 'Includes/init.php';

 include 'Config/config.php';

 /*** load the router ***/
 $registry->router = new router($registry);

 $registry->httpclient = new httpclient($registry);
	
 /*** set the controller path ***/
 $registry->router->setPath (__SITE_REAL_PATH . '/Controller');

 /*** load up the template ***/
 $registry->template = new template($registry);

 /*** load the controller ***/
 $registry->router->loader();
 
?>
