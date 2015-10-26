<?php

require_once __SITE_REAL_PATH.'/Application/ClassLoader.php';

use Application\ClassLoader\ClassLoader;
use Library\Flight\TestRequest;

Class loginController Extends baseController {

public function index() 
{
	$this->template->show('login/index', "login");
}

public function logout() 
{
	session_unset();
	header('Location: '.__SITE_PATH.'/login');
}

public function do_login() 
{
		
		if(!$_POST["auth_code"]){
			$this->template->verifyError = "Please fill out the form";
			$this->template->show('login/index', "login");
			return;
		}
		
		$request = new TestRequest();
		
		$_SESSION['auth_code'] = $_POST["auth_code"];
		
		$http_response = $this->registry->httpclient->getJson($request, false);
		
		if($http_response == "forbidden"){
			unset($_SESSION['auth_code']);
			
			$this->template->error = "Your ip has not been yet identified on IATI's PRODUCTION environment";
			$this->template->show('login/index', "login");
			return;
		}
		
		if(!empty($http_response->error)){
			unset($_SESSION['auth_code']);
			
			$this->template->error = $http_response->error;
			$this->template->show('login/index', "login");
			return;
		}
		
		$_SESSION["logged_in"] = true;
		
		header('Location: '.__SITE_PATH.'/flight');
		
		// $this->template->searchRequest = $post_data;
		//$this->template->searchResult = $http_response;
		
		// $this->template->flights = $http_response->result->flights;
		
		// $this->template->searchId = $http_response->result->searchId;
		
		// $this->template->show('login/search_result');
}

}
?>
