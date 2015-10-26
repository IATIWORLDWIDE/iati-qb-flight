<?php

Class Template {

/*
 * @the registry
 * @access private
 */
private $registry;

/*
 * @Variables array
 * @access private
 */
private $vars = array();

/**
 *
 * @constructor
 *
 * @access public
 *
 * @return void
 *
 */
function __construct($registry) {
	$this->registry = $registry;
}


 /**
 *
 * @set undefined vars
 *
 * @param string $index
 *
 * @param mixed $value
 *
 * @return void
 *
 */
 public function __set($index, $value)
 {
        $this->vars[$index] = $value;
 }


function show($name, $customTemplate = null) {
	
	$templatePath = "default";
	if(!empty($customTemplate)){
		$templatePath = $customTemplate;
	}
	
	$header_path = __SITE_REAL_PATH . '/Templates/'.$templatePath.'/header.php';
	$footer_path = __SITE_REAL_PATH . '/Templates/'.$templatePath.'/footer.php';
	
	$path = __SITE_REAL_PATH . '/Views' . '/' . $name . '.php';
	
	$is_ajax_request = false;
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		$is_ajax_request = true;
	
	if (file_exists($path) == false)
	{
		throw new Exception('Template not found in '. $path);
		return false;
	}

	// Load variables
	foreach ($this->vars as $key => $value)
	{
		$$key = $value;
	}
	
	if(!$is_ajax_request)
		include ($header_path);
	
	include ($path);    
	
	if(!$is_ajax_request)
		include ($footer_path);
}

}

?>
