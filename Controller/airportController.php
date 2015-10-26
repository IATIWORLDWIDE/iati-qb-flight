<?php

require_once __SITE_REAL_PATH.'/Application/ClassLoader.php';

use Application\ClassLoader\ClassLoader;
use Library\Flight\AirportRequest;

Class airportController Extends baseController {

public $restricted = true;

public function index() 
{
		
	$file_path = __SITE_REAL_PATH."/Assets/files/airport_list.json";	
		
	$json_file = file_get_contents($file_path);
	
	$airports = json_decode($json_file);
	
	$this->template->airports = $airports;
	
	$this->template->show('airport/index');
}

public function loadAirports() 
{
		$loader = new ClassLoader();
		$loader->addPrefix('Library\Flight', __SITE_REAL_PATH.'/Library/Flight');
		$loader->register();
		
		$request = new AirportRequest();

		$url = $request::$SERVICE_URL_PATH;
		
		$http_response = $this->registry->httpclient->postJson($url, null, true);
		
		$file_path = __SITE_REAL_PATH."/Assets/files/airport_list.json";
		
		file_put_contents($file_path, json_encode($http_response->result));
		
		header('Location: /api/airport');
		
}

public function autoComplete(){
	
	$searchKey = $_GET["q"];
	
	// $searchKey = "ista";
	
	$file_path = __SITE_REAL_PATH."/Assets/files/airport_list.json";
	
	$json_file = file_get_contents($file_path);
	
	$airports = json_decode($json_file);
	
	$foundAirports = Array(); 
	foreach($airports as $airport) {
	    if (strpos(strtoupper($searchKey),strtoupper($airport->code)) !== false) {
	        array_push($foundAirports, $airport);
	    }else if(strpos($airport->name, $searchKey) !== false){
	    	array_push($foundAirports, $airport);
	    }else if(strpos($airport->cityName, $searchKey) !== false){
	    	array_push($foundAirports, $airport);
	    }
	}
	
	header("Content-Type: application/json");
	echo json_encode($foundAirports);
	
	
	// print_r($foundAirports);
	
}

public function view(){

	/*** should not have to call this here.... FIX ME ***/

	$this->template->blog_heading = 'This is the blog heading';
	$this->template->blog_content = 'This is the blog content';
	$this->template->show('blog_view');
}


}
?>
