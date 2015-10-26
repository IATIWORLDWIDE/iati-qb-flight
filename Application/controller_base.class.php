<?php
require_once __SITE_REAL_PATH.'/Application/ClassLoader.php';

use Application\ClassLoader\ClassLoader;

Abstract Class baseController {

/*
 * @registry object
 */
protected $registry;

protected $template;

function __construct($registry) {
	$this->registry = $registry;
	$this->template = $registry->template;
	
	$loader = new ClassLoader();
	$loader->addPrefix('Library\Flight', __SITE_REAL_PATH.'/Library/Flight');
	$loader->register();
}

/**
 * @all controllers must contain an index method
 */
abstract function index();
}

?>
