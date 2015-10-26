<?php

Class indexController Extends baseController {

public static $LOGIN_TEST_SERVICE_PATH = "test/sample";

public function index() {
	
	if(!isset($_SESSION["token"])){
			$this->template->show('login/index', "login");
	}else{
		/*** set a template variable ***/
        $this->template->welcome = 'api.iati.com';
		/*** load the index template ***/
        $this->template->show('index');
	}
	
}

public function login() {
	$token = $_POST['token'];
}

}

?>
