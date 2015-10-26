<?php

Class Httpclient {
	
	function __construct() {
	}
	
	function getIp(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	private function getUrl($servicePath){
		return __API_URL . "/" . $servicePath . "/" . $_SESSION['auth_code'];
	}
	
	function postJson($request, $debug = false){
		 
		global $session; 
		
		$servicePath = $request::$SERVICE_URL_PATH;
		
		$url = $this->getUrl($servicePath);
		
		$postFields = $request->createRequest();
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: ".$this->getIp(),"X-Client-IP: ".$this->getIp(),"Client-IP: ".$this->getIp(),"HTTP_X_FORWARDED_FOR: ".$this->getIp(),"X-Forwarded-For: ".$this->getIp()));
		
		if($postFields) 
		{ 
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); 
		} 
		
		curl_setopt($ch, CURLOPT_ENCODING, 'Accept-Encoding: gzip,deflate');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($postFields))                                                                       
		);   
	
		$result = curl_exec ($ch); 
		
		if($result === false)
		{
		    $result = '{"CurlError":"' . curl_error($ch) . '"}';
		}
		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 403)
			return "forbidden";
		
		curl_close ($ch);
		
		if($debug){
			echo '<pre>';
			print_r(json_decode($postFields));
			print_r(json_decode($result));
			echo '</pre>';
			die;
		}
		return json_decode($result); 
	} 
	
	function getJson($request, $debug = false){
		 
		global $session; 
		
		$servicePath = $request::$SERVICE_URL_PATH;
		
		$url = $this->getUrl($servicePath);
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: ".$this->getIp(),"X-Client-IP: ".$this->getIp(),"Client-IP: ".$this->getIp(),"HTTP_X_FORWARDED_FOR: ".$this->getIp(),"X-Forwarded-For: ".$this->getIp()));
		
		curl_setopt($ch, CURLOPT_ENCODING, 'Accept-Encoding: gzip,deflate');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
			)                                                                       
		);   
	
		$result = curl_exec ($ch); 
		
		if($result === false)
		{
		    $result = '{"CurlError":"' . curl_error($ch) . '"}';
		}
		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 403)
			return "forbidden";
		
		curl_close ($ch);
		
		if($debug){
			echo '<pre>';
			print_r(json_decode($result));
			echo '</pre>';
			die;
		}
		return json_decode($result); 
	}
}

?>
